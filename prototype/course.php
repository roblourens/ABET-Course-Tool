<?php require_once("../src/model/Course.php"); ?>
<?php require_once("../src/model/data.php"); ?>
<?php $course = getCourseForID("se329"); ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>ABET: View/Mod Course Info</title>
        <link href="Site.css" rel="stylesheet" type="text/css" />
        <script src="jquery.js" type="text/javascript"></script>


<script language="JavaScript" type="text/javascript">
function unhide()
{
  attr = document.getElementById("hidden").getAttribute("class");
  if (attr == "hidden")
  {
    document.getElementById("hidden").setAttribute("class", "unhidden");
    document.getElementById("hidingbutton").value = "Hide Information";
  }
  else
  {
    document.getElementById("hidden").setAttribute("class", "hidden");
    document.getElementById("hidingbutton").value = "Add Information";
  }
}

function addAssignment()
{
	  
var i = 1;
$("button").click(function() {
  $("table tr:first").clone().find("input").each(function() {
    $(this).attr({
      'id': function(_, id) { return id + i },
      'name': function(_, name) { return name + i },
      'value': ''               
    });
  }).end().appendTo("table");
  i++;
});

}

function createAssignmentType(j) 
{ 
   var select = document.createElement("select");
   select.id = "assignmentType" + j; 

   for (var i=0; i<7; i++)
   { 
      var option0 = document.createElement("option");
      
      if (i==0) 
      {
        option0.value="none";
        var text = document.createTextNode("Select Type");
      }
      if (i==1) 
      {
        option0.value="hw";
        var text = document.createTextNode("Homework");
      }
      if (i==2) 
      {
        option0.value="lab";
        var text = document.createTextNode("Lab");
      }
      if (i==3) 
      {
        option0.value="test";
        var text = document.createTextNode("Test");
      }
      if (i==4) 
      {
        option0.value="quiz";
        var text = document.createTextNode("Quiz");
      }
      if (i==5) 
      {
        option0.value="mt";
        var text = document.createTextNode("Midterm");
      }
      if (i==6) 
      {
        option0.value="final";
        var text = document.createTextNode("Final");
      }
      option0.appendChild(text);
      select.appendChild(option0);
   }
   return select;
}
function createAssignmentNumber(i) {}
function createButton(i) {}
function createCheckbox(i, j) {}


