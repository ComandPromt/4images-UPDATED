<?php      

if (isset($_FILES['archivo'])) {
	
	if(file_exists('../config.php') && (isset($_GET['username']) && !empty($_GET['username']) 
	&& isset($_GET['pass'])&& !empty($_GET['pass'])
	&& isset($_GET['nombre_imagen'])&& !empty($_GET['nombre_imagen'])
	&& isset($_GET['cat_id'])
    && !empty($_GET['cat_id'])) && $_GET['cat_id']>0){

	include('../config.php');
	include('../includes/funciones.php');
	
	$_GET['username']=trim($_GET['username']);
	$_GET['pass']=trim($_GET['pass']);
		
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_password,user_id FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$_GET['username']."'");
	
	if(mysqli_affected_rows($GLOBALS['conexion'])==1){

		$fila = mysqli_fetch_row($consulta);

		if(compare_passwords($_GET['pass'], $fila[0])){

			$file = $_FILES["archivo"];
			$tipo = $file['type'];
			$path = $file['tmp_name'];
			$size = $file['size'];
			$nombre = $file['name'];
			$dimensiones = getimagesize($path);
			$width = $dimensiones[0];
			$height = $dimensiones[1];
			$imagen = NULL;
			$urlImagen = NULL;
		
			switch($tipo){
				
				case "image/jpg":
				case "image/jpeg":
				case "image/JPG":
				case "image/JPEG":
					$imagen = imagecreatefromjpeg($path);
				break;
				
				case "image/png":
				case "image/PNG":
					$imagen = imagecreatefrompng($path);
				break;
		
				default:
					deliver_response(300);
				break;
			}
		}
    } 
	
    if (is_uploaded_file($path) && $imagen != NULL) {
		
        $tipo = str_replace("../data/media/".$_GET['cat_id']."/", "", $tipo);
		
        $urlImagen = "../data/media/".$_GET['cat_id'] . "/".$_GET['nombre_imagen'];

        $image_p = imagecreatetruecolor($width, $height);
		
        imagecopyresampled($image_p, $imagen, 0, 0, 0, 0, $width, $height, $width, $height);
        
		$uploaded = imagejpeg($image_p, $urlImagen);
		
        if ($uploaded) {
            deliver_response(200);
        } else {
           deliver_response(401);
        }
    }
		mysqli_close($GLOBALS['conexion']);
		}
	}		
     
?>