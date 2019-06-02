<?php

session_start();

$_SESSION['pagina']="member.php";

include_once('config.php');

include('includes/funciones.php');

cabecera();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

comprobar_cookie();

poner_menu();

poner_menu_conf();

if(isset($_POST['cambiar_pass'])){

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."users SET user_password='".salted_hash($_POST['nueva_pass'])."' WHERE user_id=".$_COOKIE['4images_userid']);
		mensaje(ver_dato('cambio_pass_exitoso', $GLOBALS['idioma']));
		mysqli_close($GLOBALS['conexion']);
		
}

print '
<form method="post" action="'.$_SERVER['PHP_SELF'].'">
	<p><input type="password" name="nueva_pass" placeholder="'. ver_dato('nueva_pass', $GLOBALS['idioma']).'"/></p>
	<p style="padding-top:20px;"><input name="cambiar_pass" style="font-size:20px;" value="'.ver_dato('submit', $GLOBALS['idioma']).'" type="submit"/></p>
</form>';

print '</div>';

restablecer_pass();

footer();
 
?>