function add_new_row(table,rowcontent){
        if ($(table).length>0){
            if ($(table+' > tbody').length==0) $(table).append('<tbody />');
            ($(table+' > tr').length>0)?$(table).children('tbody:last').children('tr:last').append(rowcontent):$(table).children('tbody:last').append(rowcontent);
        }
    }
	
	function genNewAssignRow()
	{
	return '<div class="assignmentTableRow" >'+
            '                <div class="assignementTableAssigmentNameCell" style=" ">'+
           '                     <div class="assignmentTableAssignmentNameText" style=" ">Assignment Name:</div>'+
''+
 '                               <div class="assignmentTableAssignmentNameField" style=" "><input type="text" value="Homework 1"></input></div>'+
  '                          </div>'+
   '                         <div class="assignementTableAssigmentTypeCell" style=" ">'+
    '                            <div class="assignmentTableAssignmentTypeText" style=" ">Assignment Type:</div>'+
     '                           <div class="assignmentTableAssignmentNameField" style=" ">'+
      '                          </div>'+
       '                         <select>'+
        '                            <option selected="selected" value="black">Select...</option>'+
''+
 '                                   <option value="Homework">Homework</option>'+
  '                                  <option value="saab">Lab</option>'+
   '                                 <option value="mercedes">Test</option>'+
    '                                <option value="audi">Quiz</option>'+
     '                               <option value="audi">Midterm</option>'+
      '                              <option value="audi">Final</option>'+
''+
 '                               </select>'+
  '                          </div>'+
   '                         <div class="assignementTableUploadAssignmentCell" style=" ">'+
''+
 '                                                                   <div class="assignmentTableUploadAssignmentText" style=" ">Assignment File:</div>'+
  '                                  <div style=" "><a href="x">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>'+
''+
 '                                                           </div>'+
''+
''+
''+
 '                           <div class="assignementTableAssigmentSampleA" style=" ">'+
  '                                      <div>Sample solution worthy of an "A":</div>'+
   '                                 <div><a href="">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>'+
''+
 '                                                           </div>'+
  '                          <div class="assignementTableAssigmentSampleB" style=" ">'+
   '                                     <div>Upload a sample solution worth of a "B":</div>'+
    '                                <div><input type="file"/></div>'+
     '                                               </div>'+
      '                      <div class="assignementTableAssigmentSampleC" style=" ">'+
''+
 '                                       <div>Sample solution worth of a "C":</div>'+
''+
 '                                   <div><a href="">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>'+
  '                              </div>'+
''+
 '                       </div>';	
	}
	
	function genNewRow()
	{
		return    '<tr></tr><tr>'
                          +
                  '        '+
                  '    </tr>'+
              '        <tr> '+
             '             <td>'+
			'    <select id="assignmentType1">'+
           '                   <option selected="selected"'+
          '                    value="none">Select Type</option>'+
         '                     <option value="hw">Homework</option>'+
        '                      <option value="lab">Lab</option>'+
       '                       <option value="test">Test</option>'+
       '                       <option value="quiz">Quiz</option>'+
     '                        <option value="mt">Midterm</option>'+
    '                          <option value="final">Final</option>'+
   '                         </select>'+
  '                          <select id="assignmentNumber1">'+
 '                             <option selected="selected"'+
                          '    value="none">Select Number</option>'+
                         '     <option value="1">0</option>'+
                        '      <option value="1">1</option>'+
                       '       <option value="1">2</option>'+
                      '        <option value="1">3</option>'+
                     '         <option value="1">4</option>'+
                    '          <option value="1">5</option>'+
                   '           <option value="1">6</option>'+
                  '            <option value="1">7</option>'+
                 '             <option value="1">8</option>'+
                '              <option value="1">9</option>'+
               '               <option value="1">10</option>'+
              '              </select>            '+
             '               <input type="button" value="Update information"</input>'+
            '              </td>'+
           '               <td><input type="checkbox"/></td>'+
          '                <td><input type="checkbox"/></td>'+
         '                 <td><input type="checkbox"/></td>'+
        '                  <td><input type="checkbox"/></td>'+
                          '<td><input type="checkbox"/></td>'+
                          '<td><input type="checkbox"/></td>'+
                          '<td><input type="checkbox"/></td>'+
                          '<td><input type="checkbox"/></td>'+
                         ' <td><input type="checkbox"/></td>'+
                        '  <td><input type="checkbox"/></td>'+
                       '   <td><input type="checkbox"/></td>'+
                      '</tr>';
	}
	
	function x()
	{
	add_new_row('#sotable', genNewRow());
	
	}

</script>


    </head>
    <body>

        <div class="page">
            <div class="header">
                <div class="title">
                    <h1>
ABET                    </h1>
                </div>
            </div>
            <div class="main">
                <h2>

View/Mod Course Info                </h2>
                <div class="hr"></div>  





                <table style="width: 100%;">
                    <tr>
                        <td class="style1">
                            <strong>Course Department:</strong>
                        </td>
                        <td class="style2">

<?php echo $course->_deptID; ?></td>
                        <td class="style4">&nbsp;
                            
                        </td>
                        <td>&nbsp;
                            
                        </td>
                    </tr>
                    <tr>

                        <td class="style1">
                            <strong>Course Number:</strong>
                        </td>
                        <td class="style2">
<?php echo $course->_courseNum; ?>                    </td>
                        <td></td> <td></td>
                    </tr>
                    <tr>
                        <td class="style4">
                            <strong>Course Named:</strong>
                        </td>
                        <td>
                            <?php echo $course->_courseNamed;?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="style1">
                            <strong>Course Description:</strong>
                        </td>

                        <td class="style2">
                            <textarea align="justify" id="TextArea1"
                            cols="80" name="S1" rows="5"><?php $course->_description; ?></textarea>
                        </td>
                        <td class="style4">&nbsp;
                            
                        </td>
                        <td>&nbsp;
                            

                        </td>
                    </tr>
                    <tr>
                        <td class="style1">
                            <strong>Syllabus & Grading Guidelines:</strong>
                        </td>
                        <td class="style2">
                            <textarea id="TextArea3" cols="80" name="S1" rows="5"><?php $course->_syllabus; ?></textarea>

                        </td>
