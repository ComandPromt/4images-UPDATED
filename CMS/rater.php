<?php

session_start();

include('includes/funciones.php');

include('config.php');

  function deliver_rating($id) {
  
	switch($id){
		
		case 1:
		$calificacion='1';
		break;
		
		case 2:
		$calificacion='2';
		break;
		
		case 3:
		$calificacion='3';
		break;
		
		case 4:
		$calificacion='4';
		break;
		
		case 5:
		$calificacion='5';
		break;
		
		default:
		 $calificacion='';
		break;
		
	}
     
     $imagen=$_SESSION['imagen'];
     
     if($calificacion!='' && logueado() && !empty($imagen) && $imagen!=null ){

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT Usuario FROM '.$GLOBALS['table_prefix']."usersraters WHERE Usuario='". $_COOKIE['4images_userid']."' AND Imagen='".$imagen."'");

		$fila = mysqli_fetch_row($consulta);
	
		$resultado=$fila[0];
	
		if($resultado!=null && $resultado>0){
			mysqli_query($GLOBALS['conexion'], 'UPDATE '.$GLOBALS['table_prefix']."usersraters SET Calificacion='". $calificacion."' WHERE Imagen='".$imagen."' AND Usuario='".$_COOKIE['4images_userid']."'");
		}
		
		else{
			mysqli_query($GLOBALS['conexion'], 'INSERT INTO '.$GLOBALS['table_prefix']."usersraters VALUES('".$_COOKIE['4images_userid']."','".$imagen."','".$calificacion."')");
		
			}
	
		mysqli_close($GLOBALS['conexion']);
	
	}

	echo  json_encode($calificacion);
        
  }

  if(isset($_GET['id'])) {
	  
    $id = htmlspecialchars($_GET['id']);
    
    deliver_rating($id);
    
  }

?>
