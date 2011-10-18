        <?php
		if(!isset($_GET['course']))die("ERROR: Course name not given.");
		$course_file = "../../data/courses/".$_GET['course']."/".$_GET['course'].".json";
		if(!file_exists($course_file))die("ERROR: The course ".$_GET['course']." does not exist.");
		$fh = fopen($course_file, 'r') or die("ERROR: The data for the course ".$_GET['course']." could not be loaded.");
		$theData = fgets($fh);
		fclose($fh);
		$course = json_decode($theData, true);
		
		$filepath = "../../data/courses/".$_GET['course']."/".$course['assignment_filepath_'.$_GET['type'].'_'.$_GET['number']];
		if(file_exists($filepath)){
			echo "<a tagart='_blank' href='$filepath'>View File</a>";
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
							alert(data.msg);
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

        
        
      