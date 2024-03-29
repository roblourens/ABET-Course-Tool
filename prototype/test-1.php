<?php require_once("include/header.php");?>
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
   document.getElementById("dept").value = RegExp.$1;
   document.getElementById("courseNum").value = RegExp.$2;

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

addCourse.php
dept
courseNum
courseName
courseDesc
program


readCatalog.php
-->

<body>
<form>
Course (As it appears in ISU Catalog): 
<input type="text" id="deptcourse" name="deptcourse">
<input type="button" value="Retrieve course data from ISU Catalog" onClick="getXML('readCatalog.php');"/><br /><br/>
</form>
<!-- just have two separate forms -->
<br/><br/>
<form name="myform" id="myform" action="addCourse.php" method="get">
Course: <input type="text" id="dept" name="dept" size="3" readonly/>  <input type="text" id="courseNum" name="courseNum" size="4" readonly/><br/>
Course name: <input type="text" id="courseName" name="courseName" size="35" readonly/><br/>
Course description: <textarea id="courseDesc" name="courseDesc" cols="80", rows="10" readonly></textarea><br/>

Program ID: <select id="program" name="program">
    <option value="se">Software Engineering</option>
    <option value="ee">Electrical Engineering</option>
    <option value="cpre">Computer Engineering</option>
    <option value="coms">Computer Science</option>
</select>

<input type="submit" value="Add Course to Program"/>
</form>


</body>
</html>