<!--
                        <td class="style4">
                            <strong>OR</strong>
                        </td>
                        <td>
                            <input type="file"/>
                        </td>
-->
                    </tr>
                    <tr>
                    <td class="style1">
                            <strong>Course Learning Outcomes:</strong><br/>
                            Specify each outcome in a separate line
                            separated by ";" (semicolon)
                        </td>
                        <td class="style2">
                            <textarea id="TextArea31" cols="80" name="S1" rows="5"><?php $course->course_learning_outcomes; ?></textarea>

                        </td>
                    </tr>

<!--                    <tr>
                        <td class="style1">
                            <strong>Description of Assignments:</strong>
                        </td>
                        <td class="style2">
                            <textarea id="TextArea4" cols="20" name="S1" rows="2">Homework, Labs, Recitation Quizes</textarea>
                        </td>
                        <td class="style4">
                            <strong>OR</strong>
                        </td>
                        <td>
                            <input type="file" name="ctl00$MainContent$FileUpload4" id="MainContent_FileUpload4" />
                        </td>
                    </tr>
                    -->
                </table>
<!--
                <div class="course_info_subgroup_title">Course Learning Outcomes:</div>

                <div>
                    <div class="glearningOutcomeRow">
                        <div class="glearningOutcomeHeaderCellNumber">Number</div>
                        <div class="glearningOutcomeCellHeaderDescription">Description</div>

                        <div class="glearningOutcomeCellHeaderExplanation">How does this apply to CPR E 288?</div>

                    </div>

                            <div class="glearningOutcomeRow">
                            <div style=" " class="glearningOutcomeCellNumber">1</div>
                            <div style=" " class="glearningOutcomeCellDescription"><textarea cols="40"></textarea></div>
                            <div style=" " class="glearningOutcomeCellExplanation"><textarea cols="40"></textarea></div>

                        </div>
                                                <div class="glearningOutcomeRow">
                            <div style="background-color: #e9e6e6; " class="glearningOutcomeCellNumber">2</div>
                            <div style="background-color: #e9e6e6; " class="glearningOutcomeCellDescription"><textarea cols="40"></textarea></div>
                            <div style="background-color: #e9e6e6; " class="glearningOutcomeCellExplanation"><textarea cols="40"></textarea></div>
                        </div>
                                                <div class="glearningOutcomeRow">

                            <div style=" " class="glearningOutcomeCellNumber">3</div>
                            <div style=" " class="glearningOutcomeCellDescription"><textarea cols="40"></textarea></div>
                            <div style=" " class="glearningOutcomeCellExplanation"><textarea cols="40"></textarea></div>
                        </div>
                                        <div class="assignmentTableRow"><div class="addAnotherSampleButton"><input type="submit" value="Add Another Learning Outcome"/></div></div>
                </div>


                <div class="course_info_subgroup_title">ABET Student Outcomes:</div>
-->




<input type="button" value="Save Course Info"/>

<!-- my div starts here -->
<br/><br/>
<hr/>
<input id="hidingbutton" type="button" value="Add Information"
       onclick="unhide()"/>
