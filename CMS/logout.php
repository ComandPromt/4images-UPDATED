<?php

session_start();

include_once('includes/funciones.php');

if(!isset($_SESSION['pagina'])||$_SESSION['pagina']==""){
	$_SESSION['pagina']='index.php';
}

setcookie("4images_userid","-1");

if($_SESSION['pagina']=="rss"){
	$_SESSION['pagina']="index.php";
}

redireccionar($_SESSION['pagina']);

?>
