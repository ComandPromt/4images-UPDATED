<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

		poner_menu();
		
		print '<br/><br/>';
		
		ver_categoria('*');
		
		restablecer_pass();
	
footer();
 
?>