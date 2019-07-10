<?php

session_start();

$_SESSION['track']=false;

$_SESSION['pagina']='admin/imagenes_repetidas.php';

include_once('../config.php');

include('../includes/funciones.php');

cabecera('../');

zona_privada('../');

comprobar_cookie('../');

poner_menu('../');

poner_menu_geo('../');

ver_categoria('*',"GROUP BY sha256 HAVING COUNT(*) > 1",false,false,false,"../");

restablecer_pass('../');

footer('../');

?>