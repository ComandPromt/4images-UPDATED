<?php

session_start();

$_SESSION['pagina']="my_uploads.php";

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

print '<div style="backgound-color:red;">';
ver_categoria('*',"",false,true);

print '</div>';

restablecer_pass();

footer();
 
?>