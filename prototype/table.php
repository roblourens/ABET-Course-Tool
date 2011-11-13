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
<?php if ($handle = opendir('../data/courses/')): ?>
   <?php while (false !== ($file = readdir($handle))): ?>
        <?php if(!is_dir($file)): ?>
        <?php $course = getCourseForID($file); ?>
        <?php $arr = $course->courseLearningOutcomes; ?>
  			<tr>
    			<th scope="row" width = "15%"><?php echo strtoupper($course->deptID)." ".$course->courseNum; ?></th>
    			<td <?php if(in_array("a", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("b", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("c", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("d", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("e", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("f", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("g", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("h", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("i", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("j", $arr)) echo "bgcolor = '$color'"; ?>></td>
                <td <?php if(in_array("k", $arr)) echo "bgcolor = '$color'"; ?>></td>
  			</tr>
  		<?php endif; ?>
    <?php endwhile; ?>
<?php closedir($handle); ?>
<?php endif ?>
</table>
<?php require_once("include/footer.php"); ?>
