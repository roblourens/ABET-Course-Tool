<?php

require_once('Course.php');

$ROOT = '/Users/rob/Sites/ABET-Course-Tool/';
$DATA_ROOT = $ROOT.'data/';
$MASTER_FILE = $DATA_ROOT.'master/index.json';
$PROGRAM = $DATA_ROOT.'program/';
$COURSE = $DATA_ROOT.'courses/';

// Returns whether login was successful
function login($username, $pw)
{
    return true;
}

// Returns course ids for courses that the logged-in user has permission to modify
function getCourseIDsForUser()
{
    
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

// Returns all department IDs
function getDepartmentIDs()
{
    global $MASTER_FILE;
    
    if (!file_exists($MASTER_FILE))
        throw new Exception('Master file doesn\'t exist!');

    $f = fopen($MASTER_FILE, 'r');
    // should block until lock obtained
    flock($f, LOCK_SH);
    $json = fread($f, filesize($MASTER_FILE));
    fclose($f);

    return json_decode($json);
}

// Returns all course IDs for the given department ID
function getCourseIDsForDeptID($deptID)
{
    global $PROGRAM;
    $path = $PROGRAM.$deptID.'.json';

    if (!file_exists($path))
        throw new Exception($path.' does not exist!');

    $f = fopen($path, 'r');
    flock($f, LOCK_SH);
    $json = fread($f, filesize($path));
    fclose($f);

    return json_decode($json);
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
