<?php

session_start();

$_SESSION['track']=false;

include_once('../config.php');

include('../includes/funciones.php');

comprobar_cookie('../');

if(isset($_GET['delete']) && (int)$_GET['delete']==1 ||  (int)$_GET['delete']==2){
	
	if($_GET['delete']==1){
		$final_sentencia="WHERE destinatario='".$_COOKIE['4images_userid']."'";
	}
	
	else{
		$final_sentencia="WHERE remitente='".$_COOKIE['4images_userid']."'";
	}	
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name'])
	or die("No se pudo conectar a la base de datos");

	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT id FROM  mensajes where oculto!=0');

	while($fila = mysqli_fetch_row($consulta)){
		mysqli_query($GLOBALS['conexion'], "DELETE FROM mensajes WHERE id='".$fila[0]."'");
	}

	mysqli_query($GLOBALS['conexion'], "UPDATE mensajes SET oculto='1' ".$final_sentencia);

	mysqli_close($GLOBALS['conexion']);

}

redireccionar('index.php');

?>