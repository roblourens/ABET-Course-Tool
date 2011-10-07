<?php require_once('../src/model/data.php'); ?>
<?php $course = getCourseForID("se329");?>
<?php 
$COURSE_DEPARTMENT =  $course->deptID;
$COURSE_NUMBER = $course->courseNum;
$COURSE_NAMED = $course->courseID;
$COURSE_DESCRIPTION = $course->description;
$SYLLABUS_AND_GRADING_GUIDELINES = $course->syllabus;
$COURSE_LEARNING_OUTCOMES = $course->courseLearningOutcomes;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.hidden{
	visibility:hidden;
}
</style>

<script src="js/ABETJavascripts.js" type="text/javascript" ></script>

</head>

<body>
<h1>ABET Course Tool</h1>
<table width="100%" height="100%" border="1">
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
  <tr>
    <td width="317">Course Department:</td>
    <td width="487" colspan="10"><?php echo $COURSE_DEPARTMENT; ?></td>
  </tr>
  <tr>
    <td>Course Number:</td>
    <td colspan="10"><?php echo $COURSE_NUMBER; ?></td>
  </tr>
  <tr>
    <td>Course Named:</td>
    <td colspan="10"><?php echo $COURSE_NAMED; ?></td>
  </tr>
  <tr>
    <td>Course Description:</td>
    <td colspan="10"><textarea name="course_description" id="course_description" cols="45" rows="5"><?php echo $COURSE_DESCRIPTION; ?></textarea></td>
  </tr>
  <tr>
    <td>Syllabus &amp; Grading Guidelines:</td>
    <td colspan="10"><textarea name="syllabus_and_grading" id="syllabus_and_grading" cols="45" rows="5"><?php echo $SYLLABUS_AND_GRADING_GUIDELINES; ?></textarea></td>
  </tr>
  <tr>
    <td>Course Learning Outcomes</td>
    <td colspan="10"><textarea name="course_learning_outcomes" id="course_learning_outcomes" cols="45" rows="5"><?php print_r($COURSE_LEARNING_OUTCOMES); ?></textarea></td>
  </tr>
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
  <tr>
    <td colspan="13"><p>Assignments That Follow ABET</p></td>
  </tr>
 
  <tr>
    <td colspan="13"><table id="assignmentsTable" border="1">
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
      <tr>
        <td>1</td>
        <td><select name="assignment_type_3" id="assignment_type_3">
          <option value="0" selected="selected">Select Value</option>
          <option value="homework">Homework</option>
          <option value="test">Test</option>
          <option value="lab">Lab</option>
          <option value="quiz">Quiz</option>
          <option value="midterm">Midterm</option>
          <option value="final">Final</option>
        </select></td>
        <td><select name="select" id="select">
          <option value="0">Select Number</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox13" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox14" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox15" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox16" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox17" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox18" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox19" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox20" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox21" /></td>
        <td><input type="checkbox" name="checkbox12" id="checkbox22" /></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="13"><input type="submit" name="add_another_assignment" id="add_another_assignment" value="Add Another Assignment" onClick="add_new_row('#assignmentsTable', get_raw_html());" /></td>
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
          <select name="assignment_type_2" id="assignment_type_2">
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
    <td colspan="13"><input type="submit" name="add_another_sample" id="add_another_sample" value="Add Another Sample" onClick="add_new_row('#sampleAssignments', genNewSampleRow());" /></td>
  </tr>
  <tr>
    <td colspan="13"><input type="submit" name="button_save" id="button_save" value="Save Course Info" /></td>
  </tr>
</table>
</body>
</html>
