<?php require_once("include/header.php");?>
<?php error_reporting(0); ?>
<?php require_once("../src/include.php"); ?>
<?php $color = "#BBBBBB"; ?>
<table width="100%" border="1">
  <tr>
    <th scope="col">Student Outcomes</th>
    <th scope="col">A</th>
    <th scope="col">B</th>
    <th scope="col">C</th>
    <th scope="col">D</th>
    <th scope="col">E</th>
    <th scope="col">F</th>
    <th scope="col">G</th>
    <th scope="col">H</th>
    <th scope="col">I</th>
    <th scope="col">J</th>
    <th scope="col">K</th>
  </tr>
<?php foreach (getPrograms() as $prog): ?>
   <?php foreach (getCourseIDsForProgramID($prog['short']) as $courseID): ?>
        <?php $course = getCourseForID($courseID); ?>
        <?php $arr = $course->allOutcomes(); ?>
  			<tr>
    			<th scope="row" width = "15%"><?php echo strtoupper($course->designatorID)." ".$course->courseNum; ?></th>
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
