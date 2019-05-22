<?php

session_start();

include('config.php');

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_SESSION['insert_pag']) && $_SESSION['insert_pag']=='details.php' && $_GET['image_id']>0){
	
	echo mysqli_query($GLOBALS['conexion'], '
		UPDATE 4images_images SET image_downloads=image_downloads+1 WHERE image_id='.$_GET['image_id']);

	mysqli_close($GLOBALS['conexion']);

}

?>