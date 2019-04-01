<?php

  function set_cookie_data($name, $value, $permanent = 1) {
    $cookie_expire = ($permanent) ? $this->current_time + 60 * 60 * 24 * 365 : 0;
    $cookie_name = COOKIE_NAME.$name;
    setcookie($cookie_name, $value, $cookie_expire, COOKIE_PATH, COOKIE_DOMAIN, COOKIE_SECURE);
    $HTTP_COOKIE_VARS[$cookie_name] = $value;
  }
  
function salted_hash($value, $salt = null, $length = 9, $hash_algo = 'md5') {
  if ($salt === null) {
    $salt = random_string($length);
  }

  $salt = substr($salt, 0, $length);

  if (!function_exists('hash') && $hash_algo == 'md5') {
    $hash = md5($salt . $value);
  } else {
    $hash = hash($hash_algo, $salt . $value);
  }

  return $salt . ':' . $hash;
}

function secure_compare($a, $b) {
  if (strlen($a) !== strlen($b)) {
    return false;
  }
  $result = 0;
  for ($i = 0; $i < strlen($a); $i++) {
    $result |= ord($a[$i]) ^ ord($b[$i]);
  }
  return $result == 0;
}

function compare_passwords($plain, $hashed) {

  if (strpos($hashed, ':') === false) {
    return secure_compare(md5($plain), $hashed);
  }

  return secure_compare(salted_hash($plain, $hashed), $hashed);
}

function random_string($length, $letters_only = false) {
  $str = '';

  if (!$letters_only) {
    while (strlen($str) <= $length) {
      $str .= md5(uniqid(rand(), true));
    }

    return substr($str, 0, $length);
  }

  for ($i = 0; $i < $length; $i++) {
    switch (mt_rand(1, 2)) {
      case 1:
        $str .= chr(mt_rand(65, 90));
        break;
      case 2:
        $str .= chr(mt_rand(97, 122));
        break;
    }
  }

  return $str;
}

