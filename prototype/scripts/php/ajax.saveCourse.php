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
for ($i = 0; $i < $data['assignment_row_count']; $i++) 
{
    // If an assignment row is deleted, these items won't be posted, so ignore them
    if (!isset($data['type_'.$i]))
        continue;

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

$samples = array();

// save sample info (tab 3)
for ($i =0; $i < $data['sample_assignment_row_count']; $i++)
{
    // If the sample is deleted, these items won't be posted
    if (!isset($data['sample_type_'.$i]))
        continue;

    $type = $data['sample_type_'.$i];
    $number = $data['sample_number_'.$i];
    $sampleKey = $type.$number;

    $sample = new SampleAssignment();
    $sample->type = $type;
    $sample->number = $number;

    if (isset($data['fileToUpload_assignment_'.$i]))
        $sample->assignmentFileName = $data['fileToUpload_assignment_'.$i];

    if (isset($data['fileToUpload_A_'.$i]))
        $sample->sampleFileNames[0] = $data['fileToUpload_A_'.$i];

    if (isset($data['fileToUpload_B_'.$i]))
        $sample->sampleFileNames[1] = $data['fileToUpload_B_'.$i];

    if (isset($data['fileToUpload_C_'.$i]))
        $sample->sampleFileNames[2] = $data['fileToUpload_C_'.$i];

    $samples[$sampleKey] = $sample;
}

foreach (learningOutcomesLetters() as $letter)
{
    $checkboxLetterId = 'course_'.$letter;
    if (array_key_exists($checkboxLetterId, $data) && $data[$checkboxLetterId] == 'on')
        $course->courseABETOutcomes[] = $letter;
}

$course->assignments = $assignments;
$course->sampleAssignments = $samples;
updateCourse($course);

echo "Saved successfully!";

function isNonEmptyString($str)
{
    return !(strcmp(trim($str), "") == 0);
}
?>
