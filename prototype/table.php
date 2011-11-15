<?php require_once("include/header.php");?>
<?php error_reporting(0); ?>
<?php require_once("../src/include.php"); ?>
<?php $color = "#BBBBBB"; ?>
<table width="100%" border="1">
  <tr>
    <th scope="col">Student Outcomes</th>
    <th id="a" align="center" title="Ability to apply knowledge of mathematics, science, engineering.">A</th>
      <th align="center" title="An ability to design and conduct experiments, as well as to analyze and interpret data.">B</th>
      <th align="center" title="Ability to design a system, component or process to meet desired needs within realistic constraints.">C</th>
      <th align="center" title="Ability to function on multidisciplinary teams.">D</th>
      <th align="center" title="Ability to identify, formulate and solve engineering problems.">E</th>
      <th align="center" title="Understanding of professional and ethical responsibility.">F</th>
      <th align="center" title="Ability to communicate effectively.">G</th>
      <th align="center" title="The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.">H</th>
      <th align="center" title="Recognition of the need for and an ability to engage in lifelong learning.">I</th>
      <th align="center" title="Knowledge of contemporary issues.">J</th>
      <th align="center" title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">K</th>

  </tr>
<?php foreach (getPrograms() as $prog): ?>
   <?php foreach (getCourseIDsForProgramID($prog['short']) as $courseID): ?>
        <?php $course = getCourseForID($courseID); ?>
        <?php $arr = $course->allOutcomes(); ?>
  			<tr>
    			<th scope="row" width = "15%"><a href='<?php echo "course.php?course=".$course->courseID;?>'><?php echo strtoupper($course->designatorID)." ".$course->courseNum; ?></a></th>
    			<td <?php if(in_array("A", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("B", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("C", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("D", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("E", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("F", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("G", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("H", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("I", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("J", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("K", $arr)) echo "bgcolor = '$color'"; ?>></td>
  			</tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>
<?php require_once("include/footer.php"); ?>
