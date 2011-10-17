<?php 
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$data = json_decode($_POST['json'], true);
print_r($data);
$course_file = "../../../data/courses/".$data['course_named']."/".$data['course_named'].".json";
if(!file_exists($course_file))die("ERROR: The course ".$data['course_named']." does not exist.");
$fh = fopen($course_file, 'w') or die("ERROR: The course data for '".$data['course_named']."' could not be saved.");
$stringData = $_POST['json'];
fwrite($fh, $stringData);
fclose($fh);
echo "Save was successful";
die;
?>
