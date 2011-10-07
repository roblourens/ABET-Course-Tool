<?php
if(!isset($_GET['course']))die("ERROR: Course name not given.");
$course_file = "../data/courses/".$_GET['course']."/".$_GET['course'].".json";
if(!file_exists($course_file))die("ERROR: The course ".$_GET['course']." does not exist.");
$fh = fopen($course_file, 'r') or die("ERROR: The data for the course ".$_GET['course']." could not be loaded.");
$theData = fgets($fh);
fclose($fh);
$course = json_decode($theData, true);
if(!is_numeric($course_array['number_of_rows']) || $course_array['number_of_rows'] < 1) $course_array['number_of_rows'] = 1;
?>

<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="application/javascript" src="js/abet.js"></script>

<h1>ABET Course Tool</h1>
<form action="" method="post">

<table width="100%" height="100%" border="1">
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
  <tr>
    <td width="317">Course Department:</td>
    <td width="487" colspan="10"><?php echo $course['course_department']; ?><input name="course_department" type="hidden" value="<?php echo $course['course_department']; ?>"/></td>
  </tr>
  <tr>
    <td>Course Number:</td>
    <td colspan="10"><?php echo $course['course_number']; ?><input name="course_number" type="hidden" value="<?php echo $course['course_number']; ?>"/></td>
  </tr>
  <tr>
    <td>Course Named:</td>
    <td colspan="10"><?php echo $course['course_named']; ?><input name="course_named" type="hidden" value="<?php echo $course['course_named']; ?>"/></td>
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
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
  <tr>
    <td colspan="13"><p>Assignments That Follow ABET</p></td>
  </tr>
 
  <tr>
    <td colspan="13">
    <input id="number_of_rows" name="number_of_rows" type="hidden" value="<?php echo $course['number_of_rows']; ?>"/>
    <?php error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);?>
    <table id="assignmentsTable" border="1">
      <tr>
        <td width="53">Index</td>
        <td width="54">Assignment Type</td>
        <td>Assignment#</td>
		<td id="a" align="center"  
			      title="Ability to apply knowledge of mathematics, science, engineering.">a</td>
                          <td id="b" align="center"
			      title="An ability to design and conduct experiments, as well as to analyze and interpret data.">b</td>
                          <td id="c" align="center"
			      title = "Ability to design a system, component or process to meet desired needs within realistic constraints.">c</td>
                          <td id="d" align="center"
			      title="Ability to function on multidisciplinary teams.">d</td>
                          <td id="e" align="center"
			      title="Ability to identify, formulate and solve engineering problems.">e</td>
                          <td id="f" align="center"
			      title="Understanding of professional and ethical responsibility.">f</td>
                          <td id="g" align="center"
			      title="Ability to communicate effectively.">g</td>
                          <td id="h" align="center"
			      title="The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.">h</td>
                          <td id="i" align="center"
			      title="Recognition of the need for and an ability to engage in lifelong learning.">i</td>
                          <td id="j" align="center"
			      title="Knowledge of contemporary issues.">j</td>
                          <td id="k" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">k</td>
      </tr>
      <?php error_reporting(E_ERROR);?>
      <?php for($i = 1 ; $i <= $course['number_of_rows'] ; $i++):?>
      <tr>
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
      <?php error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);?>
      </table></td>
  </tr>
  <tr>
    <td colspan="13"></form><input type="button" name="add_another_assignment" id="add_another_assignment" value="Add Another Assignment" onClick="add_new_row('#assignmentsTable', get_raw_html(get_num_rows()));" /></td>
  </tr>
  <tr>
    <td colspan="13">Sample Assignments:</td>
  </tr>
  <tr>
    <td colspan="13"><table width="100%" border="1" id="sampleAssignments">
      <tr>
        <td>Assignment Name:<br />
          <input type="text" name="textfield" id="textfield" /></td>
        <td>Assignment Type:<br />
          <select name="assignment_type_" id="assignment_type_">
            <option value="0" selected="selected">Select Value</option>
            <option value="homework">Homework</option>
            <option value="test">Test</option>
            <option value="lab">Lab</option>
            <option value="quiz">Quiz</option>
            <option value="midterm">Midterm</option>
            <option value="final">Final</option>
          </select></td>
        <td>Upload Assignment:<br />
          <input type="file" name="fileField4" id="fileField4" /><br /></td>
      </tr>
      <tr>
        <td>Upload sample solution worth of an &quot;A&quot;:<br />
          <input type="file" name="fileField" id="fileField" /></td>
        <td>Upload sample solution worth of an &quot;B&quot;:<br />
          <input type="file" name="fileField2" id="fileField2" /></td>
        <td>Upload sample solution worth of an &quot;C&quot;:<br />
          <input type="file" name="fileField3" id="fileField3" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="13"><input type="button" name="add_another_sample" id="add_another_sample" value="Add Another Sample" onClick="add_new_row('#sampleAssignments', genNewSampleRow());" /></td>
  </tr>
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
</table>
<p><input type="submit" /></p>
</form>