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

<script type="text/javascript" src="scripts/js/viewAllCourses.js"></script>
<script type="text/javascript">
    var authorized = <?php echo $authorized; ?>;
</script>

<div class="main">
  <center><marquee behavior="slide" scrollamount="2" style="background:red; text-transform:uppercase"><font color="white">Please read the "Help" (Top menu) before proceeding. This software is tested on FireFox:v11, Safari:v5 and Chrome:v17. 
    </font></marquee></center>

    <h2>
    View All Courses
    </h2>

    <h3>

<?php
if ($authorized == 0)
    echo "Unlocked</h3>";
else
{
    echo "Locked</h3><form id='unlockform' method='post'>Access Code for deleting course: <input id='unlock_input' name='pw' type='password'></input><button id='unlock_button' type='submit'>Submit</button>";

    if ($authorized == 1)
        echo "<span id='login_error'>Incorrect password, try again</span>";

    echo "</form>";
}
?>

<hr />

<table width="100%">
<tr>

<?php
foreach ($programs as $prog)
{
  echo "<td style='vertical-align:top'>";
    $progCourses = getCourseIDsForProgramID($prog['short']);
    $progID = $prog['short'];
    $compareCoursesF = create_function('$c1,$c2', "return compareCourses(\$c1, \$c2, '$progID');");
    usort($progCourses, $compareCoursesF);
    echo "<h3 class='prog_name'>".$prog['long']."</h3>";
	echo "<table id='table_$progID'>";

  // toggle is used to check when the course sequence changes from 'R' to !'R' - the plan to clearly distinguish
  // between them in the display
    $toggle=0;
    foreach ($progCourses as $courseID)
    {
        $course = getCourseForID($courseID);
        $desig = getDesignatorDisplayString($course->designatorID);
        if ($course->reqForProgram[$progID] != 'R' && $toggle==0)
	  {
            echo "<tr><td>         </td></tr>";
	    echo "<tr><td>Electives</td></tr>";
            $toggle=1;
	  }
        echo "<tr id='tr_${courseID}_$progID'><td><a href='course.php?course=$courseID'>".$desig." ".$course->courseNum."</a></td>";
        echo "<td width='10px'></td><td><button class='delete_button' id='$courseID,$progID'>Delete</button></td></tr>";
    }

    echo "</table>";
    echo "</td>";
}
?>
</tr>
</table>
</div>
<?php require_once("include/footer.php"); ?>
