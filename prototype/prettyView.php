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
<center>
<h1>
<?php echo getDesignatorDisplayString($course->designatorID); ?>&nbsp;<?php echo $course->courseNum; ?>&nbsp;<?php echo $course->courseName; ?>

</h1></center>
<h3>Course Information</h3>
<hr/>

<table>
  <tr align="left" valign="top">
    <th>
    	Instructor/Course Coordinator
    </th>
    <td>
		<?php echo $course->instructors; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>Course Description</th>
    <td>
		<?php echo $course->description; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>
    	Textbook Information
    </th>
    <td>
		<?php echo $course->textbook; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>
    	List of topics to be covered
    </th>
    <td>
		<?php echo $course->topics; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>
    	Specific Goals for the course
    </th>
    <td>
      <?php 
         $lo = "";
         foreach ($course->courseLearningOutcomes as $learningOutcome)
             $lo.=$learningOutcome."<br />";
         echo $lo; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>
    	Date of Modification [MM/DD/YY]
    </th>
    <td>
		<?php 
            // Just use the most recent mod time
            $date = getdate(max($course->descMod, $course->outcomesMod, $course->assignMod));
            echo $date['mon']."/".$date['mday']."/".$date['year'];  
        ?>
    </td>
  </tr>
</table>
<h3>ABET Student Outcomes</h3>
<hr />
<table>

  <tr align="left" valign="top">
    <td>
    <table>
      <tr align="left" valign="top">
        <th>
        	Index
        </th>
        <th>
        	Assignment Type
        </th>
        <th>
        	Assignment#
        </th>
		<th>
        	A
        </th>
		<th>
        	B
        </th>
		<th>
        	C
        </th>
		<th>
        	D
        </th>
		<th>
        	E
        </th>
		<th>
        	F
        </th>
		<th>
        	G
        </th>
		<th>
        	H
        </th>
		<th>
        	I
        </th>
		<th>
        	J
        </th>
		<th>
        	K
        </th>
	</tr>
      <?php $i=0;
      foreach ($course->assignments as $assignmentKey=>$assignment):?>
      <tr align="left" valign="top">
        <td>
			<?php echo $i+1; ?>
        </td>
        <td>
          <?php echo $assignment->type; ?>
        </td>
        <td>
          <?php echo $assignment->number; ?>
        </td>
        <td>
        <?php if(in_array('A', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('B', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('C', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('D', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('E', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('F', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('G', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('H', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('I', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('J', $assignment->learningOutcomes)) echo "X"?> 
        </td>
        <td>
        <?php if(in_array('K', $assignment->learningOutcomes)) echo "X"?> 
        </td>
     </tr>
     <?php $i++; endforeach; ?>

     <!-- summary row -->
     <tr>
        <td colspan="3">Summary of course outcomes</td>
        <td><?php if ($course->matchesOutcome('A')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('B')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('C')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('D')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('E')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('F')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('G')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('H')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('I')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('J')) echo "X"; ?></td>
        <td><?php if ($course->matchesOutcome('K')) echo "X"; ?></td>
     </tr>
    </table>
  </td>
</tr>
</table>
</html>
