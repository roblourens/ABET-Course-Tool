$(document).ready(function(e) 
{
    if (authorized != 0)
        $('button.delete_button').hide();

    $('button[class=delete_button]').click(function(e) { 
        var id = e.currentTarget.id;
        var course = id.split(',')[0];
        var progID = id.split(',')[1];

        if(confirm('Are you sure you would like to delete ' + course + ' from ' + progID + '?'))
        {
            removeCourseFromPID(course, progID);
            $('#tr_'+course+'_'+progID).remove();
        }

        return false;
    });
});

function removeCourseFromPID(courseID, progID)
{
    var data = {
        "course": courseID,
        "progID": progID
    };

    $.post("scripts/php/ajax.removeCourse.php", data, function(data) {
        console.log("removeCourse returned " + data);
    });
}
