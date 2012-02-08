<?php 
require_once("include/header.php"); 
require_once('../src/include.php');

$programs = getPrograms();


function compareCourses($c1, $c2, $progID)
{
    $course1 = getCourseForID($c1);
    $course2 = getCourseForID($c2);

    if ($course1->reqForProgram[$progID] == 'R' && $course2->reqForProgram[$progID] != 'R')
        return -1;
    else if ($course2->reqForProgram[$progID] == 'R' && $course1->reqForProgram[$progID] != 'R')
        return 1;
    else
        return strcmp($course1->courseID, $course2->courseID);
}
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
    $progID = $prog['short'];
    $compareCoursesF = create_function('$c1,$c2', "return compareCourses(\$c1, \$c2, '$progID');");
    usort($progCourses, $compareCoursesF);
    echo "<h3 class='prog_name'>".$prog['long']."</h3>";
	echo "<table>";
    foreach ($progCourses as $courseID)
    {
        $course = getCourseForID($courseID);
        $desig = getDesignatorDisplayString($course->designatorID);
        echo "<div class='course_name'><tr><td><a href='course.php?course=$courseID'>".$desig." ".$course->courseNum."</a></td><td width='10px'></td><td><form class='delete_form' id='$courseID;$progID'><button>Delete</button></form><td><tr></div>";
    }

    echo "</table>";
}
?>
</div>
<?php require_once("include/footer.php"); ?>
