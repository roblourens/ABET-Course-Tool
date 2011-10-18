

function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.value = "Show More Info";
  	}
	else {
		ele.style.display = "block";
		text.value = "Show Less Info";
	}
} 

function get_num_rows()
{
	
	//var num_of_rows = document.getElementById('number_of_rows').value;
	var num_of_rows2 = document.getElementById('assignment_row_count').defaultValue;
	
	document.getElementById('assignment_row_count').defaultValue = parseInt(num_of_rows2) + 1;
	
	return  num_of_rows2	
}

function get_num_sample_rows()
{
	
	
	//var num_of_rows = document.getElementById('number_of_rows').value;
	var num_of_rows2 = document.getElementById('sample_assignment_row_count').defaultValue;
	
	document.getElementById('sample_assignment_row_count').defaultValue = parseInt(num_of_rows2) + 1;
	
	return  num_of_rows2	
}

function get_raw_html()
{
	
	var num = get_num_rows();
	num++;
	str = "";
	if(num % 2 == 0){
		str = "bgcolor=\"#b6b7bc\"";
	}
return ""+	
" <tr "+str+">"+
"        <td width='53'>"+num+"</td>"+
"        <td width='54'><select name='assignment_type_"+num+"'>"+
"          <option value='0' selected='selected'>Select Value</option>"+
"          <option value='homework'>Homework</option>"+
"          <option value='test'>Test</option>"+
"         <option value='lab'>Lab</option>"+
"          <option value='quiz'>Quiz</option>"+
"          <option value='midterm'>Midterm</option>"+
"          <option value='final'>Final</option>"+
"          </select></td>"+
"        <td><select name='assignment_number_"+num+"' id='select2'>"+
"          <option value='0'>Select Number</option>"+
"          <option value='1'>1</option>"+
"          <option value='2'>2</option>"+
"          <option value='3'>3</option>"+
"          <option value='4'>4</option>"+
"          <option value='5'>5</option>"+
"          <option value='6'>6</option>"+
"          <option value='7'>7</option>"+
"          <option value='8'>8</option>"+
"          <option value='9'>9</option>"+
"          <option value='10'>10</option>"+
"          </select></td>"+
"        <td width='20'><input type='checkbox' name='checkboxA_"+num+"' id='checkbox' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxB_"+num+"' id='checkbox2' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxC_"+num+"' id='checkbox3' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxD_"+num+"' id='checkbox4' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxE_"+num+"' id='checkbox5' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxF_"+num+"' id='checkbox6' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxG_"+num+"' id='checkbox7' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxH_"+num+"' id='checkbox8' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxI_"+num+"' id='checkbox9' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxJ_"+num+"' id='checkbox10' /></td>"+
"        <td width='20'><input type='checkbox' name='checkboxK_"+num+"' id='checkbox11' /></td>"+
"      </tr>";
}
function add_new_row(table,rowcontent){
	if ($(table).length>0){
    	if ($(table+' > tbody').length==0) $(table).append('<tbody />');
        ($(table+' > tr').length>0)?$(table).children('tbody:last').children('tr:last').append(rowcontent):$(table).children('tbody:last').append(rowcontent);
    }
}



function addNewRow(){
      "                <tr> "+
       "                   <td>"+
		"	    <select>"+
         "                     <option selected value='none'>Select Type</option>"+
          "                    <option value='hw'>Homework</option>"+
           "                   <option value='lab'>Lab</option>"+
            "                  <option value='test'>Test</option>"+
             "                 <option value='quiz'>Quiz</option>"+
              "                <option value='mt'>Midterm</option>"+
               "               <option value='final'>Final</option>"+
                "            </select>"+
                 "           <select>"+
                  "            <option selected value='none'>Select Number</option>"+
                   "           <option value='1'>0</option>"+
                    "          <option value='1'>1</option>"+
                     "         <option value='1'>2</option>"+
                      "        <option value='1'>3</option>"+
                       "       <option value='1'>4</option>"+
                        "      <option value='1'>5</option>"+
                         "     <option value='1'>6</option>"+
                          "    <option value='1'>7</option>"+
                           "   <option value='1'>8</option>"+
                            "  <option value='1'>9</option>"+
                             " <option value='1'>10</option>"+
                            "</select>            "+
"                            <input type='button' value='Update information'>"+
 "                         </td>"+
  "                        <td><input type='checkbox'></td>"+
   "                       <td><input type='checkbox'></td>"+
    "                      <td><input type='checkbox'></td>"+
     "                     <td><input type='checkbox'></td>"+
      "                    <td><input type='checkbox'></td>"+
       "                   <td><input type='checkbox'></td>"+
        "                  <td><input type='checkbox'></td>"+
         "                 <td><input type='checkbox'></td>"+
          "                <td><input type='checkbox'></td>"+
           "               <td><input type='checkbox'></td>"+
            "              <td><input type='checkbox'></td>"+
             "         </tr>";
}

