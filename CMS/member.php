<?php

session_start();

$_SESSION['pagina']="member.php";

include('cabecera.php');

comprobar_cookie();

poner_menu();

poner_menu_conf();

print '</div>';

restablecer_pass();

footer();
 
?>