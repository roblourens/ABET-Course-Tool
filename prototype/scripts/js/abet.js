function build_assignment_row()
{
	var num = increment_assignment_row_count();
	str = "";
	if(num % 2 == 0){
		str = "bgcolor=\"#b6b7bc\"";
	}

    // rows are 0-indexed
    num--;
    return ""+	
    " <tr "+str+" id='assignment_row_tr_"+num+"'>"+
    "        <td id='assignment_row_tr_"+num+"'>"+(num+1)+"</td>"+
    "        <td id='assignment_row_tr_"+num+"'><select name='type_"+num+"'>"+
    "          <option value='0'>Select Value</option>"+
    "          <option value='homework'>Homework</option>"+
    "          <option value='test'>Test</option>"+
    "          <option value='lab'>Lab</option>"+
    "          <option value='quiz'>Quiz</option>"+
    "          <option value='midterm'>Midterm</option>"+
    "          <option value='final'>Final</option>"+
    "          </select></td>"+
    "        <td><select name='number_"+num+"'>"+
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
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxA_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxB_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxC_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxD_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxE_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxF_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxG_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxH_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxI_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxJ_"+num+"'/></td>"+
    "        <td id='assignment_row_tr_"+num+"'><input type='checkbox' name='checkboxK_"+num+"'/></td>"+
    "        <td bgcolor='#FFCCCC' align='center'><button class='delete_button' id='checkbox_delete_"+num+" type='button'>Delete</button>"+
    "      </tr>";
}

function add_new_row(table, rowcontent){
	if ($(table).length>0){
    	if ($(table+' > tbody').length==0) $(table).append('<tbody />');
        ($(table+' > tr').length>0)?$(table).children('tbody:last').children('tr:last').append(rowcontent):$(table).children('tbody:last').append(rowcontent);
    }
}

function genNewSampleRow(course)
{
	var num = increment_sample_row_count();
    // rows are 0-indexed
    num--;
	return ""+
        "<tr>"+
            "<td width='33%' height='103'>Assignment Type:<br />"+
                "<select id = 'sample_type_"+num+"' name='sample_type_"+num+"'>"+
                "<option selected value='0' selected='selected'>Select Value</option>"+
                "<option  value='homework'>Homework</option>"+
                "<option  value='test'>Test</option>"+
                "<option  value='lab'>Lab</option>"+
                "<option  value='quiz'>Quiz</option>"+
                "<option  value='midterm'>Midterm</option>"+
                "<option  value='final'>Final</option>"+
                "</select></td>"+
            "<td width='33%'>Assignment Number:<br />"+
                "<select name='sample_number_"+num+"' id='sample_number_"+num+"'>"+
                "<option selected value='0'>Select Number</option>"+
                "<option  value='1'>1</option>"+
                "<option  value='2'>2</option>"+
                "<option  value='3'>3</option>"+
                "<option  value='4'>4</option>"+
                "<option  value='5'>5</option>"+
                "<option  value='6'>6</option>"+
                "<option  value='7'>7</option>"+
                "<option  value='8'>8</option>"+
                "<option  value='9'>9</option>"+
                "<option  value='10'>10</option>"+
                "</select></td>"+
            "<td width='33%'><div id=file_upload_box_assignment_"+num+">Upload Assignment:<br />"+
                "<input id='fileToUpload_assignment_"+num+"' type='file' name='fileToUpload_assignment_"+num+"' class='input'></input>"+
                "</div>"+
            "</td>"+        
            "<td rowspan=2><button type='button' class='delete_sample_button' id='delete_sample_button_"+num+"'>Delete</button></td>"+
        "</tr >"+
        "<tr>"+
            "<td width='33%'><div id='file_upload_box_A_"+num+"'>"+
                "Upload sample solution worth of an &quot;A&quot;:"+
                "<input id='fileToUpload_A_"+num+"' type='file' name='fileToUpload_A_"+num+"' class='input'></input>"+
                "</div>"+
            "</td>"+
            "<td width='33%'><div id='file_upload_box_B_"+num+"'>"+
                "<br />"+
                "<input id='fileToUpload_B_"+num+"' type='file' name='fileToUpload_B_"+num+"' class='input'></input>"+
                "</div>"+
            "</td>"+
            "<td width='33%'><div id='file_upload_box_C_"+num+"'>"+
                "<br />"+
                "<input id='fileToUpload_C_"+num+"' type='file' name='fileToUpload_C_"+num+"' class='input'></input>"+
                "</div>"+
            "</td>"+
        "</tr>";
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
			//alert(ajaxRequest.responseText);
		}
	}
	var json = data;
	//var queryString = "?json=" + json;
	//ajaxRequest.open("GET", "save.php" + queryString, true);
	//ajaxRequest.send(null);
	var parameters="json="+json;
	ajaxRequest.open("POST", "scripts/php/ajax.saveCourse.php", true)
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameters);
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
    $('#save_course_form').submit(function() {
        // Save course data (creates course on server if successful)
        var obj = $('#save_course_form').serializeObject();
		showInfoBar('Course Was Saved Successfully');
        obj.course_learning_outcomes = obj.course_learning_outcomes.split(/; */);
		saveData(JSON.stringify(obj));

        // upload all files
        for (var i=0; i<get_num_sample_rows(); i++)
        {
            var assignment_type = $('#sample_type_'+i).attr('value');
            var assignment_number = $('#sample_number_'+i).attr('value');

            // sucks, but fixed for now
            // upload only if not already uploaded
            if ($('#fileToUpload_assignment_'+i).attr('type') != "hidden")
                ajaxFileUpload(courseID, assignment_type, assignment_number, 'assignment', i);

            if ($('#fileToUpload_A_'+i).attr('type') != "hidden")
                ajaxFileUpload(courseID, assignment_type, assignment_number, 'A', i);

            if ($('#fileToUpload_B_'+i).attr('type') != "hidden")
                ajaxFileUpload(courseID, assignment_type, assignment_number, 'B', i);

            if ($('#fileToUpload_C_'+i).attr('type') != "hidden")
                ajaxFileUpload(courseID, assignment_type, assignment_number, 'C', i);
        }

        return false;
    });
});
