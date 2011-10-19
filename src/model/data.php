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
        throw new Exception('courseID: '.$courseID.' does not exist!');

    $f = fopen($path, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($path));
    fclose($f);

    $result = json_decode($json);
    return new Course($result, $courseID);
}

// Updates the course with the given courseID using the given JSON
function updateCourse($course)
{
    global $COURSE;

    $courseID = $course->courseID;
    $path = filePathForCourseID($courseID);
    if (!file_exists($path))
        throw new Exception('path: '.$path.' does not exist!');

    $f = fopen($path, 'w');
    if ($f)
    {
        flock($f, LOCK_EX);
        fwrite($f, $course->toJSON());
        fclose($f);
    }
    else
        throw new Exception('Could not open '.$path." for writing");
}

// Returns all department IDs and department names
// as array of objects [ { "short": "se", "long": "Software Engineering" }, ... ]
function getDepartments()
{
    global $MASTER_FILE;
    
    if (!file_exists($MASTER_FILE))
        throw new Exception('Master file doesn\'t exist at '.$MASTER_FILE.'!');

    $f = fopen($MASTER_FILE, 'r');
    // should block until lock obtained
    flock($f, LOCK_SH);
    $json = fread($f, filesize($MASTER_FILE));
    fclose($f);

    return json_decode($json);
}

function getDepartmentLongNameForID($deptID)
{
    $depts = getDepartments();

    foreach ($depts as $dept)
    {
        if ($dept->short == $deptID)
            return $dept->long;
    }

    return "";
}

// Returns a sorted list of all course IDs for the given department ID
function getCourseIDsForDeptID($deptID)
{
    $courseNums = getCourseNumsForDeptID($deptID);

    foreach($courseNums as $courseNum)
    {
        $courseIDs[] = $deptID . $courseNum;
    }

    return $courseIDs;
}

// Returns a sorted list of course numbers for this department
function getCourseNumsForDeptID($deptID)
{
    global $PROGRAM;
    $path = $PROGRAM.$deptID.'.json';

    if (!file_exists($path))
        throw new Exception($path.' does not exist!');

    $f = fopen($path, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($path));
    fclose($f);

    $courseNums = json_decode($json);
    sort($courseNums);
    return $courseNums;
}

// Takes array of learning outcome IDs (like ['a', 'c', 'g']), returns matching Courses
function getCoursesForOutcomes($outcomes)
{
    
}

function filePathForCourseID($courseID)
{
    global $COURSE;
    return $COURSE.$courseID.'/'.$courseID.'.json';
}

?>
