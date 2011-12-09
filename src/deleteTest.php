<?php
require_once('include.php');

print_r(getCourseIDsForProgramID('cpre'));
print_r(getCourseForID('relig210'));

removeCourseIDFromPID('relig210', 'cpre');

print_r(getCourseIDsForProgramID('cpre'));
print_r(getCourseForID('relig210'))

?>
