
<link href="ajaxfileupload.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajaxfileupload.js"></script>
	<script type="text/javascript">
	function ajaxFileUpload()
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
				url:'doajaxfileupload.php?course=<?php echo $_GET['course']?>&filetype=<?php echo $_GET['filetype']?>',
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
							//alert(data.msg);
							//document.getElementById("linktofile").innerHTML = "<a target=\"new\" href=../../data/courses/<?php echo $_GET['course']?>/<?php echo $_GET['filetype']?>.pdf>View</a>&nbsp;| <a href=\"delete.php?course=<?php //echo $_GET['course']?>&filetype=<?php //echo $_GET['filetype']?>\">Delete</a>";
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
	</head>
 	
    

		<img id="loading" src="loading.gif" style="display:none;">
		<form name="form" action="" method="POST" enctype="multipart/form-data">
		
		
				<input id="fileToUpload" type="file" name="fileToUpload" class="input">
<button class="button" id="buttonUpload" onClick="return ajaxFileUpload();">Upload</button>
		</form> 
            <?php if(file_exists("../../data/courses/".$_GET['course']."/".$_GET['filetype'].".pdf")):?>
    <a target=\"new\" href="../../data/courses/<?php echo $_GET['course']?>/<?php echo $_GET['filetype']?>.pdf">View</a>&nbsp;| <a href="delete.php?course=<?php echo $_GET['course']?>&filetype=<?php echo $_GET['filetype']?>">Delete</a>
        <?php endif;?>   	
    </div>
    <div id="linktofile"></div>

	</body>
</html>
