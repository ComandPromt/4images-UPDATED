<?php

include('config.php');
include('includes/funciones.php');

comprobar_cookie();

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_GET['action']) && $_GET['image_id']>0 && ($_GET['action']=='guardar' || $_GET['action']=='eliminar') ){
	
	if($_GET['action']=='eliminar'){
		$sql='DELETE FROM '.$GLOBALS['table_prefix']."lightboxes WHERE lightbox_image_id=".$_GET['image_id']." and user_id=".$_COOKIE['4images_userid'];
	}
	else{
		$sql='INSERT into 4images_lightboxes values ('.$_COOKIE['4images_userid'].','.$_GET['image_id'].','.saber_orden().')';

	}
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	echo mysqli_query($GLOBALS['conexion'],$sql);
	mysqli_close($GLOBALS['conexion']);
}

 ?>