function poner_menu(){
	include('config.php');
	$id_categorias=array();
	  $consulta = mysqli_query($conexion, 'SELECT DISTINCT(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id 
IN(SELECT  distinct(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id>0)
;');
	  while ($recuento = mysqli_fetch_array($consulta)){
			$id_categorias[]=$recuento[0];
		}

		for($x=0;$x<count($id_categorias);$x++){
			$consulta = mysqli_query($conexion, 'SELECT cat_name FROM '.$table_prefix.'categories WHERE cat_id='.$id_categorias[$x]);
			$nombre = mysqli_fetch_array($consulta);
			print '<li style="color:#1842EC;padding-left:30px;margin-top:-20px;">
			<a style="font-size:30px;" href="#resume"><img alt="'.$nombre[0].'" style="width:100px;height:100px;" src="img/Categories/'.$nombre[0].'.png"/>
			</a>
			<br/><br/>
			<ul style="width:10em;" class="menu">';
			$consulta = mysqli_query($conexion, 'SELECT cat_id,cat_name FROM '.$table_prefix.'categories WHERE cat_parent_id='.$id_categorias[$x]);
			while ($subcategorias = mysqli_fetch_array($consulta)){
				print '<li style="height:10em;" ><a href="categories.php?cat_id='.$subcategorias[0].'">
				<img alt="'.$subcategorias[1].'" src="img/Categories/Subcategories/'.$subcategorias[1].'.png" style="width:100px;height:100px;"/></a></li>';
			}
	
			print '</ul>
			</li>';	
					
		}
}

function imagen_aleatoria(){
include('config.php');
$ids=array();

	 
	  $consulta = mysqli_query($conexion, 
	  'SELECT image_id FROM '.$table_prefix.'images WHERE image_active=1 ORDER BY 1');
	 if(mysqli_affected_rows($conexion)>0){
	  while ($recuento = mysqli_fetch_array($consulta)){
			$ids[]=$recuento[0];
		}
			$consulta = mysqli_query($conexion, 'SELECT cat_id,image_thumb_file,image_id,image_name FROM '.$table_prefix.'images WHERE image_id='.$ids[array_rand($ids)]);
	  $imagen_aleatoria = mysqli_fetch_array($consulta);
return $imagen_aleatoria[0]."-".$imagen_aleatoria[1]."*".$imagen_aleatoria[2]."#".$imagen_aleatoria[3];
}
else{
	return "vacio";
}
}

function enviar($para, $asunto, $mensaje, $archivo,$remitente,$tipo){

  switch($tipo){
  
      case 'gmail':
      $seguridad="ssl";
      $host="smtp.gmail.com";
      $puerto=465;
      break;
  
      case 'hotmail':
      $seguridad="tls";
      $host="smtp.live.com";
      $puerto=587;
      break;
  
  }
  
      include_once 'class.phpmailer.php';
      include_once 'class.smtp.php';
  
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPAuth = true;
  
      $mail->SMTPSecure = $seguridad;
      $mail->Host = $host;
      $mail->Port = $puerto;
  
      $mail->Username = 'grulargo@gmail.com';
      $mail->Password = 'minions1'; 
  
      $mail->FromName = $remitente;
      $mail->AddAddress($para);
      $mail->Subject = $asunto;
      $mail->Body = $mensaje;
  
      /*  Añadir una imagen incrustada
          $mail->AddEmbeddedImage("rocks.png", "my-attach", "rocks.png"); 
          $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach">'; 
      */
  
      $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
      $mail->MsgHTML($mensaje);
      $mail->From = $mail->Username;
  
      if ($mail->Send()) {
          echo '<script type="text/javascript">
              alert("Enviado Correctamente");
           </script>';
      }
      
      else {
          echo '<script type="text/javascript">
              alert("NO ENVIADO, intentar de nuevo");
           </script>';
      }
  }

function consecutivos(array $array){
	if(count($array)>0 && $array[0]!=null && $array[0]==1){
        asort($array);
        for($x=0;$x<count($array);$x++){
            if($x+1<count($array)){
            if($array[$x]+1!=$array[$x+1]){
                $numero=$array[$x]+1;
                $x=count($array);
                $noc=true;
            }
            }
        }
        if(!isset($noc)){
            $numero=count($array)+1;
        }
  
    }
    else{
        $numero=1;
    }
	return $numero;
}

function comprobar_si_es_valido($cadena,array $lista_negra){

	$valido=true;	
	
	for($x=0;$x<count($lista_negra);$x++){
		$numero=strpos($cadena,$lista_negra[$x]);

		if(gettype($numero)=="boolean"){
			$valido=true;	
		}
		else{
			if($numero>=0){
				
				$valido=false;	
				$x=count($lista_negra);
			}
		}

	}
	
	return $valido;
}

function eliminar_espacios($cadena){
	$cadena=trim($cadena);
	$cadena=str_replace("  "," ",$cadena);
	$cadena=strip_tags($cadena);
	return $cadena;
}

function png_a_jpg($imagen) {

		if(substr($imagen, -3)=="png" && file_exists($imagen)){
        $jpg = substr($imagen, 0, -3) . "jpg";
        $image = imagecreatefrompng($imagen);
        imagejpeg($image, $jpg, 100);
        unlink($imagen);
		}
}

function redimensionarJPG($max_ancho, $max_alto, $ruta) {

            if ($max_ancho == 100 && $max_alto == 125) {
               copy($ruta,substr($ruta, 0, -4) . "_Thumb" . substr($ruta, -4));
			   $ruta=substr($ruta, 0, -4) . "_Thumb" . substr($ruta, -4);
            } 
        
            $img_original = imagecreatefromjpeg($ruta);
            list($ancho, $alto) = getimagesize($ruta);

            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;

            if (($ancho <= $max_ancho) && ($alto <= $max_alto)) {
                $ancho_final = $ancho;
                $alto_final = $alto;
            } elseif (($x_ratio * $alto) < $max_alto) {
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            } else {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            $tmp = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
            imagedestroy($img_original);
            imagejpeg($tmp, $ruta, 100);
}

?>