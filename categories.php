<?php
session_start();
$_SESSION['pagina']="categories.php";
include('cabecera.php');
poner_menu();
print '<br/><br/>';
ver_categoria(12);
restablecer_pass();
include('footer.html');
?>
