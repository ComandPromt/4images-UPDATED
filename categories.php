<?php

session_start();

$_SESSION['pagina']="categories.php";

include('cabecera.php');

$_GET['cat_id']=trim($_GET['cat_id']);
	
$_GET['cat_id']=(int)$_GET['cat_id'];
	
	if(is_int($_GET['cat_id']) && $_GET['cat_id']>0){
		$_SESSION['categoria']=$_GET['cat_id'];
	}

	if($_GET['cat_id']>0 || $_SESSION['categoria']>0 ){
		
		if($_SESSION['categoria']>0){
			$categoria=$_SESSION['categoria'];
		}
		
		else{
			$categoria=$_GET['cat_id'];
		}
		
		poner_menu();
		
		print '<br/><br/> ';
		
		 $consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT cat_id,cat_name FROM '.$GLOBALS['table_prefix'].'categories
		WHERE cat_parent_id!=0;');

		$cat_hijos=array();
		
		while ($recuento = mysqli_fetch_row($consulta)){
			$cat_hijos[]=$recuento[0];
		}
		
		if (in_array($categoria, $cat_hijos)) {
			
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories
			WHERE cat_id=(SELECT cat_parent_id FROM 4images_categories
			WHERE cat_id=5)');
			$fila = mysqli_fetch_row($consulta);
			
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT COUNT(image_id) FROM '.$GLOBALS['table_prefix'].'images
			WHERE cat_id='.$fila[1]);
			$recuento = mysqli_fetch_row($consulta);
			
			if($recuento>0){
				print '<div style="float:left;padding-left:40px;"><a href="categories.php?cat_id='.$fila[1].'">'.$fila[0].'</a></div>';
			}
		}
		
		$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT cat_name FROM '.$GLOBALS['table_prefix'].'categories
			WHERE cat_id='.$categoria);
			$fila = mysqli_fetch_row($consulta);
		
		print '<div style="margin:auto;padding-left:40px;"><h1>'.$fila[0].'</h1></div>';
		
		ver_categoria($categoria);
		
		restablecer_pass();
		mysqli_close($conexion);
	}
	
	else{
		redireccionar('index.php');
	}

include('footer.html');
 
?>