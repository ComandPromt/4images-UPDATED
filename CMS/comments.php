<?php

session_start();

$_SESSION['track']=true;

$_SESSION['pagina']='comments.php';

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
			
print '<div style="padding-top:100px;margin:auto;padding-left:40px;"><img src="img/coment.png" class="icono"/><h1>'.ver_dato('comentarios', $GLOBALS['idioma']).'</h1></div>';

ver_categoria('*','WHERE image_id IN ( SELECT distinct(image_id) FROM '.$GLOBALS['table_prefix'].'comments order by comment_id desc)');

restablecer_pass();

footer();
 
?>