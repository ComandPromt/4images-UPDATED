<?php
	session_start();
	date_default_timezone_set("Europe/Madrid");
	$site_name = "";
	$db_servertype = "mysqli";
	$db_host = "localhost";
	$db_name = "prueba";
	$db_user = "root";
	$db_password = "rootroot";
	$table_prefix = "4images_";
	$admin_email = "";
	$admin_emailpass = "";
	$facebook="";
	$instagram="";
	$twitter="";
	$youtube="";
	$github="";
	$debianart="";
	$slideshare="";
	define("4IMAGES_ACTIVE", 1);
	$conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("No se pudo conectar a la base de datos");
	$select_db = mysqli_select_db($conexion, $db_name);
	$idioma="spanish";
	?>