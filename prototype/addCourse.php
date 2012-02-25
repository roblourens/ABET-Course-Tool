<?php require_once("include/header.php");?>
<?php
require('../src/include.php');

if(isset($_REQUEST['designator'])) {
    $designator = $_REQUEST['designator'];
    $designator = strtolower($designator);
    $courseNum = $_REQUEST['courseNum'];
    $courseName = $_REQUEST['courseName'];
    $creditsContact = $_REQUEST['creditsContact'];
    $courseDesc = $_REQUEST['courseDesc'];
    $program = $_REQUEST['program'];
    $reqType = $_REQUEST['reqType'];

    // convert department ID from catalog ID to this system's ID
    $designator = strtolower(str_replace(' ', '', $designator));
    $courseID = $designator.$courseNum;

    $courseObj = new Course();
    $courseObj->courseName = $courseName;
    $courseObj->creditsContact = $creditsContact;
    $courseObj->description = $courseDesc;
    $courseObj->courseNum = $courseNum;
    $courseObj->courseID = $courseID;
    $courseObj->designatorID = $designator;
    $courseObj->reqForProgram[$program] = $reqType;
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
   var code = document.getElementById("deptcourse").value;
   /(.*)[ ]([0-9]{3})*/.test(code);
   document.getElementById("designator").value = RegExp.$1;
   document.getElementById("courseNum").value = RegExp.$2;
   if (ReqObject)
   {
      ReqObject.overrideMimeType("text/xml");
      ReqObject.open("GET", source + "?code=" + code);

      ReqObject.onreadystatechange = function()
      {
          if ( (ReqObject.readyState == 4) && (ReqObject.status == 200) )
          {
              if (ReqObject.responseXML==null)
                  alert("responseXML is null");
              console.log(ReqObject.responseXML);
              parse(ReqObject.responseXML);
          }
      }
      ReqObject.send(null);
   }
}

function parse(xml)
{
   var course = xml.getElementsByTagName("course")[0];
   var name = course.attributes.getNamedItem("code").nodeValue;
   var desc = course.firstChild.nextSibling.nodeValue;
   alert(desc);

   // course name
   /\<strong\>.*?\.[ ]*(.*)\<\/strong\>/.test(desc);
   var courseName = RegExp.$1;

   // course description
   var ret = /\<em\>([\s\S]*)\<\/p\>/.test(desc);
   var courseDesc = RegExp.$1;
   courseDesc = courseDesc.replace(/\<\/em\>\<br \/\>/, ". "); 

   // credits
   /(\(\d-\d\).*)/.test(desc);
   var creditsContact = RegExp.$1;

   //alert("courseName: " + courseName + "\n" + "courseDesc: " + courseDesc);
   document.getElementById("courseName").value = courseName;
   document.getElementById("courseDesc").value = courseDesc;
   document.getElementById("creditsContact").value = creditsContact;
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
<strong>
<?php
if(isset($_REQUEST['designator'])) {
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
</strong>

<form>
Course (As it appears in ISU Catalog): 
<input type="text" id="deptcourse" name="deptcourse">
<input type="button" value="Retrieve course data from ISU Catalog" onClick="getXML('readCatalog.php');"/><br /><br/>
</form>
<!-- just have two separate forms -->
<br/><br/>
<form name="myform" id="myform" action="addCourse.php" method="get">
Course: <input type="text" id="designator" name="designator" size="3" readonly/>  <input type="text" id="courseNum" name="courseNum" size="4" readonly/><br/>
Course name: <input type="text" id="courseName" name="courseName" size="35" readonly/><br/>
Credits and contact hours: <input type="text" id="creditsContact" name="creditsContact" size="20" readonly /><br/>
Course description: <textarea id="courseDesc" name="courseDesc" cols="80", rows="10" readonly></textarea><br/>

Program ID: <select id="program" name="program">
    <option value="se">Software Engineering</option>
    <option value="ee">Electrical Engineering</option>
    <option value="cpre">Computer Engineering</option>
    <option value="coms">Computer Science</option>
</select>
<br />
<input type="radio" value="E" name="reqType">Elective</input>
<br />
<input type="radio" value="R" name="reqType">Required</input>
<br />
<input type="submit" value="Add Course to Program"/>
</form>


</body>
</html>