<div class="hidden" id="hidden"> 
		<form id="SOForm">
                  <table id="sotable" border="2" cellpadding="5">
                    <tbody>
                      <tr>
                          <th rowspan="2"><b>Assignment</b></th>
                          <th colspan="11"><b>Student Outcomes</b></th>
                      </tr>
                      <tr>
                          <td id="a" align="center"  
			      title="Ability to apply knowledge of mathematics, science, engineering.">a</td>
                          <td id="b" align="center"
			      title="An ability to design and conduct experiments, as well as to analyze and interpret data.">b</td>
                          <td id="c" align="center"
			      title = "Ability to design a system, component or process to meet desired needs within realistic constraints.">c</td>
                          <td id="d" align="center"
			      title="Ability to function on multidisciplinary teams.">d</td>
                          <td id="e" align="center"
			      title="Ability to identify, formulate and solve engineering problems.">e</td>
                          <td id="f" align="center"
			      title="Understanding of professional and ethical responsibility.">f</td>
                          <td id="g" align="center"
			      title="Ability to communicate effectively.">g</td>
                          <td id="h" align="center"
			      title="The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.">h</td>
                          <td id="i" align="center"
			      title="Recognition of the need for and an ability to engage in lifelong learning.">i</td>
                          <td id="j" align="center"
			      title="Knowledge of contemporary issues.">j</td>
                          <td id="k" align="center"
			      title="Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.">k</td>
                      </tr>
                      <tr> 
                          <td>
			    <select id="assignmentType1">
                              <option selected="selected"
                              value="none">Select Type</option>
                              <option value="hw">Homework</option>
                              <option value="lab">Lab</option>
                              <option value="test">Test</option>
                              <option value="quiz">Quiz</option>
                              <option value="mt">Midterm</option>
                              <option value="final">Final</option>
                            </select>
                            <select id="assignmentNumber1">
                              <option selected="selected"
                              value="none">Select Number</option>
                              <option value="1">0</option>
                              <option value="1">1</option>
                              <option value="1">2</option>
                              <option value="1">3</option>
                              <option value="1">4</option>
                              <option value="1">5</option>
                              <option value="1">6</option>
                              <option value="1">7</option>
                              <option value="1">8</option>
                              <option value="1">9</option>
                              <option value="1">10</option>
                            </select>            
                            <input type="button" value="Update information" /></input>
                          </td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                          <td><input type="checkbox"/></td>
                      </tr>
                    </tbody>
                  </table>
		  <br/>
		  <input type="button" value="Add More Assignments" onclick="add_new_row('#sotable', genNewRow());"/>
		</form>
