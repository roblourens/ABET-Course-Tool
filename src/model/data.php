<?php

global $ROOT;
$DATA_ROOT = $ROOT.'data/';
$MASTER_ROOT = $DATA_ROOT.'master/';
$MASTER_FILE = $MASTER_ROOT.'index.json';
$USERS_FILE = $MASTER_ROOT.'users.json';
$DESIGNATORS_FILE = $MASTER_ROOT.'designators.json';
$PASSWORDS_FILE = $MASTER_ROOT.'passwords.json';
$PROGRAM = $DATA_ROOT.'program/';
$COURSE = $DATA_ROOT.'courses/';

function validPwForAllCoursesPage($pw)
{
    global $PASSWORDS_FILE;

    $f = fopen($PASSWORDS_FILE, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($PASSWORDS_FILE));
    fclose($f);

    $passwords = json_decode($json, true);

    $masterPw = $passwords['MASTER'];
    $allCoursesPw = $passwords['allcourses'];
    return $pw == $masterPw || $pw == $allCoursesPw;
}

function validPwForCourse($courseID, $pw)
{
    global $PASSWORDS_FILE;

    $f = fopen($PASSWORDS_FILE, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($PASSWORDS_FILE));
    fclose($f);

    $passwords = json_decode($json, true);

    $masterPw = $passwords['MASTER'];
    if (isset($passwords[$courseID]))
        return $pw == $passwords[$courseID] || $pw == $masterPw;
    else
        return $pw == $courseID || $pw == $masterPw;
}

// Returns false or the array of courses that the user has permission to modify
function login($username, $pw)
{
    global $USERS_FILE;

    $f = fopen($USERS_FILE, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($USERS_FILE));
    fclose($f);

    $users = json_decode($json, true);

    // If there is no user with that username
    if (!isset($users[$username]))
        return false;

    // If the password is incorrect
    if ($users[$username]["pwhash"] != md5($pw))
        return false;

    return $users[$username]["courses"];
}

// Adds the user
// Returns whether successful
// $courses should be an array of course IDs
function addUser($username, $pw, $courses)
{
    global $USERS_FILE;

    $size = filesize($USERS_FILE);
    $f = fopen($USERS_FILE, 'r+');
    flock($f, LOCK_EX);
    $json = fread($f, $size);
    $users = json_decode($json, true);

    // User already exists?
    if (isset($users[$username]))
    {
        fclose($f);
        return false;
    }

    $users[$username] = array();
    $users[$username]["pwhash"] = md5($pw);
    $users[$username]["courses"] = $courses;

    ftruncate($f, 0);
    fseek($f, 0);
    fwrite($f, json_encode($users));
    fclose($f);

    return true;
}

// Sets the given pw or courses for the username
// Doesn't modify fields if they are passed as null
// Returns whether successful
function modifyUser($username, $pw, $courses)
{
    global $USERS_FILE;

    $size = filesize($USERS_FILE);
    $f = fopen($USERS_FILE, 'r+');
    flock($f, LOCK_EX);
    $json = fread($f, $size);
    $users = json_decode($json, true);

    // User doesn't exist?
    if (!isset($users[$username]))
    {
        fclose($f);
        return false;
    }

    if (!is_null($pw))
        $users[$username]["pwhash"] = md5($pw);

    if (!is_null($courses))
        $users[$username]["courses"] = $courses;

    ftruncate($f, 0);
    fseek($f, 0);
    fwrite($f, json_encode($users));
    fclose($f);

    return true;
}

// Returns Course for the give courseID
function getCourseForID($courseID)
{
    global $COURSE;

    $path = filePathForCourseID($courseID);
    if (!file_exists($path))
        return null;

    $f = fopen($path, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($path));
    fclose($f);

    $result = json_decode($json, true);
    return new Course($result, $courseID);
}

// Updates the course with the given courseID using the given JSON
// if makeNewCourse is true, will create a new course file. Otherwise, will fail if the file doesn't already exist
function updateCourse($course, $makeNewCourse=false)
{
    $courseToWrite = getCourseForID($course->courseID);
    if ($makeNewCourse && is_null($courseToWrite))
    {
        $course->descMod = time();
        $course->outcomesMod = time();
        $course->assignMod = time();
        $courseToWrite = $course;
    }

    // call update on the course, if it did not change, bail so we don't
    // rewrite and unnecessarily make a version change, e.g.
    else if (!$courseToWrite->update($course))
        return;

    writeCourse($courseToWrite);
}

// writes the course object to disk without asking any questions
// also maintains previous versions
function writeCourse($course)
{
    global $COURSE;

    pushBackPreviousVersions($course->courseID);
    $courseID = $course->courseID;
    $path = filePathForCourseID($courseID);
    $courseDirectory = dirname($path);
    if (!file_exists($courseDirectory))
        mkdir($courseDirectory);

    $f = fopen($path, 'w');
    if ($f)
    {
        flock($f, LOCK_EX);
        fwrite($f, json_encode($course));
        fclose($f);
    }
    else
        throw new Exception('Could not open '.$path." for writing");
}

// saves old json data .1.json through .N.json
// the current is just .json
function pushBackPreviousVersions($courseID)
{
    $N = 5;
    $basePath = filePathForCourseID($courseID);

    // will not exist yet if it's being written for the first time (initially added)
    if (!file_exists($basePath))
        return;

    for ($i=$N; $i>0; $i--)
    {
        $versionPath = str_replace('.json', '.'.$i.'.json', $basePath);
        $newPath = str_replace('.json', '.'.($i+1).'.json', $basePath);
        if (file_exists($versionPath))
        {
            if ($i==$N)
                unlink($versionPath);
            else
                rename($versionPath, $newPath);
        }
    }

    $versionPath = str_replace('.json', '.1.json', $basePath);
    rename($basePath, $versionPath);
}

