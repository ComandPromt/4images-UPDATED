<!DOCTYPE html>

<html lang="es">

	<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<?php
	
session_start();

$_SESSION['track']=true;

	include('includes/funciones.php');

	$_GET['photo_id']=(int)$_GET['photo_id'];

	if($_GET['photo_id']>0){
	
		include('config.php');
		
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_media_file,cat_id,image_name
		FROM '.$GLOBALS['table_prefix']."images WHERE image_id='".$_GET['photo_id']."'");
	
		$fila = mysqli_fetch_row($consulta);
	
		print '
		<title>'.$fila[2].'</title>

	</head>

	<body>
		
		<div style="margin:auto;text-align:center;padding-top:40px;"><img style="margin:auto;" src="data/media/'.$fila[1].'/'.$fila[0].'"></div>';
	
		mysqli_close($GLOBALS['conexion']);	
	}

	else{
		redireccionar('index.php');
	}

	?>

	</body>
	
</html>