<?php

global $ROOT;
$DATA_ROOT = $ROOT.'data/';
$MASTER_ROOT = $DATA_ROOT.'master/';
$MASTER_FILE = $MASTER_ROOT.'index.json';
$USERS_FILE = $MASTER_ROOT.'users.json';
$PROGRAM = $DATA_ROOT.'program/';
$COURSE = $DATA_ROOT.'courses/';

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
// if newCourse is true, will create a new course file. Otherwise, will fail if the file doesn't already exist
function updateCourse($course, $newCourse)
{
    global $COURSE;

    $courseID = $course->courseID;
    $path = filePathForCourseID($courseID);
    if (!file_exists($path) && !$newCourse)
        throw new Exception('path: '.$path.' does not exist!');

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
                return 1;

            fseek($f, 0);
            ftruncate($f, 0);
            fwrite($f, json_encode($courseIDs));
            fclose($f);

            // creates folder courses/<courseID>
            $courseFilePath = filePathForCourseID($course->courseID);
            $courseFolder = dirname($courseFilePath);
            if (file_exists($courseFolder))
                return 2;
            mkdir($courseFolder);

            // adds course file to courses/<courseID>/<courseID>.json
            updateCourse($course, true);
        }
    }
    else
        throw new Exception('Could not open '.$path.' for writing');

    return 0;
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

// Takes array of learning outcome IDs (like ['a', 'c', 'g']), returns matching Courses
function getCoursesForOutcomes($outcomes)
{
    $matches = array();
    foreach (getPrograms() as $program)
    {
        $programID = $program['short'];
        foreach (getCourseIDsForProgramID($programID) as $courseID)
        {
            $course = getCourseForID($courseID);
            if (courseMatchesOutcomes($course, $outcomes))
                $matches[] = $course;
        }
    }
    return $matches;
}

// Returns true if each outcome is an outcomes for at least one assignment
function courseMatchesOutcomes($course, $outcomes)
{
    foreach ($outcomes as $outcome)
    {
        $match = false;
        foreach ($course->assignments as $assignment)
            if (in_array($outcome, $assignment->learningOutcomes))
            {
                $match = true;
                break;
            }

        if (!$match) return false;
    }

    return true;
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
