<?php

//$ROOT = '../../data/';
$ROOT = '/Users/rob/Sites/ABET-Course-Tool/data/';
$MASTER_FILE = $ROOT.'master/index.json';
$PROGRAM = $ROOT.'program/';


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

}

// Updates the course with the given courseID using the given JSON
function updateCourseForID($courseID, $courseJSON)
{
    
}

// Returns all department IDs
function getDepartmentIDs()
{
    global $MASTER_FILE;
    $f = fopen($MASTER_FILE, 'r');
    $json = fread($f, filesize($MASTER_FILE));
    fclose($f);
    $result = json_decode($json);

    return $result;
}

// Returns all course IDs for the given department ID
function getCourseIDsForDeptID($deptID)
{
    global $PROGRAM;
    $path = $PROGRAM.$deptID.'.json';
    $f = fopen($path, 'r');
    $json = fread($f, filesize($path));
    fclose($f);
    $result = json_decode($json);

    return $result;
}

// Takes array of learning outcome IDs (like ['a', 'c', 'g']), returns matching Courses
function getCoursesForOutcomes($outcomes)
{
    
}

?>
