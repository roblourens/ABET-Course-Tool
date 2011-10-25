<?php 
    require_once("../../src/include.php");
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload_'.$_GET['type'];
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;
			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		echo "error";
	}
	else 
	{
        $fileName = time().$_FILES[$fileElementName]['name'];
        // save path, relative to this file
        $filePath = "../../data/courses/".$_GET['course']."/".$fileName; 
        move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $filePath);

        $course = getCourseForID($_GET['course']);
        $assignments = $course->assignments;
        //$assignmentKey = $_GET['type'].$_GET['number'];
        $assignmentKey = "homework3";
        if (property_exists($course, $assignmentKey))
            $assignment = $assignments[$assignmentKey];
        else
        {
            $assignment = new Assignment();
            $assignment->type = $_GET['assignment_type'];
            $assignment->number = $_GET['number'];
        }

        if ($_GET['type'] == 'assignment')
            $assignment->assignmentFileName = $fileName;
        else if ($_GET['type'] == 'A')
            $assignment->sampleFileNames[0] = $fileName;
        else if ($_GET['type'] == 'B')
            $assignment->sampleFileNames[1] = $fileName;
        else if ($_GET['type'] == 'C')
            $assignment->sampleFileNames[2] = $fileName;

        $assignments[$assignmentKey] = $assignment;
        $course->assignments = $assignments;

        updateCourse($course);

        $msg = "../data/courses/".$_GET['course']."/".$fileName;
	}

	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>
