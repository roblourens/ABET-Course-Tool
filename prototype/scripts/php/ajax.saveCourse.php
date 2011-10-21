<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$data = json_decode(str_replace('\\', '', $_POST['json']), true);

$course = getCourseForID($data['course_id']);
$course->description = $data['course_description'];
$course->courseLearningOutcomes = split('\. ', $data['course_learning_outcomes']);
$course->syllabus = $data['syllabus_and_grading'];
$assignments = array();

for($i = 0 ; $i < $data['assignment_row_count'] ; $i++){
    $assignment = array();

	$assignment['assignment_type'] = $data['assignment_type_'.$i];
	$assignment['assignment_number'] = $data['assignment_number_'.$i];
	$assignment['learningOutcomes'] = array(); 

    foreach (array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K') as $letter)
        if ($data['checkbox'.$letter.'_'.$i] == 'on')
            $assignment['learningOutcomes'][] = $letter;

    $assignments[] = $assignment;
}

$course->assignments = $assignments;

updateCourse($course);

echo "Saved successfully!";
?>
