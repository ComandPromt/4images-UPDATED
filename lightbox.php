<?php

include('config.php');

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_GET['action']) && $_GET['image_id']>0 && ($_GET['action']=='guardar' || $_GET['action']=='eliminar') ){
	
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

	if($_GET['action']=='eliminar'){
		$sql="DELETE FROM 4images_lightboxes WHERE lightbox_image_id=".$_GET['image_id']." and user_id=".$_COOKIE['4images_userid'];

	}
	else{
		$sql="INSERT into 4images_lightboxes values (1,".$_GET['image_id'].")";

	}
			
	echo mysqli_query($GLOBALS['conexion'],$sql);
	mysqli_close($GLOBALS['conexion']);
}

 ?>