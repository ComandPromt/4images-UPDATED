<?php

session_start();

include('config.php');
include('includes/funciones.php');

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_SESSION['insert_pag']) && $_SESSION['insert_pag']=='details.php' && $_GET['image_id']>0){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

	$consulta = mysqli_query($GLOBALS['conexion'], '
		UPDATE 4images_images SET image_downloads=image_downloads+1 WHERE image_id='.$_GET['image_id']);

	mysqli_close($GLOBALS['conexion']);
	redireccionar('details.php?image_id='.$_GET['image_id']);
}

else{
	redireccionar('index.php');
}

?>