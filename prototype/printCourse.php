<body onload="document.title = '<?php echo $_GET['course']?>'; window.print();">

<font style="font-family:Arial, Helvetica, sans-serif">
<?php 
function pdfView()
{

$filename ="http://view.samurajdata.se/ps.php?url=http://sciencespot.net/Media/gen_spbobgenetics.pdf";
?>
<style type="text/css">
#outerdiv
{
width:600px;
height:820px;
overflow:hidden;
position:relative;
border:groove;
border-width:thick;
}

#inneriframe
{

position:absolute;
top:-40px;
left:-160px;
width:1280px;
height:1200px;
}
</style>
<div id='outerdiv'>
<iframe src="<?php echo $filename;?>" id='inneriframe' scrolling=no></iframe>
</div>
<?php	
}
?>
<?php
require_once("../src/include.php");
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course = getCourseForID($_GET['course']);
?>
<center>
<h1>
<?php echo getDesignatorDisplayString($course->designatorID); ?>&nbsp;<?php echo $course->courseNum; ?>&nbsp;<?php echo $course->courseName; ?>

<style>
p.page { page-break-after: always; }
</style>


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
    	Specific Course Information
    </th>
    <td>
		<?php echo $course->syllabus; ?>
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
         $lo.=$learningOutcome."\n";
         echo $lo; ?>
    </td>
  </tr>
  <tr align="left" valign="top">
    <th>
    	Date of Modification [MM/DD/YY]
    </tg>
    <td>
		<?php echo $course->descMod; ?>
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
    </table>
  </td>
</tr>
</table>
<h3>Sample Assignments</h3>
<hr />
<table>
  
  <tr align="left" valign="top">
    <td>

    <table width="100%" border="1" id="sampleAssignments">
      
      
      <?php $i=0;
      foreach ($course->assignments as $assignmentKey=>$assignment): ?>
      <p class="page"></p>
      <b>Assignment Type:</b><br />
          <? echo $assignment->type ?>
		<br />
       <b>Assignment Number:</b><br />
          <? echo $assignment->number; ?>
       <br />
       <b>First Page of Assignemnt:</b><br/>
       <? pdfView(); ?>
       
      <?php $i++; endforeach; ?>
  </table>
  </td>
  </tr>
  </table>
  
