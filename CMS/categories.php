<?php

session_start();

$_SESSION['pagina']="categories.php";

include_once('config.php');

include('includes/funciones.php');

if( isset($_GET['cat_id']) && $_GET['cat_id']>0 || isset($_SESSION['categoria']) ){
	
	cabecera();
		
	if( !isset($_GET['cat_id'])&& isset($_SESSION['categoria'])){

		$categoria=$_SESSION['categoria'];
	}
	
	else{
		
		$_GET['cat_id']=trim($_GET['cat_id']);
	
		$_GET['cat_id']=(int)$_GET['cat_id'];
		
		$categoria=$_GET['cat_id'];
		
		$_SESSION['categoria']=$categoria;
	
	}
		
	poner_menu();
	
	print '<br/><br/> ';
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(image_id) FROM '.$GLOBALS['table_prefix'].'images
	WHERE image_active=1 AND cat_id='.$categoria);
	$fila = mysqli_fetch_row($consulta);
		
	if($fila[0]>0){
		
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name FROM '.$GLOBALS['table_prefix'].'categories
		WHERE cat_id='.$categoria);
		
		$fila = mysqli_fetch_row($consulta);
		
		print '<div style="margin:auto;padding-left:40px;"><h1>'.$fila[0].'</h1></div>';
	
		ver_categoria($categoria,"");
	
		restablecer_pass();
	}
	
	mysqli_close($GLOBALS['conexion']);
}
	
else{
	redireccionar('index.php');
}

footer();

?>