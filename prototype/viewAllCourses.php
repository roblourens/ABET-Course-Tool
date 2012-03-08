<?php 
require_once("include/header.php"); 
require_once('../src/include.php');

// 0 = authorized
// 1 = wrong pw
// 2 = no pw given
if (!isset($_POST['pw']))
    $authorized = 2;
else if (!validPwForAllCoursesPage($_POST['pw']))
    $authorized = 1;
else
    $authorized = 0;

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
    <h3>
<?php
if ($authorized == 0)
    echo "Unlocked</h3>";
else
{
    echo "Locked</h3><form id='unlockform' method='post'>Access Code: <input id='unlock_input' name='pw' type='password'></input><button id='unlock_button' type='submit'>Submit</button>";

    if ($authorized == 1)
        echo "<span id='login_error'>Incorrect password, try again</span>";

    echo "</form>";
}
?>

<script type='text/javascript'>
$(document).ready(function(e) {
    authorized = <?php echo $authorized; ?>;

    if (authorized != 0)
        $('button[id!=unlock_button]').hide();
});
</script>

<hr />

<?php
foreach ($programs as $prog)
{
    $progCourses = getCourseIDsForProgramID($prog['short']);
    $progID = $prog['short'];
    $compareCoursesF = create_function('$c1,$c2', "return compareCourses(\$c1, \$c2, '$progID');");
    usort($progCourses, $compareCoursesF);
    echo "<h3 class='prog_name'>".$prog['long']."</h3>";
	echo "<table id='table_$progID'>";
    foreach ($progCourses as $courseID)
    {
        $course = getCourseForID($courseID);
        $desig = getDesignatorDisplayString($course->designatorID);
        echo "<tr id='tr_${courseID}_$progID'><td><a href='course.php?course=$courseID'>".$desig." ".$course->courseNum."</a></td>";
        echo "<td width='10px'></td><td><form class='delete_form' id='$courseID,$progID'><button>Delete</button></form></td></tr>";
    }

    echo "</table>";
}
?>
</div>
<?php require_once("include/footer.php"); ?>
