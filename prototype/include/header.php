<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>ABET</title>
    <link href="css/abet.css" rel="stylesheet" type="text/css" />
	<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="application/javascript" src="scripts/js/abet.js"></script>
    <script type="application/javascript" src="scripts/js/ajaxfileupload.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body onload="hideInfoBar();">
    <div class="page">
        <div class="header">
            <div class="title">
         
            <img src="images/banner.jpg" border="0px" width="960px"/>
            </div>
            <div class="loginDisplay">
                [ <a href="" id="HeadLoginView_HeadLoginStatus">Log In</a> ]
            </div>
        </div>
<table width="100%" border="0" bgcolor="#CCCCCC">
  <tr>
    <td width="25%" align="center"><a href="viewAllCourses.php">View All Courses</a></td>
    <td width="25%" align="center"><a href="search.php">Search By Learning Outcome</a></td>
    <td width="25%" align="center"><a href="table.php">View All Learning Outcomes</a></td>
    <td width="25%" align="center"><a href="addCourse.php">Add a course</a></td>
  </tr>
</table>
<div id="flash_bar">
<div id="notice_bar" align="center">
        Updated Information Was Saved Successfully
</div>
</div>
<?php error_reporting(0);
date_default_timezone_set('America/Chicago');
?>

    <script>
	function fade(){
        //$(document).ready(function() {
			
			$("#notice_bar").fadeIn(500);
            $("#notice_bar").fadeOut(7000);
			
           // event.preventDefault();
        //});
	}
	function hideInfoBar()
	{
		$("#notice_bar").fadeOut(0);	
	}
    </script>
