<?php

include('model/data.php');

print("getDepartmentIDs()\n");
var_dump(getDepartmentIDs());
print("\n");

print("getCourseIDsForDeptID('se')\n");
var_dump(getCourseIDsForDeptID('se'));
print("\n");

print("getCourseForID('se329')\n");
print_r(getCourseForID('se329'));
print("\n");

?>
