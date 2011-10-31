<?php
require_once('../../../src/include.php');
if(!isset($_POST['json']))die("ERROR:  No data was sent from the client");
// preprocess the posted json by first replacing all \r\n with "\n" newline,
// then removing all the other escapes that will be added for some reason
// also, newlines not allowed in json, so put them back after removing other \'s
$json = str_replace('\\r\\n', "\n", $_POST['json']);
$json = str_replace('\\', '', $json);
$json = str_replace("\n", '\\n', $json);
$data = json_decode($json, true);

$course = getCourseForID($data['course_id']);
$course->description = $data['course_description'];
$course->courseLearningOutcomes = array_filter(split("\n", $data['course_learning_outcomes']), "isNonEmptyString");
$course->syllabus = $data['syllabus_and_grading'];
$assignments = array();

for($i = 0; $i < $data['assignment_row_count']; $i++) 
{
    $deleteKeyId = 'checkbox_delete_'.$i;
    if (array_key_exists($deleteKeyId, $data) && $data[$deleteKeyId]=='on')
        continue;

	$type = $data['type_'.$i];
	$number = $data['number_'.$i];
    $assignmentKey = $type.$number;

    $assignment = new Assignment();
    $assignment->type = $type;
    $assignment->number = $number;
    $assignments[$assignmentKey] = $assignment;

    $assignment->learningOutcomes = array();
    foreach (array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K') as $letter)
    {
        $checkboxLetterId = 'checkbox'.$letter.'_'.$i;
        if (array_key_exists($checkboxLetterId, $data) && $data[$checkboxLetterId] == 'on')
            $assignment->learningOutcomes[] = $letter;
    }
}

$course->assignments = $assignments;
updateCourse($course, false);

echo "Saved successfully!";

function isNonEmptyString($str)
{
    return !(strcmp(trim($str), "") == 0);
}
?>
