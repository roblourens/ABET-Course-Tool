<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$data = json_decode(str_replace('\\', '', $_POST['json']), true);

$course = getCourseForID($data['course_id']);
$course->description = $data['course_description'];
$course->courseLearningOutcomes = array_filter(split('\.( *)', $data['course_learning_outcomes']), "isNonEmptyString");
$course->syllabus = $data['syllabus_and_grading'];
$assignments = $course->assignments;

for($i = 0 ; $i < $data['assignment_row_count'] ; $i++){

	$type = $data['assignment_type_'.$i];
	$number = $data['assignment_number_'.$i];
    $assignment = $course->assignmentForTypeNumber($type, $number);

    if ($assignment == null)
    {
        $assignment = array();
        $assignment['assignment_type'] = $type;
        $assignment['assignment_number'] = $number;
        $assignment['learningOutcomes'] = array();

        foreach (array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K') as $letter)
            if ($data['checkbox'.$letter.'_'.$i] == 'on')
                $assignment['learningOutcomes'][] = $letter;

        $assignments[] = $assignment;
    }
    else
    {
        // reset the learning outcomes every time, easier than selectively
        // adding and deleting as needed
        $assignment->learningOutcomes = array();
        foreach (array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K') as $letter)
            if ($data['checkbox'.$letter.'_'.$i] == 'on')
                $assignment->learningOutcomes[] = $letter;
    }
}

// I don't know why this is necessary, but it is
$course->assignments = $assignments;
updateCourse($course);

echo "Saved successfully!";

function isNonEmptyString($str)
{
    return !(strcmp(trim($str), "") == 0);
}
?>
