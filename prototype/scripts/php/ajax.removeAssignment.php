<?php
require_once('../../../src/include.php');
if(!isset($_POST['course']) || !isset($_POST['assignmentKey'])) 
    die("ERROR: POST missing parameters");

$course = $_POST['course'];
$assignmentKey = $_POST['assignmentKey'];
removeAssignmentKeyFromCourse($assignmentKey, $course);
echo "Removed assignment successfully!";

?>
