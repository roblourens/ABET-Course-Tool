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

    // update reqForProgram on the course object (won't change it if 'none')
    foreach (array('se', 'ee', 'cpre', 'coms') as $program)
    {
        $reqType = $_REQUEST[$program."_reqType"];
        if ($reqType != 'noChange')
            $courseObj->reqForProgram[$program] = $reqType;
    }

    $resultMsg = "Adding " . getDesignatorDisplayString($program)." ".$courseNum.":<br />";
    foreach (array('se', 'ee', 'cpre', 'coms') as $program)
    {
        $reqType = $_REQUEST[$program."_reqType"];
        if ($reqType != 'noChange')
        {
            $result = addCourse($courseObj, $program);

            switch ($result)
            {
                case 0:
                    $resultMsg .= getDesignatorDisplayString($program).": Success!<br />";
                    break;
                case 1:
                    $resultMsg .= getDesignatorDisplayString($program).": Course already in program index<br />";
                    break;
                case 2:
                    $resultMsg .= getDesignatorDisplayString($program).": Course file already exists, but was added to the program index<br />";
                    break;
            }
        }
    }
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
      if (ReqObject.overrideMimeType)
        ReqObject.overrideMimeType("text/xml");

      ReqObject.open("GET", source + "?code=" + code);
      ReqObject.onreadystatechange = function()
      {
          if ( (ReqObject.readyState == 4) && (ReqObject.status == 200) )
          {
              if (ReqObject.responseXML==null)
                  alert("responseXML is null");
              console.log(ReqObject.responseXML);

              if (ReqObject.responseXML.documentElement.childElementCount == 0)
                  alert('The catalog did not return a result for that course');
              else
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
   //alert(desc);

   // course name
   /\<strong\>.*?\.[ ]*(.*)\<\/strong\>/.test(desc);
   var courseName = RegExp.$1;

   // course description
   var ret = /\<em\>([\s\S]*)\<\/p\>/.test(desc);
   var courseDesc = RegExp.$1;
   if (courseDesc == courseName)
   {
       ret = /\<br \/\>([\s\S]*)\<\/p\>/.test(desc);
       courseDesc = RegExp.$1;
   }
   courseDesc = courseDesc.replace(/\<\/em\>\<br \/\>/, ". "); 

   // credits
   /(\(\d-\d\).*)/.test(desc);
   var creditsContact = RegExp.$1;

   //alert("courseName: " + courseName + "\n" + "courseDesc: " + courseDesc);
   document.getElementById("courseName").value = courseName;
   document.getElementById("courseDesc").value = courseDesc;
   document.getElementById("creditsContact").value = creditsContact;
}

$(document).ready(function() {
    $('#addCourseForm').submit(function() {
        if ($('input[name=se_reqType][value=noChange]').attr('checked') &&
            $('input[name=cpre_reqType][value=noChange]').attr('checked') &&
            $('input[name=ee_reqType][value=noChange]').attr('checked') &&
            $('input[name=coms_reqType][value=noChange]').attr('checked'))
        {
            alert('You should check an option for this course!');
            return false;
        }

        return true;
    });
});

<?php
if (isset($_REQUEST['designator'])) {
    echo "$(document).ready(function() {";
        echo "showInfoBar('".$resultMsg."');";
    echo "});";
}
?>

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

</strong>

<form action="javascript:getXML('readCatalog.php');">
Course (As it appears in ISU Catalog): 
<input type="text" id="deptcourse" name="deptcourse">
<input type="submit" value="Retrieve course data from ISU Catalog" /><br /><br/>
</form>
<!-- just have two separate forms -->
<br/><br/>
<form name="myform" id="addCourseForm" action="addCourse.php" method="post">
Course: <input type="text" id="designator" name="designator" size="3" readonly/>  <input type="text" id="courseNum" name="courseNum" size="4" readonly/><br/>
Course name: <input type="text" id="courseName" name="courseName" size="35" readonly/><br/>
Credits and contact hours: <input type="text" id="creditsContact" name="creditsContact" size="20" readonly /><br/>
Course description: <textarea id="courseDesc" name="courseDesc" cols="80", rows="10" readonly></textarea><br/>

<br />
<table>
<tr>
<td>Software Engineering: </td><td><input type="radio" value="noChange" name="se_reqType" checked>No Change</input> <input type="radio" value="R" name="se_reqType">Required</input> <input type="radio" value="E" name="se_reqType">Elective</input></td>
</tr>

<tr>
<td>Computer Engineering: </td><td><input type="radio" value="noChange" name="cpre_reqType" checked>No Change</input> <input type="radio" value="R" name="cpre_reqType">Required</input> <input type="radio" value="E" name="cpre_reqType">Elective</input></td>
</tr>

<tr>
<td>Electrical Engineering: </td><td><input type="radio" value="noChange" name="ee_reqType" checked>No Change</input> <input type="radio" value="R" name="ee_reqType">Required</input> <input type="radio" value="E" name="ee_reqType">Elective</input></td>
</tr>

<tr>
<td>Computer Science: </td><td><input type="radio" value="noChange" name="coms_reqType" checked>No Change</input> <input type="radio" value="R" name="coms_reqType">Required</input> <input type="radio" value="E" name="coms_reqType">Elective</input></td>
</tr>
</tr>
</table>

<br />
<input type="submit" value="Add Course to Program"/>
</form>


</body>
</html>