// $course is a Course object
function addCourse($course, $progID)
{
    global $PROGRAM;
    $path = $PROGRAM.$progID.'.json';

    if (!file_exists($path))
        throw new Exception($path.' does not exist!');

    $f = fopen($path, 'r+');
    if ($f)
    {
        flock($f, LOCK_EX);
        $courseIDs = json_decode(fread($f, filesize($path)), true);
        if (!is_null($courseIDs))
        {
            if (!in_array($course->courseID, $courseIDs))
                $courseIDs[] = $course->courseID;
            else
	      // Samik: Assuming that any course added to a program will have it required/elective
	      // otherwise you will have to "writeCourse" before returning.
                return 1;

            fseek($f, 0);
            ftruncate($f, 0);
            fwrite($f, json_encode($courseIDs));
            fclose($f);

            // if the course already exists, just set reqForProgram
            $existingCourse = getCourseForID($course->courseID);
            if (!is_null($existingCourse))
            {
                $existingCourse->reqForProgram[$progID] = $course->reqForProgram[$progID];
                // Samik: adding to update course, when course is added to new programs
                writeCourse($existingCourse);
                return 2;
            }

            // adds course file to courses/<courseID>/<courseID>.json
            updateCourse($course, true);
        }
    }
    else
    {
        throw new Exception('Could not open '.$path.' for writing');
    }

    return 0;
}

// Removes the course ID from the program index
// Then removes the program ID from the course object
function removeCourseIDFromPID($courseID, $progID)
{
    global $PROGRAM;
    $path = $PROGRAM.$progID.'.json';

    if (!file_exists($path))
        throw new Exception($path.' does not exist!');

    $f = fopen($path, 'r+');
    if ($f)
    {
        flock($f, LOCK_EX);
        $courseIDs = json_decode(fread($f, filesize($path)), true);
        if (!is_null($courseIDs))
        {
            // the course is not in that program
            if (!in_array($courseID, $courseIDs))
                return 1; // but would probably ignore? or log warning?
            else
            {
                // this is how you delete from an array in PHP. yeah...
                unset($courseIDs[array_search($courseID, $courseIDs)]);
                $courseIDs = array_values($courseIDs);
            }

            fseek($f, 0);
            ftruncate($f, 0);
            fwrite($f, json_encode($courseIDs));
            fclose($f);
        }
    }
    else
    {
        throw new Exception('Could not open '.$path.' for writing');
    }

    $course = getCourseForID($courseID);
    unset($course->reqForProgram[$progID]);
    writeCourse($course);
}

// Returns all program course IDs and department names
// as array of assoc arrays [ { "short": "se", "long": "Software Engineering" }, ... ]
function getPrograms()
{
    global $MASTER_FILE;
    
    if (!file_exists($MASTER_FILE))
        throw new Exception('Master file doesn\'t exist at '.$MASTER_FILE.'!');

    $f = fopen($MASTER_FILE, 'r');
    // should block until lock obtained
    flock($f, LOCK_SH);
    $json = fread($f, filesize($MASTER_FILE));
    fclose($f);

    return json_decode($json, true);
}

function getProgramLongNameForID($progID)
{
    $programs = getPrograms();

    foreach ($programs as $prog)
    {
        if ($prog['short'] == $progID)
            return $prog['long'];
    }

    return "";
}

// Returns a sorted list of course numbers for the given program ID 
function getCourseIDsForProgramID($progID)
{
    global $PROGRAM;
    $path = $PROGRAM.$progID.'.json';

    if (!file_exists($path))
        throw new Exception($path.' does not exist!');

    $f = fopen($path, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($path));
    fclose($f);

    $courseIDs = json_decode($json);
    sort($courseIDs);
    return $courseIDs;
}

// returns the entry in designators.json, or returns $designator if it is
// not in designators.json
function getDesignatorDisplayString($designator)
{
    global $DESIGNATORS_FILE;
    
    if (!file_exists($DESIGNATORS_FILE))
        throw new Exception('Designators file doesn\'t exist at '.$DESIGNATORS_FILE.'!');
        
    $f = fopen($DESIGNATORS_FILE, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($DESIGNATORS_FILE));
    fclose($f);

    $designatorList = json_decode($json, true);
    if (!in_array($designator, array_keys($designatorList)))
        return $designator;

    return $designatorList[$designator];
}

// Takes array of learning outcome IDs (like ['a', 'c', 'g']), 
// and the program (ee, cpre, se); and returns matching Courses
function getCoursesForOutcomesInProg($outcomes, $programID, $requiredOnly=false)
{
    $matches = array();
    $courseArray = array();
    $courseArray = getCourseIdsForProgramID($programID);
    if (!empty($courseArray)) 
    {
    foreach ($courseArray as $courseID)
    {
            $course = getCourseForID($courseID);
            if (($requiredOnly && $course->reqForProgram[$programID]=='R') || !$requiredOnly)
                if ($course->matchesOutcomes($outcomes))
                    $matches[] = $course;
    }
    }
    return $matches;
}

function getCoursesForOutcomes($outcomes)
{
    $matches = array();
    foreach (getPrograms() as $program)
    {
        $programID = $program['short'];
        foreach (getCourseIDsForProgramID($programID) as $courseID)
        {
            $course = getCourseForID($courseID);
            if ($course->matchesOutcomes($outcomes))
                $matches[] = $course;
        }
    }
    return $matches;
}

function filePathForCourseID($courseID)
{
    global $COURSE;
    return $COURSE.$courseID.'/'.$courseID.'.json';
}

function learningOutcomesLetters()
{
    return array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K');
}

?>
