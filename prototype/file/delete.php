<?php 
$file_location = "../../data/courses/".$_GET['course']."/".$_GET['filetype'].".pdf";
if(file_exists($file_location)){
	unlink($file_location);
}
?>