<html>
<body onload="document.title = '<?php echo $_GET['course']?>'; <?php 
    // noprint for debugging
    if (!isset($_GET['noprint']))
    {
        if (!isset($_GET['print'])) echo 'alert(\'Please check the number of pages printing\');';
        echo 'window.print();'; 
    }
?>">
<style type="text/css">
body
{
    font-family:"Times New Roman";
    font-size:"12pt";
}
</style>

<?php
require_once("../src/include.php");
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course = getCourseForID($_GET['course']);
?>

<center><h2>
<?php echo getDesignatorDisplayString($course->designatorID)."&nbsp;".$course->courseNum."&nbsp;".str_replace(".", "", $course->courseName); ?>
</h2></center>

<h3>General Course Information</h3>
<hr/>
<table width="100%">
<?php
$lo = "";
foreach ($course->courseLearningOutcomes as $learningOutcome)
    $lo.=$learningOutcome."<br />";

// Just use the most recent mod time
$date = getdate(max($course->descMod, $course->outcomesMod, $course->assignMod));

$rows = array("Instructor/Course Coordinator" => $course->instructors,
              "Credits and Contact Hours" => $course->creditsContact,
              "Course Description" => getDesignatorDisplayString($course->designatorID)." ".$course->courseNum.". ".$course->courseName." ".$course->description,
              "Textbook Information" => $course->textbook,
              "List of topics to be covered" => $course->topics,
              "Specific goals for the course" => $lo,
              "Date of Modification [MM/DD/YY]" => $date['mon']."/".$date['mday']."/".$date['year'],
              );
foreach ($rows as $title=>$data)
{
    echo <<<EOL
    <tr align="left" valign="top">
        <th width="22%">
            $title
        </th>
        <td>
            $data
        </td>
    </tr>
EOL;
}
?>
</table>
<h3>ABET Student Outcomes</h3>
<hr />
<table>
    <tr align="left" valign="top">
        <?php
        foreach (array("Assignment Type", "Assignment #") as $header)
            echo "<th>$header</th>";

        for ($i=ord("A"); $i<=ord("K"); $i++)
            echo "<th>".chr($i)."</th>";
        ?>
    </tr>
    <?php $i=0;
      foreach ($course->assignments as $assignmentKey=>$assignment):?>
    <tr align="left" valign="top">
        <td>
            <?php echo $assignment->type; ?>
        </td>
        <td>
            <?php echo $assignment->number; ?>
        </td>
        <?php
            for ($i=ord("A"); $i<=ord("K"); $i++)
            {
                echo "<td>";

                if (in_array(chr($i), $assignment->learningOutcomes))
                    echo "X";

                echo "</td>";
            }
        ?>
    </tr>
    <?php endforeach; ?>

    <!-- summary row -->
    <tr>
        <td colspan="2">Summary of course outcomes</td>
        <?php
            for ($i=ord("A"); $i<=ord("K"); $i++)
            {
                echo "<td>";

                if ($course->matchesOutcome(chr($i)))
                    echo "X";

                echo "</td>";
            }
        ?>
    </tr>
</table>
</html>
