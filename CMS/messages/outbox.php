<?php
include('../upload_images/cabecera.php');

if(!isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']<=0){
	redireccionar('../index.php');
}

poner_menu('../');

print '<div class="container" style="width:113%;margin-auto;padding-top:100px;padding-bottom:30px;">';

menu_mensajes();

	include('../config.php');
	
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
$GLOBALS['db_password'], $GLOBALS['db_name'])
or die("No se pudo conectar a la base de datos");
	
$consulta = mysqli_query($GLOBALS['conexion'], "SELECT COUNT(id) FROM mensajes WHERE remitente='".$_COOKIE['4images_userid']."'");
	
	$fila = mysqli_fetch_row($consulta);
	
	if($fila[0]>0){
		print '<hr/>
		<table style="margin-bottom:100px;margin:auto;">
		<tr>
		<th></th>
		<th></th>
		<th></th>
		</tr>';

		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT asunto,mensaje,user_name FROM mensajes M JOIN '.$GLOBALS['table_prefix']."users U ON M.destinatario=U.user_id  WHERE remitente='".$_COOKIE['4images_userid']."'");
	
		while($fila = mysqli_fetch_row($consulta)){
				print '<tr><td>'.$fila[0].'</td><td>'.$fila[1].'</td><td><img class="icono" src="../img/user.png"/>'.$fila[2].'</td></tr>';
		}

		print '</table>';

	}
mysqli_close($GLOBALS['conexion']);

print '

</div>';


restablecer_pass('../');

footer('../');

?>