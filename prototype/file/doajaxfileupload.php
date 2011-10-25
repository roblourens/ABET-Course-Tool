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
            $assignment = $course->assignmentForTypeNumber($_GET['type'], $_GET['number']);
            if ($assignment == null)
            {
                $assignments = $course->assignments;
                $assignment = array();
                $assignment['assignment_type'] = $_GET['type'];
                $assignment['assignment_number'] = $_GET['number'];
                $assignment['learning_outcomes'] = array();
                // view path, relative to course.php
                // TODO resolve the array/object assignment thing
                $assignment['filepath'] = "../data/courses/".$_GET['course']."/".$fileName;
                $assignments[] = $assignment;
            }
            else
                $assignment->filepath = "../data/courses/".$_GET['course']."/".$fileName;

			$msg = $fileName;
            updateCourse($course);
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>
