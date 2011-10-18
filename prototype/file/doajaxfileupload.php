<?php
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
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
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			
			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);

			$dir = "../../data/courses/".$_GET['course']."/".time().$_FILES['fileToUpload']['name']; 
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $dir);
			

			$course_file = "../../data/courses/".$_GET['course']."/".$_GET['course'].".fileLocations.json";
			//if(!file_exists($course_file))die("ERROR: The course ".$_GET['course']." does not exist.");
			$fh = fopen($course_file, 'r') or die("ERROR: The data for the course ".$_GET['course']." could not be loaded.");
			$theData = fgets($fh);
			fclose($fh);
			$course = json_decode($theData, true);
			$course['assignment_filepath_'.$_GET['type'].'_'.$_GET['number']] = time().$_FILES['fileToUpload']['name'];
			$msg = time().$_FILES['fileToUpload']['name'];
			
			$course_file = "../../data/courses/".$_GET['course']."/".$_GET['course'].".fileLocations.json";
			//if(!file_exists($course_file))die("ERROR: The course ".$_GET['course']." does not exist.");
			$fh = fopen($course_file, 'w') or die("ERROR: The data for the course ".$_GET['course']." could not be loaded.");
			//$stringData = $course;
			fwrite($fh, json_encode($course));
			fclose($fh);


			
			
			
			
	
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>