<?php

session_start();

$_SESSION['track']=false;

$_SESSION['pagina']="member.php";

include_once('config.php');

include('includes/funciones.php');

cabecera();

comprobar_cookie();

poner_menu();

poner_menu_conf();

print '</div>';

restablecer_pass();

footer();
 
?>