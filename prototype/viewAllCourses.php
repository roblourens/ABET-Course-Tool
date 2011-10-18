<?php require_once("include/header.php"); ?>
<div class="main">
            <h2>
                View All Courses
            </h2>
            <hr />
<?php
if ($handle = opendir('../data/courses')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {


			//if(!isset($_GET['course']))die("ERROR: Course name not given.");
			$course_file = "../data/courses/".$file."/".$file.".json";
			if(!file_exists($course_file))die("ERROR: The course ".$file." does not exist.");
			$fh = fopen($course_file, 'r') or die("ERROR: The data for the course ".$file." could not be loaded.");
			$theData = fgets($fh);
			fclose($fh);
			$course = json_decode($theData, true);
			if(!is_numeric($course['assignment_row_count']) || $course['assignment_row_count'] < 1) $course['assignment_row_count'] = 1;
			if(!is_numeric($course['sample_assignment_row_count']) || $course['sample_assignment_row_count'] < 1) $course['sample_assignment_row_count'] = 1;
			//print_r($course);
            echo "<h3><a href='course.php?course=$file'>".$course['course_department']." ".$course['course_number']."</a></h3><br/>";
        }
    }
    closedir($handle);
}
?>
</div>
<?php require_once("include/footer.php"); ?>