function genNewAssignmentRow()
{

	
	var  rowCount = 0;
	rowCount++;
	
	return ""+
	"<table width='50%' border='1'>"+
     " <tr>"+
	 "<td width='53' rowspan='2'>"+rowCount+"</td>"+
      "  <td width='109' rowspan='2'><select name='assignment_type_"+rowCount+"' id='assignment_type_"+rowCount+"'>"+
       "   <option value='0' selected='selected'>Select Value</option>"+
        "  <option value='homework'>Homework</option>"+
         " <option value='test'>Test</option>"+
          "<option value='lab'>Lab</option>"+
          "<option value='quiz'>Quiz</option>"+
          "<option value='midterm'>Midterm</option>"+
          "<option value='final'>Final</option>"+
          "</select></td>"+
        "<td rowspan='2'><select name='assignment_number_"+rowCount+"' id='assignment_number_"+rowCount+"'>"+
          "<option value='0'>Select Number</option>"+
          "<option value='1'>1</option>"+
          "<option value='2'>2</option>"+
          "<option value='3'>3</option>"+
          "<option value='4'>4</option>"+
          "<option value='5'>5</option>"+
          "<option value='6'>6</option>"+
          "<option value='7'>7</option>"+
          "<option value='8'>8</option>"+
          "<option value='9'>9</option>"+
          "<option value='10'>10</option>"+
          "</select></td>"+
        "<td colspan='2'>a</td>"+
        "<td width='27'>b</td>"+
        "<td width='20'>c</td>"+
        "<td width='20'>d</td>"+
        "<td width='20'>e</td>"+
        "<td width='20'>f</td>"+
        "<td width='20'>g</td>"+
        "<td width='20'>h</td>"+
        "<td width='20'>i</td>"+
        "<td width='20'>j</td>"+
        "<td width='21'>k</td>"+
      "</tr>"+
      "<tr>"+
        "<td colspan='2'><input type='checkbox' name='assignment_number_a_"+rowCount+"' id='assignment_number_a_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_b_"+rowCount+"' id='assignment_number_b_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_c_"+rowCount+"' id='assignment_number_c_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_d_"+rowCount+"' id='assignment_number_d_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_e_"+rowCount+"' id='assignment_number_e_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_f_"+rowCount+"' id='assignment_number_f_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_g_"+rowCount+"' id='assignment_number_g_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_h_"+rowCount+"' id='assignment_number_h_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_i_"+rowCount+"' id='assignment_number_i_"+rowCount+"' /></td>"+
        "<td><input type='checkbox' name='assignment_number_j_"+rowCount+"' id='assignment_number_j_"+rowCount+"' /></td>"+
		"<td><input type='checkbox' name='assignment_number_k_"+rowCount+"' id='assignment_number_k_"+rowCount+"' /></td>"+
      "</tr>"+
    "</table>";
}

function genNewSampleRow(course)
{
	
	var num = get_num_sample_rows();
	num++;
	return ""+
	      "<tr>"+


"<td width='33%' height='103'>Assignment Type:<br />"+

 "         <select id = 'sample_assignment_type_"+num+"' name='sample_assignment_type_"+num+"'>"+

  "          <option selected value='0' selected='selected'>Select Value</option>"+

 "           <option  value='homework'>Homework</option>"+

  "          <option  value='test'>Test</option>"+

   "         <option  value='lab'>Lab</option>"+

    "        <option  value='quiz'>Quiz</option>"+

     "       <option  value='midterm'>Midterm</option>"+

"             <option  value='final'>Final</option>"+

  "         </select></td>"+

    "     <td width='33%'>Assignment Number:<br />"+

      "     <select name='sample_assignment_number_"+num+"' id='sample_assignment_number_"+num+"'>"+

        "     <option selected  value='0'>Select Number</option>"+

          "   <option  value='1'>1</option>"+

            " <option  value='2'>2</option>"+

            " <option  value='3'>3</option>"+

        "     <option  value='4'>4</option>"+

          "   <option  value='5'>5</option>"+

         "    <option  value='6'>6</option>"+

           "  <option  value='7'>7</option>"+

         "    <option  value='8'>8</option>"+

           "  <option  value='9'>9</option>"+

        "     <option  value='10'>10</option>"+

        "   </select></td>"+

		  
		  
		  
		  
"		        <td width=\"33%\">Upload Assignment:<br />"+
"			<iframe height=\"50%\" width=\"100%\"  frameBorder=\"0\" src=\"file/ajaxfileupload.php?course="+course+"&type=assignmnet&number="+(num )+"\"></iframe>"+
 "       </td>"+
 "     </tr >"+
  "    <tr >"+
   "     <td width=\"33%\">Upload sample solution worth of an &quot;A&quot;:<br />"+
    "      <iframe height=\"50%\" width=\"100%\"  frameBorder=\"0\" src=\"file/ajaxfileupload.php?course="+course+"&type=A&number="+(num )+"\"></iframe>"+
     "   </td>"+
      "  <td width=\"33%\">Upload sample solution worth of an &quot;B&quot;:<br />"+
       "  <iframe height=\"50%\" width=\"100%\"  frameBorder=\"0\" src=\"file/ajaxfileupload.php?course="+course+"&type=B&number="+(num )+"\"></iframe>"+
  "      </td>"+
   "     <td width=\"33%\">Upload sample solution worth of an &quot;C&quot;:<br />"+
    "      <iframe height=\"50%\" width=\"100%\"  frameBorder=\"0\" src=\"file/ajaxfileupload.php?course="+course+"&type=C&number="+(num )+"\"></iframe>"+
     "     </td>"+
      "</tr>";
		  
		  
		  
		  
       
}

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


function saveData(data)
{
		var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			alert(ajaxRequest.responseText);
		}
	}
	var json = data;
	//var queryString = "?json=" + json;
	//ajaxRequest.open("GET", "save.php" + queryString, true);
	//ajaxRequest.send(null);
	var parameters="json="+json;
	ajaxRequest.open("POST", "scripts/php/ajax.saveCourse.php", true)
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameters)
}



$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(function() {
    $('form').submit(function() {
        //$('#result').text(JSON.stringify($('form').serializeObject()));
		saveData(JSON.stringify($('form').serializeObject()));
        return false;
    });
});
