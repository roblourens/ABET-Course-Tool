<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>ABET</title>
    <link href="../prototype/css/abet.css" rel="stylesheet" type="text/css" />
	<script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="application/javascript" src="../prototype/scripts/js/abet.js"></script>
    <script type="application/javascript" src="../prototype/scripts/js/ajaxfileupload.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="title">
                <h1>
                    ABET Software Application
                </h1>
            </div>
            <div class="loginDisplay">
                [ <a href="" id="HeadLoginView_HeadLoginStatus">Log In</a> ]
            </div>
        </div>
<table width="100%" border="0" bgcolor="#CCCCCC">
  <tr>
    <td width="33%" align="center"><a href="../prototype/viewAllCourses.php">View All Courses</a></td>
    <td width="33%" align="center"><a href="../prototype/search.php">Search By Learning Outcome</a></td>
    <td width="33%" align="center"><a href="">View All Learning Outcomes</a></td>
  </tr>
</table>
<?php error_reporting(0);?>
<?php
require('../src/include.php');

if(isset($_REQUEST['dept'])) {
    $dept = $_REQUEST['dept'];
    $dept = strtolower($dept);
    $courseNum = $_REQUEST['courseNum'];
    $courseName = $_REQUEST['courseName'];
    $courseDesc = $_REQUEST['courseDesc'];
    $program = $_REQUEST['program'];

    // convert department ID from catalog ID to this system's ID
    $dept = strtolower(str_replace(' ', '', $dept));
    $courseID = $dept.$courseNum;

    $courseObj = getEmptyCourse();
    $courseObj->courseName = $courseName;
    $courseObj->description = $courseDesc;
    $courseObj->courseNum = $courseNum;
    $courseObj->courseID = $courseID;
    $courseObj->deptID = $dept;
}
?>
<html>
<head>
<script>
/* Declare a variable that will hold the XMLHttpRequest object  */
var ReqObject = false;

/* Consider various Browsers */
if (window.XMLHttpRequest)
{
    ReqObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)   // IE: XMLHttpRequest is not native?
{
    ReqObject = new ActiveXObject("Microsoft.XMLHTTP");
}



function getXML(source)
{
   var code = document.getElementById("dept").value + ' ' +
              document.getElementById("courseNum").value;
   if (ReqObject)
   {
      ReqObject.overrideMimeType("text/xml");
      ReqObject.open("GET", source + "?code=" + code);

      ReqObject.onreadystatechange = function()
      {
          if ( (ReqObject.readyState == 4) && (ReqObject.status == 200) )
          {
              parse(ReqObject.responseXML);
          }
      }
      ReqObject.send(null);
   }
}

function parse(xml)
{
   var place = document.getElementById("myarea");
   var course = xml.getElementsByTagName("course")[0];
   var name = course.attributes.getNamedItem("code").nodeValue;
   var desc = course.firstChild.nextSibling.nodeValue;

   // course name
   /\<strong\>.*?\.[ ]*(.*)\<\/strong\>/.test(desc);
   var courseName = RegExp.$1;

   // course description
   var ret = /\<em\>([\s\S]*)\<\/p\>/.test(desc);
   var courseDesc = RegExp.$1;
   courseDesc = courseDesc.replace(/\<\/em\>\<br \/\>/, ". "); 

   //alert("courseName: " + courseName + "\n" + "courseDesc: " + courseDesc);

   //place.innerHTML = desc;
   document.getElementById("courseName").value = courseName;
   document.getElementById("courseDesc").value = courseDesc;

}


</script>
</head>
<!--
This is a strange block!!!
<div class="courseblock">
<p class="courseblocktitle"><strong>S&#160;E&#160;329.  Software Project Management.</strong></p> <p class="courseblockdesc">
(Cross-listed with CPR&#160;E).  (3-0) Cr. 3.
  
<em>Prereq: Com S 309</em><br />Process-based software development. Capability Maturity Model (CMM). Project planning, cost estimation, and scheduling. Project management tools. Factors influencing productivity and success. Productivity metrics. Analysis of options and risks. Version control and configuration management. Inspections and reviews. Managing the testing process. Software quality metrics. Modern software engineering techniques and practices.
  Nonmajor graduate credit.</p>
</div>
-->

<body>
<?php
if(isset($_REQUEST['dept'])) {
    switch (addCourse($courseObj, $program))
    {
        case 0:
            echo "Success!\n";
            break;
        case 1:
            echo "Course already in program index\n";
            break;
        case 2:
            echo "Course file already exists, but was added to the program index\n";
            break;
    }
}
?>
