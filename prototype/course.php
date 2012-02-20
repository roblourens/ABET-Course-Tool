<?php require_once("include/header.php");?>
<!----------------------------------------------------------->
<!-- Including required scripts and styles for the tabbing -->

<script type="text/javascript" src="tabber.js"></script>
<link rel="stylesheet" href="tab.css" TYPE="text/css" MEDIA="screen">
<!----------------------------------------------------------->

<?php
require_once("../src/include.php");
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course = getCourseForID($_GET['course']);

function formattedDate($time)
{
    if ($time == "")
        return "";

    $date = getdate($time);
    return $date['mon']."/".$date['mday']."/".$date['year'].", ".$date['hours'].':'.$date['minutes'];   
}
?>
<script type="text/javascript">
var courseID = '<?php echo $course->courseID; ?>';

$(document).ready(function(e) {
    syncSummaryRow();

    $('input[type=checkbox]').click(function() {
        syncSummaryRow();
    });

    $('#button_preview').click(function() {
        window.open('prettyView.php?course='+courseID, '_blank');
    });
});
</script>

<div class="main">
            
<h1 class="course_header">
<?php echo getDesignatorDisplayString($course->designatorID)." ".$course->courseNum." - ".$course->courseName; ?>
</h1>

<h3>Course Information &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="prettyView.php?course=<?php echo $_GET['course']; ?>&print">Print</a></h3>
<hr/>

<!-- Src: http://www.barelyfitz.com/projects/tabber/ -->            
<div class="tabber">

<!------------------------------------------------------------------->
<!-- First Segment -->
<!------------------------------------------------------------------->
<div class="tabbertab" title="General Course Information">

<form id="save_course_form">
<table width="100%" border="0">

  <tr>
    <td width="317">Course</td>
    <td width="487" colspan="10"><?php echo getDesignatorDisplayString($course->designatorID); ?>&nbsp;<?php echo $course->courseNum." - "; ?>
    <?php echo $course->courseName; ?> 
      <input name="course_number" type="hidden" value="<?php echo $course->courseNum; ?>"/></td> 
  </tr>

  <tr>
    <td>Instructor/Course Coordinator</td>
    <td colspan="10"><textarea name="course_instructor" cols="80" rows="1"><?php echo $course->instructors; ?></textarea></td>
  </tr>

  <tr>
  <input name="course_id" type="hidden" value="<?php echo $course->courseID; ?>" />
    <td>Course Description</td>
    <td colspan="10"><textarea name="course_description" cols="80" rows="5"><?php echo $course->description; ?></textarea></td>
  </tr>

  <tr>
    <td>Specific Course Information [<label title="Example"><font color="red">Example?</font></label>] 
       <ul>
         <li>Text Book, title, author and year</li>
         <li>Brief list of topics to be covered</li> 
       </ul>
    </td>
    <td colspan="10"><textarea name="syllabus_and_grading" cols="80" rows="5"><?php echo $course->syllabus; ?></textarea></td>
  </tr>

  <tr>
    <td>Specific Goals for the course [<label title="Example"><font color="red">Example?</font></label>] 
       <ul>
          <li>Specific outcomes of instruction<br/> 
              (Each outcome separated by ";")
          </li>
       </ul>
    </td>
    <td colspan="10"><textarea name="course_learning_outcomes" cols="80" rows="5"><?php 
         $lo = "";
         foreach ($course->courseLearningOutcomes as $learningOutcome)
         $lo.=$learningOutcome."; ";
         echo $lo; ?></textarea>
    </td>
  </tr>

  <tr>
    <td>Date of Modification [MM/DD/YY]</td>
    <td colspan="10"><input type="text" name="descMod" cols="8" rows="1" value="<?php echo formattedDate($course->descMod); ?>"/></td>
  </tr>

  <tr>
    <td colspan="13">
        <input type="submit" name="button_save" id="button_save" value="Save Course Info" />
        <input type="submit" name="button_preview" id="button_preview" value="Preview" />
    </td>
  </tr>

<!-- No need in tabbed view
  <tr>
    <td colspan="13">
     <input type="button" name="button_save" id="displayText" onClick="javascript:toggle();" value="Show More Info" />
    </td>
  </tr>
-->
  </table>

</div> <!-- end of div class tabbertab for first segment-->


