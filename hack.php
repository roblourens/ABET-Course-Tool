<?php
if(isset($_REQUEST['code'])) {
$courseId = $_REQUEST['code'];
$courseId = str_replace(' ','',$courseId);
$courseId = strtolower($courseId);
$courseName = $_REQUEST['courseName'];
$courseDesc = $_REQUEST['courseDesc'];
//echo $courseId;

$data = "{\"deptID\":\"\",\"courseNum\":\"\",\"courseID\":\"$courseId\",\"courseName\":\"$courseName\",\"description\":\"$courseDesc\"}";

$myFile = $courseId.".json";
if(!file_exists("data/courses/$courseId"))mkdir("data/courses/".$courseId);
if(!file_exists("data/courses/$courseId/".$myFile)){
	$fh = fopen("data/courses/$courseId/".$myFile, 'w');
	$stringData = $data;
	fwrite($fh, $stringData);
	fclose($fh);
}
$program = $_REQUEST['program'];


$myFile = "data/program/".$program.".json";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
$json = json_decode($theData);

$add = true;
foreach($json as $x){
	if($x == $courseId){
		$add = false;	
	}
}
if($add){
	$json[] = $courseId;
}
fclose($fh);
$fh = fopen($myFile, 'w');
fwrite($fh, json_encode($json));
fclose($fh);


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
   var code = document.getElementById("code").value;
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
   document.getElementById("courseId").value = courseDesc;

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

<form name="myform" id="myform" action="hack.php" method="GET">
Course code [all in uppercase (COM S 309, CPR E 310, S E 319)]: <input id="code" name="code" type="text"/>
<input type="button" value="retrieve" onClick="getXML('test.php');"/><br>
<input type="text" id="courseName" name="courseName" /><br>
<input type="text" id="courseDesc" name="courseDesc" /><br>
<input type="text" id="program" name="program"/>

<input type="submit">
</form>


</body>
</html>
