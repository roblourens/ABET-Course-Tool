<?php
require_once('include.php');

print_r(getCourseIDsForProgramID('se'));
removeCourseIDFromPID('relig210', 'se');
print_r(getCourseIDsForProgramID('se'));

?>
