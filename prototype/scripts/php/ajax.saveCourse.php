<?php
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$data = json_decode($_POST['json'], true);
$course_file = "../../../data/courses/".$data['course_named']."/".$data['course_named'].".json";
if(!file_exists($course_file))die("ERROR: The course ".$data['course_named']." does not exist.");
$fh = fopen($course_file, 'w') or die("ERROR: The course data for '".$data['course_named']."' could not be saved.");
$stringData = $_POST['json'];
fwrite($fh, $stringData);
fclose($fh);
echo "Save was successful";
die;












































$course = getCourseForId($data['course_id']);
$course->descirption = $data['course_description'];

for($i = 0 ; $i < $data['assignment_row_count'] ; $i++){
	$assignments[$i]['assignment_type'] = $data['assignment_type_'.$i];
	$assignments[$i]['assignment_number'] = $data['assignment_number_'.$i];
	$assignments[$i]['checkboxA_'.$i] = $data['checkboxA_'.$i];
	$assignments[$i]['checkboxB_'.$i] = $data['checkboxB_'.$i];
	$assignments[$i]['checkboxC_'.$i] = $data['checkboxC_'.$i];
	$assignments[$i]['checkboxD_'.$i] = $data['checkboxD_'.$i];
	$assignments[$i]['checkboxE_'.$i] = $data['checkboxE_'.$i];
	$assignments[$i]['checkboxF_'.$i] = $data['checkboxF_'.$i];
	$assignments[$i]['checkboxG_'.$i] = $data['checkboxG_'.$i];
	$assignments[$i]['checkboxH_'.$i] = $data['checkboxH_'.$i];
	$assignments[$i]['checkboxI_'.$i] = $data['checkboxI_'.$i];
	$assignments[$i]['checkboxJ_'.$i] = $data['checkboxJ_'.$i];
	$assignments[$i]['checkboxK_'.$i] = $data['checkboxK_'.$i];	
}

$course->assignments = $assignments;
print_r($course);
die;
?>