<!------------------------------------------------------------------->
<!-- Second Segment -->
<!------------------------------------------------------------------->
<div class="tabbertab" title="ABET Student Outcomes">

  <table width="100%" border="0">

  <tr>
    <td colspan="13"><h2>ABET Student Outcomes</h2></td>
  </tr>
  <tr height="10px"></tr>

  <tr>
    <td colspan="13">
    
    <input type="hidden" id="assignment_row_count" name="assignment_row_count" value="<?php echo count($course->assignments); ?>"/>
    
    <table id="assignmentsTable" border="0">
      <tr width="100%">
        <th width="*">Index</th>
        <th width="*">Assignment Type</th>
        <th>Assignment#</th>
		<th id="a" align="center"  
			      title="Ability to apply knowledge of mathematics, science, engineering.">A</th>
                          <th id="b" align="center"
			      title="An ability to design and conduct experiments, as well as to analyze and interpret data.">B</th>
                          <th id="c" align="center"
			      title = "Ability to design a system, component or process to meet desired needs within realistic constraints.">C</th>
                          <th id="d" align="center"
			      title="Ability to function on multidisciplinary teams.">D</th>
                          <th id="e" align="center"
			      title="Ability to identify, formulate and solve engineering problems.">E</th>
                          <th id="f" align="center"
			      title="Understanding of professional and ethical responsibility.">F</th>
                          <th id="g" align="center"
			      title="Ability to communicate effectively.">G</th>
                          <th id="h" align="center"
			      title="The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.">H</th>
                          <th id="i" align="center"
			      title="Recognition of the need for and an ability to engage in lifelong learning.">I</th>
                          <th id="j" align="center"
			      title="Knowledge of contemporary issues.">J</th>
                          <th id="k" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">K</th>
                           <th id="delete" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">Mark For Deletion</th>
                 
      </tr>
     
      <?php $i=0;
      foreach ($course->assignments as $assignmentKey=>$assignment):?>
      <tr id="assignment_row_tr_<?php  echo $i?>" <?php if($i % 2 == 1)echo "bgcolor=\"#b6b7bc\"" ?>>

        <td id="assignment_row_tr_<?php echo $i?>"><?php echo $i+1; ?>
        </td>

        <td id="assignment_row_tr_<?php echo $i?>">
        <select id = "type_<?php echo $i; ?>" name="type_<?php echo $i; ?>">
          <?php $assignmentType = $assignment->type; ?>
          <option <?php if($assignmentType == 0) echo "selected"; ?> value="0">Select Value</option>
          <option <?php if($assignmentType == "homework") echo "selected"; ?> value="homework">Homework</option>
          <option <?php if($assignmentType == "test") echo "selected"; ?> value="test">Test</option>
          <option <?php if($assignmentType == "lab") echo "selected"; ?> value="lab">Lab</option>
          <option <?php if($assignmentType == "quiz") echo "selected"; ?> value="quiz">Quiz</option>
          <option <?php if($assignmentType == "midterm") echo "selected"; ?> value="midterm">Midterm</option>
          <option <?php if($assignmentType == "final") echo "selected"; ?> value="final">Final</option>
        </select>
        </td>

        <td id="assignment_row_tr_<?php $i?>">
        <select name="number_<?php echo $i; ?>" id="select">
          <?php $number = $assignment->number; ?>
          <option <?php if($number == 0) echo "selected"; ?> value="0">Select Number</option>
          <option <?php if($number == 1) echo "selected"; ?> value="1">1</option>
          <option <?php if($number == 2) echo "selected"; ?> value="2">2</option>
          <option <?php if($number == 3) echo "selected"; ?> value="3">3</option>
          <option <?php if($number == 4) echo "selected"; ?> value="4">4</option>
          <option <?php if($number == 5) echo "selected"; ?> value="5">5</option>
          <option <?php if($number == 6) echo "selected"; ?> value="6">6</option>
          <option <?php if($number == 7) echo "selected"; ?> value="7">7</option>
          <option <?php if($number == 8) echo "selected"; ?> value="8">8</option>
          <option <?php if($number == 9) echo "selected"; ?> value="9">9</option>
          <option <?php if($number == 10) echo "selected"; ?> value="10">10</option>
        </select>
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('A', $assignment->learningOutcomes)) echo "checked"?> name="checkboxA_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('B', $assignment->learningOutcomes)) echo "checked"?> name="checkboxB_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('C', $assignment->learningOutcomes)) echo "checked"?> name="checkboxC_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('D', $assignment->learningOutcomes)) echo "checked"?> name="checkboxD_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('E', $assignment->learningOutcomes)) echo "checked"?> name="checkboxE_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('F', $assignment->learningOutcomes)) echo "checked"?> name="checkboxF_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('G', $assignment->learningOutcomes)) echo "checked"?> name="checkboxG_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('H', $assignment->learningOutcomes)) echo "checked"?> name="checkboxH_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('I', $assignment->learningOutcomes)) echo "checked"?> name="checkboxI_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('J', $assignment->learningOutcomes)) echo "checked"?> name="checkboxJ_<?php echo $i; ?>" />
        </td>

        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('K', $assignment->learningOutcomes)) echo "checked"?> name="checkboxK_<?php echo $i; ?>" />
        </td>

        <td bgcolor="#FFCCCC" align="center"><input type="checkbox" id = "checkbox_delete_<?php echo $i; ?>"  onclick="markAssignmentForDeletion('<?php echo $i?>')" name="checkbox_delete_<?php echo $i; ?>" />
        </td>
     </tr>
     <?php $i++; endforeach; ?>
    </table>

    <input type="button" name="add_another_assignment" id="add_another_assignment" value="Add a New Assignment" onclick="add_new_row('#assignmentsTable', add_assignment_row());" />
    </td>
    </tr>
    <br />
  </td>
  </tr>

