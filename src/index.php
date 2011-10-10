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

print("getCourseForID('se329')\n");
$course = getCourseForID('se329');
print_r($course->asdf);
print_r($course->deptID);
print_r($course->toJSON());
print("\n");

?>
