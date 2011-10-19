<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$data = json_decode(str_replace('\\', '', $_POST['json']), true);

$course = getCourseForID($data['course_id']);
$course->description = $data['course_description'];
$course->courseLearningOutcomes = split('\. ', $data['course_learning_outcomes']);
$course->syllabus = $data['syllabus_and_grading'];

for($i = 0 ; $i < $data['assignment_row_count'] ; $i++){
	$course->assignments[$i]->assignment_type = $data['assignment_type_'.($i+1)];
	$course->assignments[$i]->assignment_number = $data['assignment_number_'.($i+1)];
	$course->assignments[$i]->learningOutcomes = array(); 

    foreach (array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k') as $letter)
        if ($data['checkbox'.strtoupper($letter).'_'.($i+1)] == 'on')
            $course->assignments[$i]->learningOutcomes[] = $letter;
}

updateCourse($course);

echo "Saved successfully!";
?>
