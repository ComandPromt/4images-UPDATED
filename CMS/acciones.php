<?php

include('config.php');

include('includes/funciones.php');

comprobar_cookie();

if(logueado()){

	$_GET['image_id']=(int)$_GET['image_id'];
	
	if(isset($_GET['action']) && $_GET['image_id']>0 && ($_GET['action']=='ocultar' || $_GET['action']=='ver'|| $_GET['action']=='eliminar') ){
		
		$visibilidad="1";
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
		$consulta=mysqli_query($GLOBALS['conexion'],'SELECT visibilidad FROM '.$GLOBALS['table_prefix']."categories
		WHERE cat_id=(SELECT cat_id FROM 4images_images WHERE image_id='".$_GET['image_id']."' AND user_id='".$_COOKIE['4images_userid']."');");
		
		$fila = mysqli_fetch_row($consulta);
		
		$visibilidad=(int)$fila[0];

		if($visibilidad!=null && $visibilidad>0){
			
			switch($_GET['action']){
					
				case 'ocultar':
					$sql='UPDATE '.$GLOBALS['table_prefix']."images set visibilidad='".$visibilidad."' WHERE image_id='".$_GET['image_id']."'";
				break;
				
				case 'ver':
					$sql='UPDATE '.$GLOBALS['table_prefix']."images set visibilidad=3 WHERE image_id='".$_GET['image_id']."'";
				break;
			
			}

			echo mysqli_query($GLOBALS['conexion'],$sql);
		
		}
	
		
		
	}

}

mysqli_close($GLOBALS['conexion']);

?>
