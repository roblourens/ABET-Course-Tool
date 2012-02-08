<?php
require_once('../../../src/include.php');
if(!isset($_POST['course']) || !isset($_POST['progID'])) 
    die("ERROR: POST missing parameters");

$course = $_POST['course'];
$progID = $_POST['progID'];
removeCourseIDFromPID($course, $progID);
echo "Saved successfully!";

?>

