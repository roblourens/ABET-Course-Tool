<?php 
require_once("include/header.php"); 
require_once('../src/include.php');

$depts = getDepartments();
?>

<div class="main">
    <h2>
    View All Courses
    </h2>
<hr />

<?php
foreach ($depts as $dept)
{
    $deptCourses = getCourseNumsForDeptId($dept->short);
    echo "<h3 class='dept_name'>".$dept->long."</h3>";

    foreach ($deptCourses as $courseNum)
    {
        $courseID = $dept->short.$courseNum;
        echo "<div class='course_name'><a href='course.php?course=$courseID'>".$dept->long." ".$courseNum."</a></div>";
    }

    echo "<br />";
}
?>
</div>
<?php require_once("include/footer.php"); ?>
