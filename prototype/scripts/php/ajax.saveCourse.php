<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
$json = str_replace('\\r\\n', "\n", $_POST['json']);
$json = str_replace('\\', '', $json);
$json = str_replace("\n", '\\n', $json);
$data = json_decode($json, true);

$course = getCourseForID($data['course_id']);
$course->instructors = $data['course_instructor'];    // Course instructor information
$course->description = $data['course_description'];
$course->courseLearningOutcomes = array_filter($data['course_learning_outcomes'], "isNonEmptyString");
$course->textbook = $data['textbook'];
$course->topics = $data['topics'];

$assignments = array();

// save assignment info (tab 2)
for($i = 0; $i < $data['assignment_row_count']; $i++) 
{
	$type = $data['type_'.$i];
	$number = $data['number_'.$i];
    $assignmentKey = $type.$number;

    $assignment = new Assignment();
    $assignment->type = $type;
    $assignment->number = $number;

    $assignment->learningOutcomes = array();
    foreach (learningOutcomesLetters() as $letter)
    {
        $checkboxLetterId = 'checkbox'.$letter.'_'.$i;
        if (array_key_exists($checkboxLetterId, $data) && $data[$checkboxLetterId] == 'on')
            $assignment->learningOutcomes[] = $letter;
    }

    $assignments[$assignmentKey] = $assignment;
}

foreach (learningOutcomesLetters() as $letter)
{
    $checkboxLetterId = 'course_'.$letter;
    if (array_key_exists($checkboxLetterId, $data) && $data[$checkboxLetterId] == 'on')
        $course->courseABETOutcomes[] = $letter;
}

$course->assignments = $assignments;
updateCourse($course);

echo "Saved successfully!";

function isNonEmptyString($str)
{
    return !(strcmp(trim($str), "") == 0);
}
?>
