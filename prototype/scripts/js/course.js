$(document).ready(function() {
    // set delete button click handler for tab 2
    $('button.delete_button').click(function(e) {
        var i = e.currentTarget.id.split('checkbox_delete_')[1];
        var type = $('#type_'+i).val();
        var num = $('#number_'+i).val();

        removeAssignmentKeyFromCourse(type+num, courseID);
        $('#assignment_row_tr_'+i).remove();
    });

    // do initial summary row sync, call initial checkbox handlers
    syncSummaryRow();
    assignCheckboxFuncs();

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
    }
});

function removeAssignmentKeyFromCourse(assignmentKey, courseID)
{
    var data = {
        "course": courseID,
        "assignmentKey": assignmentKey
    };

    $.post("scripts/php/ajax.removeAssignment.php", data, function(data) {
        console.log("removeAssignment returned " + data);
    });
}

function addAssignmentRow()
{
    add_new_row('#assignmentsTable', add_assignment_row()); 
    assignCheckboxFuncs();   
}

// called every time a row is added so it can set the callbacks on the new checkboxes
function assignCheckboxFuncs() {
    $('input[type=checkbox][class!=sum]').click(function() {
        syncSummaryRow();
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
