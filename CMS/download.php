<?php

session_start();

include('config.php');

$_GET['image_id']=(int)$_GET['image_id'];

if($_GET['image_id']>0){
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	mysqli_query($GLOBALS['conexion'],
	"INSERT INTO descargas VALUES('".$_COOKIE['4images_userid']."','".$_GET['image_id']."')");
	
	echo mysqli_query($GLOBALS['conexion'],
	"UPDATE ".$GLOBALS['table_prefix']."images SET image_downloads=image_downloads+1 WHERE image_id='".$_GET['image_id']."'");

	mysqli_close($GLOBALS['conexion']);

}

?>