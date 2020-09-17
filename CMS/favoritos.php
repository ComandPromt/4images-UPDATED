<?php

session_start();

$_SESSION['track']=true;

$_SESSION['pagina']='favoritos.php';

include('config.php');

include('includes/funciones.php');

function base64_encode_image ($filename=string,$filetype=string) {

    if ($filename) {
	
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return base64_encode($imgbinary);
    }
}

cabecera();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

comprobar_cookie();

poner_menu();

print '<div class="flotar_derecha">
		<a onclick="descargar();"><img class="icono" src="img/download.png" /></a>
		</div>

<div class="centrar" style="padding-top:100px;padding-left:40px;">
			<h1>'.ver_dato('img_fav', $GLOBALS['idioma']).'</h1>
		</div>';

ver_categoria('*','WHERE image_id IN ( SELECT lightbox_image_id FROM '.$GLOBALS['table_prefix'].'lightboxes WHERE user_id='.$_COOKIE['4images_userid'].' ORDER BY orden DESC)',true);

descargar();

restablecer_pass();

footer();
 
?>