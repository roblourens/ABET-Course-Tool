<?php require_once("include/header.php");?>
<h1>
<?php
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course_file = "../data/courses/".$_GET['course']."/".$_GET['course'].".json";
if(!file_exists($course_file))die("ERROR: The course ".$_GET['course']." does not exist.");
$fh = fopen($course_file, 'r') or die("ERROR: The data for the course ".$_GET['course']." could not be loaded.");
$theData = fgets($fh);
fclose($fh);
$course = json_decode($theData, true);
if(!is_numeric($course['assignment_row_count']) || $course['assignment_row_count'] < 1) $course['assignment_row_count'] = 1;
if(!is_numeric($course['sample_assignment_row_count']) || $course['sample_assignment_row_count'] < 1) $course['sample_assignment_row_count'] = 1;
?>
<h1>



        <div class="main">
            <h2>
                Course Information
            </h2>
            <hr />
            


<form>

<table width="100%" border="0">
  <tr>
    <td width="317">Course Department:</td>
    <td width="487" colspan="10"><?php echo $course['course_department']; ?><input name="course_department" type="hidden" value="<?php echo $course['course_department']; ?>"/></td>
  </tr>
  <tr>
    <td>Course Number:</td>
    <td colspan="10"><?php echo $course['course_number']; ?><input name="course_number" type="hidden" value="<?php echo $course['course_number']; ?>"/></td>
  </tr>
  <tr>
    <td>Course Description:</td>
    <td colspan="10"><textarea name="course_description" cols="45" rows="5"><?php echo $course['course_description']; ?></textarea></td>
  </tr>
  <tr>
    <td>Syllabus &amp; Grading Guidelines:</td>
    <td colspan="10"><textarea name="syllabus_and_grading" cols="45" rows="5"><?php echo $course['syllabus_and_grading']; ?></textarea></td>
  </tr>
  <tr>
    <td>Course Learning Outcomes</td>
    <td colspan="10"><textarea name="course_learning_outcomes" cols="45" rows="5"><?php echo $course['course_learning_outcomes']; ?></textarea></td>
  </tr>
   <tr>
    <td colspan="13"><input type="button" name="button_save" id="displayText" onClick="javascript:toggle();" value="Show More Info" /></td>
  </tr>
  </table>
  <div id="toggleText" style="display: none">
  <hr />
  <table width="100%" border="0">
  <tr>
    <td colspan="13"><h2>Assignments That Follow ABET:</h2></td>
  </tr>
 <tr height="10px"></tr>
  <tr>
    <td colspan="13">
    
    
    
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
                 
      </tr>
     
      <?php for($i = 1 ; $i <= $course['assignment_row_count'] ; $i++):?>
      <tr <?php if($i % 2 == 0)echo "bgcolor=\"#b6b7bc\"" ?>>
        <td><?php echo $i; ?></td>
        <td>
        <select id = "assignment_type_<?php echo $i; ?>" name="assignment_type_<?php echo $i; ?>">
          <option <?php if($course['assignment_type_'.$i] == 0) echo "selected"; ?> value="0" selected="selected">Select Value</option>
          <option <?php if($course['assignment_type_'.$i] == "homework") echo "selected"; ?> value="homework">Homework</option>
          <option <?php if($course['assignment_type_'.$i] == "test") echo "selected"; ?> value="test">Test</option>
          <option <?php if($course['assignment_type_'.$i] == "lab") echo "selected"; ?> value="lab">Lab</option>
          <option <?php if($course['assignment_type_'.$i] == "quiz") echo "selected"; ?> value="quiz">Quiz</option>
          <option <?php if($course['assignment_type_'.$i] == "midterm") echo "selected"; ?> value="midterm">Midterm</option>
          <option <?php if($course['assignment_type_'.$i] == "final") echo "selected"; ?> value="final">Final</option>
        </select></td>
        <td><select name="assignment_number_<?php echo $i; ?>" id="select">
          <option <?php if($course['assignment_number_'.$i] == 0) echo "selected"; ?> value="0">Select Number</option>
          <option <?php if($course['assignment_number_'.$i] == 1) echo "selected"; ?> value="1">1</option>
          <option <?php if($course['assignment_number_'.$i] == '2') echo "selected"; ?> value="2">2</option>
          <option <?php if($course['assignment_number_'.$i] == 3) echo "selected"; ?> value="3">3</option>
          <option <?php if($course['assignment_number_'.$i] == 4) echo "selected"; ?> value="4">4</option>
          <option <?php if($course['assignment_number_'.$i] == 5) echo "selected"; ?> value="5">5</option>
          <option <?php if($course['assignment_number_'.$i] == 6) echo "selected"; ?> value="6">6</option>
          <option <?php if($course['assignment_number_'.$i] == 7) echo "selected"; ?> value="7">7</option>
          <option <?php if($course['assignment_number_'.$i] == 8) echo "selected"; ?> value="8">8</option>
          <option <?php if($course['assignment_number_'.$i] == 9) echo "selected"; ?> value="9">9</option>
          <option <?php if($course['assignment_number_'.$i] == 10) echo "selected"; ?> value="10">10</option>
        </select></td>
        <td><input type="checkbox" <?php if($course['checkboxA_'.$i] == 'on')echo "checked"?> name="checkboxA_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxB_'.$i] == 'on')echo "checked"?> name="checkboxB_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxC_'.$i] == 'on')echo "checked"?> name="checkboxC_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxD_'.$i] == 'on')echo "checked"?> name="checkboxD_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxE_'.$i] == 'on')echo "checked"?> name="checkboxE_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxF_'.$i] == 'on')echo "checked"?> name="checkboxF_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxG_'.$i] == 'on')echo "checked"?> name="checkboxG_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxH_'.$i] == 'on')echo "checked"?> name="checkboxH_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxI_'.$i] == 'on')echo "checked"?> name="checkboxI_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxJ_'.$i] == 'on')echo "checked"?> name="checkboxJ_<?php echo $i; ?>" /></td>
        <td><input type="checkbox" <?php if($course['checkboxK_'.$i] == 'on')echo "checked"?> name="checkboxK_<?php echo $i; ?>" /></td>
              </tr>
      <?php endfor; ?>
      </table></td>
  </tr>
  </table>
  <hr />
  <table width="100%" border="0">
  <tr>
    <td colspan="13"><h2>Sample Assignments:</h2></td>
    <input type="hidden" id="sample_assignment_row_count" name="sample_assignment_row_count" value="<?php echo $course['sample_assignment_row_count']?>"/>
  </tr>
  <tr height="10px"></tr>
  <tr>
    <td colspan="13"><table width="100%" border="1" id="sampleAssignments">
      
      <?php $i = 0;?>
      <?php for($i = 1 ; $i <= $course['sample_assignment_row_count'] ; $i++): ?>
      <tr <?php //if($i % 2 == 0)echo "bgcolor=\"#b6b7bc\"" ?>>

        <td>Assignment Name:<br />
          <?php echo $course['sample_assignment_name_'.$i];?></td>
        <td>Assignment Type:<br />
          
            <?php if($course['sample_assignment_type_'.$i] == '0') echo "Not Known"; ?> 
            <?php if($course['sample_assignment_type_'.$i] == 'homework') echo "Homework"; ?> 
            <?php if($course['sample_assignment_type_'.$i] == 'test') echo "Test"; ?>
            <?php if($course['sample_assignment_type_'.$i] == 'lab') echo "Lab"; ?>
            <?php if($course['sample_assignment_type_'.$i] == 'quiz') echo "Quiz"; ?>
            <?php if($course['sample_assignment_type_'.$i] == 'midterm') echo "Midterm"; ?> 
            <?php if($course['sample_assignment_type_'.$i] == 'final') echo "Fianl"; ?>
         </td>
        <td>Upload Assignment:
<iframe height="60px"  frameBorder="0" src="file/ajaxfileupload.php?view_only=true&course=<?php echo $_GET['course'];?>&filetype=<?php echo "sample_assignment_filelocation_".$i?>">
</iframe>
          
          
         </td>
      </tr >
      <tr <?php //if($i % 2 == 0)echo "bgcolor=\"#b6b7bc\"" ?>>
        <td>Upload sample solution worth of an &quot;A&quot;:<br />
          <input type="file" name="fileField" id="fileField" /></td>
        <td>Upload sample solution worth of an &quot;B&quot;:<br />
          <input type="file" name="fileField2" id="fileField2" /></td>
        <td>Upload sample solution worth of an &quot;C&quot;:<br />
          <input type="file" name="fileField3" id="fileField3" /></td>
      </tr>
      <?php endfor; ?>
    </table></td>
  </tr>
  
  </table>
<hr />



</div>
</form>
<?php require_once("include/footer.php"); ?>