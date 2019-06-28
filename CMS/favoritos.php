<?php

session_start();

$_SESSION['track']=true;

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
			
print '<div style="padding-top:100px;margin:auto;padding-left:40px;"><h1>'.ver_dato('img_fav', $GLOBALS['idioma']).'</h1></div>';

ver_categoria('*','WHERE image_id IN ( SELECT lightbox_image_id FROM '.$GLOBALS['table_prefix'].'lightboxes WHERE user_id='.$_COOKIE['4images_userid'].' ORDER BY orden DESC)',true);

restablecer_pass();

footer();
 
?>