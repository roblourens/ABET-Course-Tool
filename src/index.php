<?php

include('model/data.php');

print("getDepartmentIDs()\n");
var_dump(getDepartmentIDs());
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

print("addUser('rlourens', '12345', ['se319'])\n");
print(addUser('rlourens', '12345', array('se319'))."\n");
print("\n");

print("login('rlourens', '12345')\n");
print_r(login('rlourens', '12345'));
print("\n");

?>
