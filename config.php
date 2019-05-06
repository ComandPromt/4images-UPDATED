<?php
	session_start();
	date_default_timezone_set("Europe/Madrid");
	$site_name = "mi sitio";
	$cms_host = "localhost";
	$db_servertype = "mysqli";
	$db_host = "192.168.1.100";
	$db_name = "hoopfetish";
	$db_user = "ComandPromt";
	$db_password = "ratonatqm71114";
	$table_prefix = "4images_";
	$admin_email = "";
	$protocolo = "http";
	$facebook="";
	$instagram="";
	$twitter="";
	$youtube="";
	$github="";
	$debianart="";
	$slideshare="";
	define("4IMAGES_ACTIVE", 1);
	$conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("No se pudo conectar a la base de datos");
	$idioma="spanish";
	?>