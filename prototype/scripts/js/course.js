// page setup
$(document).ready(function() {
    // set new assignment button handler
    $('#add_another_assignment').click(function() {
        addAssignmentRow();
        assignAssignmentDeleteButtonHandler();
    });

    // set new sample button handler
    $('#add_another_sample').click(function() {
        add_new_row('#sampleAssignments', genNewSampleRow(courseID)); 
        assignSampleDeleteButtonHandler();
    });


    // do initial summary row sync, initial checkbox handlers, etc.
    syncSummaryRow();
    assignCheckboxHandler();
    assignSampleDeleteButtonHandler();
    assignAssignmentDeleteButtonHandler();

    // assign summary checkbox handlers
    $('input[type=checkbox][class=sum]').click(function(e) {
        // give it A, B... from sum_A, sum_B...
        setCourseOutcome(e.currentTarget.name.split('_')[1], e.currentTarget.checked);
        syncSummaryRow();
    });

    // assign preview button handler
    $('#button_preview').click(function() {
        window.open('prettyView.php?course='+courseID, '_blank');
    });

    // disable all text fields/buttons if not logged in
    // this is not secure, just to prevent accidents/nosy faculty :)
    if (authorized != 0)
    {
        $('textarea').attr('disabled', 'true');
        $('.save_button').attr('disabled', 'true');
        $('input[id!=unlock_input]').attr('disabled', 'true');
        $('select').attr('disabled', 'true');
        $('button.delete_button').attr('disabled', 'true');
        $('button.delete_sample_button').attr('disabled', 'true');
    }
});

function addAssignmentRow()
{
    add_new_row('#assignmentsTable', build_assignment_row()); 
    assignCheckboxHandler();   
    assignAssignmentDeleteButtonHandler();
}

// called every time a row is added so it can set the callbacks on the new checkboxes
function assignCheckboxHandler() {
    $('input[type=checkbox][class!=sum]').click(function() {
        syncSummaryRow();
    });
}

// called every time a sample row is added
function assignSampleDeleteButtonHandler() {
    // set sample delete button handler for tab 3
    $('button.delete_sample_button').click(function(e) {
        var i = e.currentTarget.id.split('delete_sample_button_')[1];
        var type = $('#sample_type_'+i).val();
        var num = $('#sample_number_'+i).val();

        if (confirm("Are you sure you want to delete sample " + type + " " + num +
            " from " + courseID + "?"))
        {
            $('.sample_row_tr_A:eq('+i+')').remove();
            $('.sample_row_tr_B:eq('+i+')').remove();
        }
    });   
}

// called every time an assignment row is added
function assignAssignmentDeleteButtonHandler()
{
    // set delete button click handler for tab 2
    $('button.delete_button').click(function(e) {
        var i = e.currentTarget.id.split('delete_button_')[1];
        var type = $('#type_'+i).val();
        var num = $('#number_'+i).val();

        if (confirm("Are you sure you want to delete " + type + " " + num +
            " from " + courseID + "?"))
        {
            $('#assignment_row_tr_'+i).remove();
            syncSummaryRow();
        }
    });
}

function setCourseOutcome(outcome, checked)
{
    var checkbox = $('input[name=course_'+outcome+']');
    if (checked)
        checkbox.attr('checked', 'true');
    else
        checkbox.removeAttr('checked');
}

function get_num_rows()
{
	return $('#assignment_row_count').val();
}

function get_num_sample_rows()
{
    return $('#sample_assignment_row_count').val();
}

function increment_assignment_row_count()
{
	var num_of_rows = get_num_rows();
    var new_num = parseInt(num_of_rows) + 1;
	$('#assignment_row_count').val(new_num);
	
	return new_num;
}

function increment_sample_row_count()
{
	var num_of_rows = get_num_sample_rows();
    var new_num = parseInt(num_of_rows) + 1;
	$('#sample_assignment_row_count').val(new_num);
	
	return new_num;
}

function syncSummaryRow()
{
    var count = get_num_rows();

    var outcomes = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
    var foundOutcomes = [];
    for (var i=0; i<count; i++)
    {
        for (var o=0; o<outcomes.length; o++)
        {
            var sumCheckbox = $('input[name=sum_'+outcomes[o]+']');
            if ($('input[name=checkbox'+outcomes[o]+'_'+i+']').is(':checked'))
                foundOutcomes.push(outcomes[o]);
        }
    }

    // check course row
    for (var o=0; o<outcomes.length; o++)
    {
        var sumCheckbox = $('input[name=sum_'+outcomes[o]+']');
        if ($('input[name=course_'+outcomes[o]+']').is(':checked'))
            foundOutcomes.push(outcomes[o]);
    }

    // now set the ones that were found, and unset the others
    for (var o=0; o<outcomes.length; o++)
    {
        var sumCheckbox = $('input[name=sum_'+outcomes[o]+']');
        if (foundOutcomes.indexOf(outcomes[o]) > -1)
            sumCheckbox.attr('checked', 'true');
        else
            sumCheckbox.removeAttr('checked');
    }
}
