<?php
require('./include.php');

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
            echo "Course file already exists, but is not in program index\n";
            break;
    }
}
?>

<form name="myform" id="myform" action="addCourse.php" method="GET">
Course dept (COM S, CPR E, S E): <input id="dept" name="dept" type="text"/><br />
Course num (309, 418): <input id="courseNum" name="courseNum" type="text"/><br />
<input type="button" value="Retrieve course data" onClick="getXML('readCatalog.php');"/><br /><br />
Course name: <input type="text" id="courseName" name="courseName" /><br />
Course description: <input type="text" id="courseDesc" name="courseDesc" /><br />
Program ID: <select id="program" name="program">
    <option value="se">Software Engineering</option>
    <option value="ee">Electrical Engineering</option>
    <option value="cpre">Computer Engineering</option>
    <option value="coms">Computer Science</option>
</select>

<input type="submit" value="Add course"/>
</form>


</body>
</html>