<tr>
<td colspan="13">
<!-- Summary row -->
<table id="sum_table" border="0">
    <tr>
        <th>&nbsp;</th>
		<th id="a" align="center"  
			      title="Ability to apply knowledge of mathematics, science, engineering.">A</th>
                          <th id="b" align="center"
			      title="An ability to design and conduct experiments, as well as to analyze and interpret data.">B</th>
                          <th id="c" align="center"
			      title = "Ability to design a system, component or process to meet desired needs within realistic constraints.">C</th>
                          <th id="d" align="center"
			      title="Ability to function on multidisciplinary teams.">D</th>
                          <th id="e" align="center"
			      title="Ability to identify, formulate and solve engineering problems.">E</th>
                          <th id="f" align="center"
			      title="Understanding of professional and ethical responsibility.">F</th>
                          <th id="g" align="center"
			      title="Ability to communicate effectively.">G</th>
                          <th id="h" align="center"
			      title="The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.">H</th>
                          <th id="i" align="center"
			      title="Recognition of the need for and an ability to engage in lifelong learning.">I</th>
                          <th id="j" align="center"
			      title="Knowledge of contemporary issues.">J</th>
                          <th id="k" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">K</th>
                           <th id="delete" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice."></th>
    </tr>
    <tr>
        <td class="bold">Summary of course outcomes</td>
        <td><input type="checkbox" name="sum_A" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_B" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_C" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_D" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_E" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_F" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_G" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_H" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_I" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_J" disabled="disabled"/></td>
        <td><input type="checkbox" name="sum_K" disabled="disabled"/></td>
    </tr>
</table>
</td>
</tr>
  <tr>
    <td>Date of Modification [MM/DD/YY]: <input type="text" name="outcomesMod" cols="8" rows="1" value="<?php echo formattedDate($course->outcomesMod); ?>"/></td>
  </tr>

</table>

<input type="submit" name="button_save" id="button_save" value="Save Course Info" />
<input type="submit" name="button_preview" id="button_preview" value="Preview" />

</div> <!-- end of div class tabbertab for second segment -->