<!--

                <div class="learningOutcomeRow">
                    <div class="learningOutcomeHeaderCellLetter">Letter</div>
                    <div class="learningOutcomeHeaderCellDescription">Description</div>
                    <div class="learningOutcomeHeaderCellCheckbox">Does this apply to CPR E 288?</div>

                </div>

                                                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">A</div>
                        <div class="learningOutcomeCellDescription" style=" ">Ability to apply knowledge of mathematics, science, engineering.</div>
                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeAcheckbox" name="learningOutcomeAcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenA').slideDown('slow') || $('#learningOutcomeCellHiddenA').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenA">
                        <div class="learningOutcomeExplanation">

                            Please explain why learning outcome A applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style="background-color: #e9e6e6; ">B</div>

                        <div class="learningOutcomeCellDescription" style="background-color: #e9e6e6; ">An ability to design and conduct experiments, as well as to analyze and interpret data.</div>
                        <div class="learningOutcomeCellCheckbox" style="background-color: #e9e6e6; "><input id="learningOutcomeBcheckbox" name="learningOutcomeBcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenB').slideDown('slow') || $('#learningOutcomeCellHiddenB').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;background-color: #e9e6e6;" id="learningOutcomeCellHiddenB">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome B applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">

                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">C</div>
                        <div class="learningOutcomeCellDescription" style=" ">Ability to design a system, component or process to meet desired needs within realistic constraints.</div>

                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeCcheckbox" name="learningOutcomeCcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenC').slideDown('slow') || $('#learningOutcomeCellHiddenC').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenC">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome C applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>

                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style="background-color: #e9e6e6; ">D</div>
                        <div class="learningOutcomeCellDescription" style="background-color: #e9e6e6; ">Ability to function on multidisciplinary teams.</div>
                        <div class="learningOutcomeCellCheckbox" style="background-color: #e9e6e6; "><input id="learningOutcomeDcheckbox" name="learningOutcomeDcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenD').slideDown('slow') || $('#learningOutcomeCellHiddenD').slideUp('slow');"/></div>
                    </div>

                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;background-color: #e9e6e6;" id="learningOutcomeCellHiddenD">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome D applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">E</div>
                        <div class="learningOutcomeCellDescription" style=" ">Ability to identify, formulate and solve engineering problems.</div>
                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeEcheckbox" name="learningOutcomeEcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenE').slideDown('slow') || $('#learningOutcomeCellHiddenE').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenE">

                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome E applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >

                        <div class="learningOutcomeCellLetter" style="background-color: #e9e6e6; ">F</div>
                        <div class="learningOutcomeCellDescription" style="background-color: #e9e6e6; ">Understanding of professional and ethical responsibility.</div>
                        <div class="learningOutcomeCellCheckbox" style="background-color: #e9e6e6; "><input id="learningOutcomeFcheckbox" name="learningOutcomeFcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenF').slideDown('slow') || $('#learningOutcomeCellHiddenF').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;background-color: #e9e6e6;" id="learningOutcomeCellHiddenF">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome F applies to CPR E 288:
                        </div>

                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">G</div>
                        <div class="learningOutcomeCellDescription" style=" ">Ability to communicate effectively.</div>

                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeGcheckbox" name="learningOutcomeGcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenG').slideDown('slow') || $('#learningOutcomeCellHiddenG').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenG">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome G applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>

                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style="background-color: #e9e6e6; ">H</div>
                        <div class="learningOutcomeCellDescription" style="background-color: #e9e6e6; ">The broad education necessary to understand the impact of engineering solutions in a global, economic, environmental and societal context.</div>
                        <div class="learningOutcomeCellCheckbox" style="background-color: #e9e6e6; "><input id="learningOutcomeHcheckbox" name="learningOutcomeHcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenH').slideDown('slow') || $('#learningOutcomeCellHiddenH').slideUp('slow');"/></div>
                    </div>

                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;background-color: #e9e6e6;" id="learningOutcomeCellHiddenH">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome H applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">I</div>
                        <div class="learningOutcomeCellDescription" style=" ">Recognition of the need for and an ability to engage in lifelong learning.</div>
                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeIcheckbox" name="learningOutcomeIcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenI').slideDown('slow') || $('#learningOutcomeCellHiddenI').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenI">

                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome I applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >

                        <div class="learningOutcomeCellLetter" style="background-color: #e9e6e6; ">J</div>
                        <div class="learningOutcomeCellDescription" style="background-color: #e9e6e6; ">Knowledge of contemporary issues. </div>
                        <div class="learningOutcomeCellCheckbox" style="background-color: #e9e6e6; "><input id="learningOutcomeJcheckbox" name="learningOutcomeJcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenJ').slideDown('slow') || $('#learningOutcomeCellHiddenJ').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;background-color: #e9e6e6;" id="learningOutcomeCellHiddenJ">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome J applies to CPR E 288:
                        </div>

                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="clear"></div>
                                        <div class="learningOutcomeRow" >
                        <div class="learningOutcomeCellLetter" style=" ">K</div>
                        <div class="learningOutcomeCellDescription" style=" ">Ability to use the techniques, skills and modern engineering tools necessary for engineering practice.</div>

                        <div class="learningOutcomeCellCheckbox" style=" "><input id="learningOutcomeKcheckbox" name="learningOutcomeKcheckbox" type="checkbox" 1 onclick="$(this).is(':checked') && $('#learningOutcomeCellHiddenK').slideDown('slow') || $('#learningOutcomeCellHiddenK').slideUp('slow');"/></div>
                    </div>
                    <div class="clear"></div>
                    <div class="learningOutcomeCellHidden" style="display: none;" id="learningOutcomeCellHiddenK">
                        <div class="learningOutcomeExplanation">
                            Please explain why learning outcome K applies to CPR E 288:
                        </div>
                        <div class="learningOutcomeExplanationTextArea">
                            <textarea id="TextArea4" cols="40" name="S1" rows="2"></textarea>

                        </div>
                    </div>
                    <div class="clear"></div>

