<?php require_once("include/header.php");?>
<h1>
<?php
require_once("../src/include.php");
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course = getCourseForID($_GET['course']);
?>
</h1>
<script type="text/javascript">
var courseID = '<?php echo $course->courseID; ?>';
</script>

        <div class="main">
            <h2>
                Course Information
            </h2>
            <hr />
            


<form id="save_course_form">


<table width="100%" border="0">
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
  <tr>
    <td width="317">Course:</td>
    <td width="487" colspan="10"><?php echo getProgramLongNameForID($course->deptID); ?>&nbsp;<?php echo $course->courseNum; ?>
      <input name="course_number" type="hidden" value="<?php echo $course->courseNum; ?>"/></td>
  </tr>
  <input name="course_id" type="hidden" value="<?php echo $course->courseID; ?>" />
    <td>Course Description:</td>
    <td colspan="10"><textarea name="course_description" cols="45" rows="5"><?php echo $course->description; ?></textarea></td>
  </tr>
  <tr>
    <td>Syllabus &amp; Grading Guidelines:</td>
    <td colspan="10"><textarea name="syllabus_and_grading" cols="45" rows="5"><?php echo $course->syllabus; ?></textarea></td>
  </tr>
  <tr>
    <td>Course Learning Outcomes</td>
    <td colspan="10"><textarea name="course_learning_outcomes" cols="45" rows="5"><?php 
    $lo = "";
    foreach ($course->courseLearningOutcomes as $learningOutcome)
        $lo.=$learningOutcome."\n";
    echo $lo; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
   <tr>
    <td colspan="13"><input type="button" name="button_save" id="displayText" onClick="javascript:toggle();" value="Show More Info" /></td>
  </tr>
  </table>
  <div id="toggleText" >
  <hr />
  <table width="100%" border="0">
  <tr>
    <td colspan="13"><h2>Assignments That Follow ABET:</h2></td>
  </tr>
 <tr height="10px"></tr>
  <tr>
    <td colspan="13">
    
    <input type="hidden" id="assignment_row_count" name="assignment_row_count" value="<?php echo count($course->assignments); ?>"/>
    
    <table id="assignmentsTable" border="0">
      <tr width="100%">
        <th width="53">Index</th>
        <th width="54">Assignment Type</th>
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
        <td id="assignment_row_tr_<?php echo $i?>"><?php echo $i+1; ?></td>
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
        </select></td>
        <td id="assignment_row_tr_<?php $i?>"><select name="number_<?php echo $i; ?>" id="select">
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
        </select></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('A', $assignment->learningOutcomes)) echo "checked"?> name="checkboxA_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('B', $assignment->learningOutcomes)) echo "checked"?> name="checkboxB_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('C', $assignment->learningOutcomes)) echo "checked"?> name="checkboxC_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('D', $assignment->learningOutcomes)) echo "checked"?> name="checkboxD_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('E', $assignment->learningOutcomes)) echo "checked"?> name="checkboxE_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('F', $assignment->learningOutcomes)) echo "checked"?> name="checkboxF_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('G', $assignment->learningOutcomes)) echo "checked"?> name="checkboxG_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('H', $assignment->learningOutcomes)) echo "checked"?> name="checkboxH_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('I', $assignment->learningOutcomes)) echo "checked"?> name="checkboxI_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('J', $assignment->learningOutcomes)) echo "checked"?> name="checkboxJ_<?php echo $i; ?>" /></td>
        <td id="assignment_row_tr_<?php echo $i?>"><input type="checkbox" <?php if(in_array('K', $assignment->learningOutcomes)) echo "checked"?> name="checkboxK_<?php echo $i; ?>" /></td>
        <td bgcolor="#FFCCCC" align="center"><input type="checkbox" id = "checkbox_delete_<?php echo $i; ?>"  onclick="markAssignmentForDeletion('<?php echo $i?>')" name="checkbox_delete_<?php echo $i; ?>" /></td>
              </tr>
      <?php $i++; endforeach; ?>
      </table>
    <input type="button" name="add_another_assignment" id="add_another_assignment" value="Add Another Assignment" onclick="add_new_row('#assignmentsTable', add_assignment_row());" />
    </td>
    </tr>
    <br /></td>
  </tr>
  <tr>
    <td colspan="13"></form>
<hr />
  <table width="100%" border="0">
  <tr>
    <td colspan="13"><h2>Sample Assignments:</h2></td>
    <input type="hidden" id="sample_assignment_row_count" name="sample_assignment_row_count" value="<?php echo count($course->assignments); ?>"/>
  </tr>
  <tr height="10px"></tr>
  <tr>
    <td colspan="13"><table width="100%" border="1" id="sampleAssignments">
      
      
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
        <td width="33%"><div id="<?php echo "file_upload_box_A_".$i?>"><?php
        // Sample A block
        if ($assignment->sampleFileNames[0] != "")
            echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[0]."'>View File</a>";
        else
            echo "Upload sample solution worth of an &quot;A&quot;:
<input id='fileToUpload_A_".$i."' type='file' name='fileToUpload_A_".$i."' class='input'>"; ?>
        </td>
        <td width="33%"><div id="<?php echo "file_upload_box_B_".$i?>"><?php
        // Sample B block
        if ($assignment->sampleFileNames[1] != "")
            echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[1]."'>View File</a>";
        else
            echo "Upload sample solution worth of an &quot;B&quot;:<br />
<input id='fileToUpload_B_".$i."' type='file' name='fileToUpload_B_".$i."' class='input'>"; ?>
        </td>
        <td width="33%"><div id="<?php echo "file_upload_box_C_".$i?>"><?php
        // Sample C block
        if ($assignment->sampleFileNames[2] != "")
            echo "<a href = '../data/courses/".$course->courseID."/".$assignment->sampleFileNames[2]."'>View File</a>";
        else
            echo "Upload sample solution worth of an &quot;C&quot;:<br />
<input id='fileToUpload_C_".$i."' type='file' name='fileToUpload_C_".$i."' class='input'>"; ?>
		</td>
      </tr>
      <?php $i++; endforeach; ?>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="13"><input type="button" name="add_another_sample" id="add_another_sample" value="Add Another Sample" onClick="add_new_row('#sampleAssignments', genNewSampleRow('<?php echo $course->courseID; ?>'))" /></td>
  </tr>
  </table>
<hr />
<input type="submit" name="button_save" id="button_save" value="Save Course Info" />


</div>
</form>
<?php require_once("include/footer.php"); ?>
