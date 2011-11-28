<?php 
require_once("include/header.php"); 
require_once('../src/include.php');

$programs = getPrograms();
?>

<div class="main">
    <h2>
    View All Courses
    </h2>
<hr />

<?php
foreach ($programs as $prog)
{
    $progCourses = getCourseIDsForProgramID($prog['short']);
    echo "<h3 class='prog_name'>".$prog['long']."</h3>";
	echo "<table>";
    foreach ($progCourses as $courseID)
    {
        $course = getCourseForID($courseID);
        $desig = getDesignatorDisplayString($course->designatorID);
        echo "<div class='course_name'><tr><td><a href='course.php?course=$courseID'>".$desig." ".$course->courseNum."</a></td><td width='10px'></td><td><button>Delete</button><td><tr></div>";
    }

    echo "</table>";
}
?>
</div>
<?php require_once("include/footer.php"); ?>