--!>



                <div class="clear"></div>



                <div class="course_info_subgroup_title">Sample Assignments:</div>

               
                    <!--                    <div class="assignmentTableRow">
                                            <div class="assignementTableAssigmentNameCell">
                                        <div class="assignmentTableAssignmentNameText">Assignment Name:</div>
                                        <div class="assignmentTableAssignmentNameField"><input type="text"></input></div>
                                            </div>
                                            <div class="assignementTableAssigmentTypeCell">
                                        <div class="assignmentTableAssignmentTypeText">Assignment Type:</div>
                                        <div class="assignmentTableAssignmentNameField">
                                        </div>
                                            <select>
                                                <option selected="selected" value="black">Select...</option>
                                                <option value="volvo">Homework</option>
                                                <option value="saab">Lab</option>
                                                <option value="mercedes">Test</option>
                                                <option value="audi">Quiz</option>
                                                <option value="audi">Midterm</option>
                                                <option value="audi">Final</option>
                                            </select>
                                        </div>
                                            <div class="assignementTableUploadAssignmentCell">
                                        <div class="assignmentTableUploadAssignmentText">Upload Assignment:</div>
                                        <div class="assignmentTableUploadAssignmentField"><input type="file"/></div>
                                            </div>
                                            
                                        
                                        <div><a href="#">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div> 
                                        <div class="assignementTableAssigmentSampleA">
                                        <div>Sample Solution Worth of an "A":</div>
                                        <div><input type="file"/></div>
                                        </div>
                                        <div><a href="#">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>
                                        <div class="assignementTableAssigmentSampleB">
                                        <div>Sample Solution Worth of a "B":</div>
                                        <div><input type="file"/></div>
                                        </div>
                                        <div><a href="#">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>
                                        <div class="assignementTableAssigmentSampleC">
                                        <div>Sample Solution Worth of a "C":</div>
                                        <div><input type="file"/></div>
                                        </div>
                                        <div><a href="#">View</a>&nbsp;|&nbsp;<a href="#">Update</a>&nbsp;|&nbsp;<a href="#">Delete</a></div>
                                    </div>-->






<table>
<tr>
                            <div id = "assignmentRow" class="assignmentTableRow" >
                            <div class="assignementTableAssigmentNameCell" style="background-color: #e9e6e6; ">

                                <div class="assignmentTableAssignmentNameText" style="background-color: #e9e6e6; ">Assignment Name:</div>
                                <div class="assignmentTableAssignmentNameField" style="background-color: #e9e6e6; "><input type="text" value="Final Exam"></input></div>
                            </div>
                            <div class="assignementTableAssigmentTypeCell" style="background-color: #e9e6e6; ">
                                <div class="assignmentTableAssignmentTypeText" style="background-color: #e9e6e6; ">Assignment Type:</div>
                                <div class="assignmentTableAssignmentNameField" style="background-color: #e9e6e6; ">
                                </div>
                                <select>

                                    <option selected="selected" value="black">Select...</option>
                                    <option value="Homework">Homework</option>
                                    <option value="saab">Lab</option>
                                    <option value="mercedes">Test</option>
                                    <option value="audi">Quiz</option>
                                    <option value="audi">Midterm</option>

                                    <option value="audi">Final</option>
                                </select>
                            </div>
                            <div class="assignementTableUploadAssignmentCell" style="background-color: #e9e6e6; ">

                                                                    <div class="assignmentTableUploadAssignmentText" style="background-color: #e9e6e6; ">Upload Assignment:</div>
                                    <div class="assignmentTableUploadAssignmentField" style="background-color: #e9e6e6; "><input type="file"/></div>
                                </div>



                            <div class="assignementTableAssigmentSampleA" style="background-color: #e9e6e6; ">
                                        <div>Upload sample solution worthy of an "A":</div>
                                    <div><input type="file"/></div>
                                                            </div>
                            <div class="assignementTableAssigmentSampleB" style="background-color: #e9e6e6; ">
                                        <div>Upload a sample solution worth of a "B":</div>

                                    <div><input type="file"/></div>
                                                    </div>
                            <div class="assignementTableAssigmentSampleC" style="background-color: #e9e6e6; ">

                                        <div>Upload a sample solution worth of a "C":</div>
                                    <div><input type="file"/></div>
                                </div>

                        </div>

         </tr>
         </table>               
  













                    <div class="assignmentTableRow"><div class="addAnotherSampleButton"><input type="submit" value="Add Another Sample" onclick="add_new_row('#assignmentRow', genNewAssignRow());"></div></div>  
                </div>



                <div class="hr"></div>
<input type="button" value="Save Course Info"/>

            <div class="clear"></div>
        </div>

<!-- my div ends here -->
</div>
        <div class="footer"></div>
    </body>
</html>
