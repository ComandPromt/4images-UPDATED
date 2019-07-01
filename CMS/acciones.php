<?php

include('config.php');
include('includes/funciones.php');

comprobar_cookie();

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_GET['action']) && $_GET['image_id']>0 && ($_GET['action']=='ocultar' || $_GET['action']=='ver'|| $_GET['action']=='eliminar') ){
	
	switch($_GET['action']){
				
		case 'ocultar':
		$sql='UPDATE '.$GLOBALS['table_prefix']."images set image_active=1 WHERE image_id=".$_GET['image_id']." and user_id=".$_COOKIE['4images_userid'];
		
		break;
		
		case 'ver':
		$sql='UPDATE '.$GLOBALS['table_prefix']."images set image_active=0 WHERE image_id=".$_GET['image_id']." and user_id=".$_COOKIE['4images_userid'];
		break;
	}
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
 
	echo mysqli_query($GLOBALS['conexion'],$sql);
	mysqli_close($GLOBALS['conexion']);
}

 ?>