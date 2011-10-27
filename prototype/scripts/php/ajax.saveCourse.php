<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
// preprocess the posted json by first replacing all \r\n with "\n" newline,
// then removing all the other escapes that will be added for some reason
// also, newlines not allowed in json, so put them back after removing other \'s
$json = str_replace('\\\\r\\\\n', "\n", $_POST['json']);
$json = str_replace('\\', '', $json);
$json = str_replace("\n", '\\n', $json);
$data = json_decode($json, true);

$course = getCourseForID($data['course_id']);
$course->description = $data['course_description'];
$course->courseLearningOutcomes = array_filter(split("\n", $data['course_learning_outcomes']), "isNonEmptyString");
$course->syllabus = $data['syllabus_and_grading'];
$assignments = $course->assignments;

for($i = 0; $i < $data['assignment_row_count']; $i++) 
{
	$type = $data['type_'.$i];
	$number = $data['number_'.$i];
    $assignmentKey = $type.$number;
    $assignment = $course->assignments[$assignmentKey];

    if ($assignment == null)
    {
        $assignment = new Assignment();
        $assignment->type = $type;
        $assignment->number = $number;

        $assignments[$assignmentKey] = $assignment;
    }

    $assignment->learningOutcomes = array();
    foreach (array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K') as $letter)
        if ($data['checkbox'.$letter.'_'.$i] == 'on')
            $assignment->learningOutcomes[] = $letter;
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
