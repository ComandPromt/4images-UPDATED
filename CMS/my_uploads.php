<?php

session_start();

$_SESSION['pagina']="my_uploads.php";

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

comprobar_cookie();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

poner_menu();

ver_categoria('*',"",false,true);

restablecer_pass();

footer();
 
?>