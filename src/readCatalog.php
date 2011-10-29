<?php
$code = $_GET['code'];
$code = str_replace(" ", "%20", $code);
@readfile("http://catalog.iastate.edu/ribbit/ribbit.exe?page=getcourse.rjs&code=$code");
?>