<!-- Third Segment -->
<div class="tabbertab" title="Sample Student Assignments">

  <table border="0">
  <tr>
    <td colspan="13"><h2>Sample Assignments:</h2></td>
    <input type="hidden" id="sample_assignment_row_count" name="sample_assignment_row_count" value="<?php echo count($course->assignments); ?>"/>
  </tr>

  <tr height="10px"></tr>

  <tr>
    <td colspan="13">

    <table width="100%" border="1" id="sampleAssignments">
      
      
      <?php $i=0;
      foreach ($course->assignments as $assignmentKey=>$assignment): ?>
      <tr <?php //if($i % 2 == 0)echo "bgcolor=\"#b6b7bc\"" ?>>

        <td width="33%" height="103">Assignment Type:<br />
          <select id = "sample_type_<?php echo $i; ?>" name="sample_type_<?php echo $i; ?>">
            <option <?php if($assignment->type == 0) echo "selected"; ?> value="0" selected="selected">Select Value</option>
            <option <?php if($assignment->type == "homework") echo "selected"; ?> value="homework">Homework</option>
            <option <?php if($assignment->type == "test") echo "selected"; ?> value="test">Test</option>
            <option <?php if($assignment->type == "lab") echo "selected"; ?> value="lab">Lab</option>
            <option <?php if($assignment->type == "quiz") echo "selected"; ?> value="quiz">Quiz</option>
            <option <?php if($assignment->type == "midterm") echo "selected"; ?> value="midterm">Midterm</option>
            <option <?php if($assignment->type == "final") echo "selected"; ?> value="final">Final</option>
          </select></td>

        <td width="33%">Assignment Number:<br />
          <select name="sample_number_<?php echo $i; ?>" id="sample_number_<?php echo $i; ?>">
            <option <?php if($assignment->number == 0) echo "selected"; ?> value="0">Select Number</option>
            <option <?php if($assignment->number == 1) echo "selected"; ?> value="1">1</option>
            <option <?php if($assignment->number == 2) echo "selected"; ?> value="2">2</option>
            <option <?php if($assignment->number == 3) echo "selected"; ?> value="3">3</option>
            <option <?php if($assignment->number == 4) echo "selected"; ?> value="4">4</option>
            <option <?php if($assignment->number == 5) echo "selected"; ?> value="5">5</option>
            <option <?php if($assignment->number == 6) echo "selected"; ?> value="6">6</option>
            <option <?php if($assignment->number == 7) echo "selected"; ?> value="7">7</option>
            <option <?php if($assignment->number == 8) echo "selected"; ?> value="8">8</option>
            <option <?php if($assignment->number == 9) echo "selected"; ?> value="9">9</option>
            <option <?php if($assignment->number == 10) echo "selected"; ?> value="10">10</option>
          </select></td>

        <td width="33%"><div id="file_upload_box_assignment_<?php echo $i ?>"><?php
        // Assignment block
        if ($assignment->assignmentFileName != "")
            echo "<a href = '../data/courses/".$course->courseID."/".$assignment->assignmentFileName."'>View File</a>";
        else
            echo "Upload Assignment:<br />
<input id='fileToUpload_assignment_".$i."' type='file' name='fileToUpload_assignment_".$i."' class='input'>"; ?>
        </div>
        </td>

      </tr >

      <tr <?php //if($i % 2 == 0)echo "bgcolor=\"#b6b7bc\"" ?>>
        <td width="33%">
                  <div id="<?php echo "file_upload_box_A_".$i?>">
                           <?php
                             // Sample A block
                                if ($assignment->sampleFileNames[0] != "")
                                   echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[0]."'>View File</a>";
                                else
                                   echo "Upload sample solution worth of an &quot;A&quot;:
                                <input id='fileToUpload_A_".$i."' type='file' name='fileToUpload_A_".$i."' class='input'>"; ?>
                  </div>
        </td>

        <td width="33%">
                <div id="<?php echo "file_upload_box_B_".$i?>">
                         <?php
                          // Sample B block
                             if ($assignment->sampleFileNames[1] != "")
                               echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[1]."'>View File</a>";
                             else
                               echo "Upload sample solution worth of an &quot;B&quot;:<br />
                             <input id='fileToUpload_B_".$i."' type='file' name='fileToUpload_B_".$i."' class='input'>"; ?>
                </div>
        </td>

        <td width="33%">
               <div id="<?php echo "file_upload_box_C_".$i?>">
                        <?php
                         // Sample C block
                             if ($assignment->sampleFileNames[2] != "")
                                 echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[2]."'>View File</a>";
                             else
                                 echo "Upload sample solution worth of an &quot;C&quot;:<br />
                            <input id='fileToUpload_C_".$i."' type='file' name='fileToUpload_C_".$i."' class='input'>"; ?>
               </div>
        </td>

      </tr>

      <?php $i++; endforeach; ?>

    </table>
  </td>
  </tr>
  
  <tr>
    <td colspan="13"><input type="button" name="add_another_sample" id="add_another_sample" value="Add a New Sample" onClick="add_new_row('#sampleAssignments', genNewSampleRow('<?php echo $course->courseID; ?>'))" />
    </td>
  </tr>

    <tr>
    <td>Date of Modification [MM/DD/YY]: <input type="text" name="assignMod" cols="8" rows="1" value="<?php echo formattedDate($course->assignMod); ?>"/></td>
  </tr>



  <tr>
    <td><input type="submit" name="button_save" id="button_save" value="Save Course Info" />
        <input type="submit" name="button_preview" id="button_preview" value="Preview" />
    </td>
  </tr>

  </table>


</form>

</div> <!-- end of div class tabbertab for third sedment -->


<?php require_once("include/footer.php"); ?>
</div> <!-- end of div class tabber -->

</div> <!-- end of class main -->
