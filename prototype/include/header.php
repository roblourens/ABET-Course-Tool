<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>ABET</title>
    <link href="css/abet.css" rel="stylesheet" type="text/css" />
	<script type="application/javascript" src="scripts/js/jquery.min.js"></script>
	<script type="application/javascript" src="scripts/js/abet.js"></script>
    <script type="application/javascript" src="scripts/js/ajaxfileupload.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="title">
         
            <img src="images/banner.jpg" border="0px" width="960px"/>
            </div>
            <div class="loginDisplay">
                &nbsp;
            </div>
        </div>
<table width="100%" border="0" bgcolor="#CCCCCC">
  <tr>
    <td width="25%" align="center"><a href="viewAllCourses.php">View all courses</a></td>
    <td width="20%" align="center"><a href="search.php">Search by Student Outcome</a></td>
    <td width="20%" align="center"><a href="table.php">View all Student Outcomes</a></td>
    <td width="20%" align="center"><a href="addCourse.php">Add a course</a></td>
    <td width="20%" align="center"><a href="ReadMe" target="_blank"><b>Help</b></a></td>
  </tr>
</table>
<div id="notice_bar_wrapper">
<div id="notice_bar" align="center">
</div>
</div>

<?php 
error_reporting(0);
date_default_timezone_set('America/Chicago');
?>

<script>
function hideInfoBar()
{
    $("#notice_bar").hide();	
}

function showInfoBar(msg)
{
    $('#notice_bar').html(msg);
    $("#notice_bar").fadeIn(500);
    $("#notice_bar").fadeOut(8000);
}
</script>
