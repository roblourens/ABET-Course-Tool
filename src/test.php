<?php

include('model/data.php');

print("getDepartmentIDs()\n");
var_dump(getDepartmentIDs());
print("\n");

print("getCourseIDsForDeptID('se')\n");
var_dump(getCourseIDsForDeptID('se'));
print("\n");

?>
