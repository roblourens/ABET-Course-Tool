    <?php
    require_once("../../src/include.php");
    
    if(!isset($_GET['course']))die("ERROR: Course name not given.");
    $course = getCourseForID($_GET['course']);

    $assignment = $course->assignments[$_GET['type'].$_GET['number']];
    if (isset($assignment->filename)) {
        echo "<a target='_blank' href='$assignment->filepath'>View File</a>";
    }

    else{
    ?>

	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajaxfileupload.js"></script>
	<script type="text/javascript">
	function ajaxFileUpload(course, type, number)
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'doajaxfileupload.php?course='+course+'&type='+type+'&number='+number,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							document.write("<a target='_blank' href='../../data/courses/"+course+"/"+data.msg+"'>View File</a>");
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
	</script>	
		<form name="form" action="" method="POST" enctype="multipart/form-data">
<input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"><button class="button" id="buttonUpload" onClick="return ajaxFileUpload('<?php echo $_GET['course'] ?>','<?php echo $_GET['type'] ?>', '<?php echo $_GET['number'] ?>');">Upload</button>
		</form>   
        
        
<?php }?>

        
        
      
