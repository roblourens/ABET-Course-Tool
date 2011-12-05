<?php

include('../src/include.php');
print("getDepartments()\n");
print_r(getDepartments());
print("\n");

print("getCourseNumsForDeptID('se')\n");
var_dump(getCourseNumsForDeptID('se'));
print("\n");

print("getCourseIDsForDeptID('se')\n");
var_dump(getCourseIDsForDeptID('se'));
print("\n");

print("getCourseForID('se329')->toJSON()\n");
print_r(getCourseForID('se329')->toJSON());
print("\n");
print("\n");

print("updateCourse(\$course)\n");
$course = getCourseForID('se329');
$course->description = "new description!";
updateCourse($course);
print("\n");

/*print("addUser('rlourens', '12345', ['se319'])\n");
print(addUser('rlourens', '12345', array('se319'))."\n");
print("\n");

print("login('rlourens', '12345')\n");
print_r(login('rlourens', '12345'));
print("\n");
*/

?>
