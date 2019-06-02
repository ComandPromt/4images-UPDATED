<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

		poner_menu();
			
			print '<div style="padding-top:100px;margin:auto;padding-left:40px;"><h1>Imágenes favoritas</h1></div>';
			
		ver_categoria('*','WHERE image_id IN ( SELECT lightbox_image_id FROM '.$GLOBALS['table_prefix'].'lightboxes WHERE user_id='.$_COOKIE['4images_userid'].')');

			restablecer_pass();
		
		mysqli_close($conexion);

footer();
 
?>