<?php

function url_exists($url){
	
$file_headers = @get_headers($url);

if(strpos($file_headers[0],"200 OK")==false){
	return false;
}

else{
	return true;
}

}

function rmDir_rf($carpeta){
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
}

function mensaje($mensaje){
	if(!empty($mensaje)){
		echo '<script>alert("'.$mensaje.'");</script>';
	}
}

function obtener_direccion(){
	if(strlen($_SERVER['SERVER_NAME'])>9){
		$adicional="";

		if(!empty($_SERVER["REQUEST_URI"])){
			$adicional=$_SERVER["REQUEST_URI"];
			$adicional=substr($adicional,0,strripos($adicional,'/')+1);
		}
		
		return $_SERVER['SERVER_NAME'].$adicional;
	}
	else{
		return 'localhost/';
	}
}

function crear_carpetas(){
	if(!file_exists('data/media')){
			mkdir('data/media', 0777, true);
		}
	
	if(!file_exists('data/thumbnails')){
		mkdir('data/thumbnails', 0777, true);
	}
	if(!file_exists('data/tmp_media')){
		mkdir('data/tmp_media', 0777, true);
	}
	if(!file_exists('data/tmp_thumbnails')){
		mkdir('data/tmp_thumbnails', 0777, true);
	}
}

function ver_dato($accion,$idioma){
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

	$consulta=mysqli_query($GLOBALS['conexion'],'SELECT texto FROM '.$idioma." WHERE accion='".$accion."'");

	$fila = mysqli_fetch_row($consulta);
	
	return $fila[0];
	mysqli_close($GLOBALS['conexion']);
}

function menu_lateral(){
	
print '

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left redondo " style="padding-left:70px;padding-right:20px;width:220px;overflow-x: hidden;" id="mySidebar"><br>
  <div  class="w3-container">
    <a  href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
   
  </div>
  <div style="margin-left:-50px;" class="w3-bar-block">';
  
    if(strpos("index.php",$_SERVER['PHP_SELF'])>=0){
		print '<p><a href="index.php"><img alt="inicio" class="icono" src="img/home.png" ></a><br/><br/></p><hr/>';
	}
	
print '<br/>';

	if($_GET['l']=='yes' || $_COOKIE['4images_userid']=="-1" || !isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']=="-1"){
		
		print '<form method="post" action="login.php" >

       <img alt="usuario" class="icono" style="margin:auto;padding-left:8px;" src="img/user.png">
		<br/><br/><input title="user name" style="text-align:center;height:40px;font-size:30px;background-color:#f6fcff;" type="text" name="user_name" class="logininput">
        
		<br/>
		<img alt="contraseña" class="icono" style="margin:auto;" src="img/user_pass.png"><br/><br/>
        <input title="user password" style="text-align:center;height:40px;font-size:30px;margin-right:10px;background-color:#f6fcff;" type="password" size="10" name="user_password" class="logininput">
        <br/><br/>

		<input style="margin-top:10px;margin-left:-3px;" title="login" name="login" type="submit" value="'.ver_dato('login',$GLOBALS['idioma']).'" class="button">
      </form>
	  <hr style="padding-bottom:10px"/>
	  
	  <a style="font-size:15px;" href="./register.php"><img alt="registar" style="height:80px;width:80px;margin:auto;float:left;" src="img/registrar.png"></a>
	  <a  data-toggle="modal" data-target="#exampleModal">
	  <img alt="'.ver_dato('recordar',$GLOBALS['idioma']).'" style="height:80px;width:60px;margin:auto;float:left;" src="img/forgot_password.png"/>
	 </a>
	  <br/><br/><br/><br/>';
	}
	else{


	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_COOKIE['4images_userid']."'");
	$fila = mysqli_fetch_row($consulta);

	mysqli_close($GLOBALS['conexion']);

		print '
		
<a href="messages/index.php"><img style="height:55px;width:55px;" src="img/email.png"></a>
	  <img class="icono" src="img/user.png"/><br/><br/><span   class="redondo" style="font-size:28px;">'.$fila[0].'</span>
      <a href="lightbox.php"><br/><br/><img class="icono" src="img/fav.png"></a><br>
	  <br><a href="member.php?action=editprofile"><img class="icono" src="img/settings.png"></a><br/>
       <br>
	   <form action="'.$_SERVER['PHP_SELF'].'" method="post">
	   <a href="logout.php" ><img style="padding-bottom:10px;" class="icono" src="img/logout.png"></a>
	   </form>';



	}
print '<hr/>';

$imagen_aleatoria=imagen_aleatoria();

$image_thumb=substr($imagen_aleatoria,strpos($imagen_aleatoria,"-")+1,strpos($imagen_aleatoria,"*"));
$image_thumb=substr($image_thumb,0,strpos($image_thumb,"*"));

if($imagen_aleatoria!="vacio" && !empty($GLOBALS['cms_host']) && url_exists( $GLOBALS['protocolo'].'://'.$GLOBALS['cms_host'].'/data/thumbnails/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb)){
	print '
<img alt="aleatorio" class="icono" src="img/aleatorio.png"/>
<br/><br/>';

	$image_id=substr($imagen_aleatoria,strpos($imagen_aleatoria,"*")+1,strpos($imagen_aleatoria,"#"));
	$image_id=substr($image_id,0,strpos($image_id,"#"));

	print '
	<a href="./details.php?image_id='.$image_id.'">
	<img style="height:120px;width:120px;"  src="'.$GLOBALS['protocolo'].'://'.$GLOBALS['cms_host'].'/data/thumbnails/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb.'" alt="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" title="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'"/></a>
	<br/><br/>
	<hr/>
	';
}
$redes_sociales='';
  if(gettype($GLOBALS['facebook'])=='string' && $GLOBALS['facebook']!=""){
	$redes_sociales.='<a target="_blank" href="https://www.facebook.com/'.$GLOBALS['facebook'].'"><img alt="Facebook" class="social" src="img/Social/facebook.png"/></a>';  
  }
  if(gettype($GLOBALS['instagram'])=='string' && $GLOBALS['instagram']!=""){
	$redes_sociales.=' <a target="_blank" href="https://www.instagram.com/'.$GLOBALS['instagram'].'/"><img alt="Instagram" class="social" src="img/Social/instagram.png"/></a>';  
  }
    if(gettype($GLOBALS['twitter'])=='string' && $GLOBALS['twitter']!=""){
	$redes_sociales.='<a target="_blank" href="https://twitter.com/'.$GLOBALS['twitter'].'"><img alt="Twitter" class="social" src="img/Social/twitter.png"/></a>';  
  }
    if(gettype($GLOBALS['youtube'])=='string' && $GLOBALS['youtube']!=""){
	$redes_sociales.='<a target="_blank" href="https://www.youtube.com/user/'.$GLOBALS['youtube'].'"><img alt="Youtube" class="social" src="img/Social/youtube.png"/></a>';   
  }
    if(gettype($GLOBALS['debianart'])=='string' && $GLOBALS['debianart']!=""){
	$redes_sociales.='<br/><a target="_blank" href="https://www.deviantart.com/'.$GLOBALS['debianart'].'/gallery/?catpath=scraps"><img alt="Debianart" class="social" src="img/Social/debianart.png"/></a>';   
  }
    if(gettype($GLOBALS['slideshare'])=='string' && $GLOBALS['slideshare']!=""){
		if(empty($GLOBALS['deviantart'])){
			$redes_sociales.='<br/>';
		}
	$redes_sociales.='<a target="_blank" href="https://es.slideshare.net/'.$GLOBALS['slideshare'].'"><img class="social" alt="Slideshare" src="img/Social/slideshare.png"/></a>';  
    }
    if(gettype($GLOBALS['github'])=='string' && $GLOBALS['github']!=""){
		if(empty($GLOBALS['debianart']) && empty($GLOBALS['instagram'])){
			$redes_sociales.='<br/>';
		}
	$redes_sociales.='<a target="_blank" href="https://github.com/'.$GLOBALS['github'].'"><img class="social" alt="Github" src="img/Social/github.png"/></a>';    
  }
      

     if(!empty($redes_sociales)){
		print '<div style="-moz-transform: scale(1.5,1.5);zoom:150%;" class="w3-panel w3-large">';
		print $redes_sociales.'</div>
<hr/>';
	 }        	     

if($_COOKIE['4images_userid']>=0){
	
	  $vars = get_defined_vars();  


	$administrators=array();

	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM '.$GLOBALS['table_prefix'].'users WHERE user_level=9');
	  while ($administradores = mysqli_fetch_array($consulta)){
		  $administrators[]=$administradores[0];
		
	  }
	 mysqli_close($GLOBALS['conexion']);
	 
if(in_array($_COOKIE['4images_userid'], $administrators)){
	
	print '<br/><a href="admin/index.php"><img class="icono" src="img/admin.png"  border="0"></a><br/>';
	
}

}

print '
<br/>
  <a href="rss.php?action=images"><img class="icono" src="img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" /></a>
<br/><br/><br/><br/><br/><br/><br/>
</div>
</nav>';

}

function menu_categorias(){
print '
<div id="navega"  > 
<div id="menu"> 
<div id="fijo">

    <a style="zoom:300%;float:left;margin-left:7px;margin-top:2px;" id="menu_usuario" onclick="w3_open();"><i style="float:left" class="fa fa-bars"></i></a>
<br/>
	

	</div>
</div>
</div>

 ';
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
	
	print '
<aside style="float:right;margin-left:20%;margin-top:-50px;position:fixed;z-index: 1;">
	<div >
	
				<div>
					<div style="" id="dl-menu" class="dl-menuwrapper">
					<br/>	<button class="dl-trigger"></button>
						<ul style="font-size:40px;"  class="dl-menu">
						';		
								$id_categorias=array();
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT DISTINCT(cat_parent_id) FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id 
IN(SELECT  distinct(cat_parent_id) FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id>0)
;');



	  while ($recuento = mysqli_fetch_row($consulta)){
			$id_categorias[]=$recuento[0];
		}

		for($x=0;$x<count($id_categorias);$x++){
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_id='.$id_categorias[$x]);
			$nombre = mysqli_fetch_row($consulta);
			
			print '
			<li  class="menu_categorias">
			<a style="color:#0024EA;font-size:30px;" href="#">'.$nombre[0].'</a>';
			
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id='.$id_categorias[$x]);
			
			$y=1;
			while ($subcategorias = mysqli_fetch_array($consulta)){
				if($y==1){
					print '<ul class="dl-submenu">';
				}
				print '<li style="background-color:black;font-size:30px;">
							<a href="#">'.$subcategorias[0].'</a>
					   </li>';
									
		//	<img alt="'.$subcategorias[1].'" src="img/Categories/Subcategories/'.$subcategorias[1].'.png" style="width:100px;height:100px;"/></a></li>';
$y++;		
		}
	
			print '</ul>
							</li>';	
					
		}

print '		</ul>
					</div>
				</div>
			</div></aside>

	';
	

}

function imagen_aleatoria(){
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	  $consulta = mysqli_query($GLOBALS['conexion'],'SELECT MAX(image_id) FROM '.$GLOBALS['table_prefix'].'images WHERE image_active=1');

 if(mysqli_affected_rows($GLOBALS['conexion'])>0){
		  $num_imagenes = mysqli_fetch_array($consulta);
	  if($num_imagenes[0]!=""){
	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT FLOOR(RAND()*'.$num_imagenes[0].')+1');
	  $id_imagen_aleatoria = mysqli_fetch_array($consulta);
	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_id,image_thumb_file,image_id,image_name FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$id_imagen_aleatoria[0]);
	  $imagen_aleatoria = mysqli_fetch_array($consulta);
	  
return $imagen_aleatoria[0]."-".$imagen_aleatoria[1]."*".$imagen_aleatoria[2]."#".$imagen_aleatoria[3];
	  }
	   else{
	 return 'vacio';
 }
 }
 else{
	 return 'vacio';
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

function conectarBd(){
  include_once('../config.php');
 return mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("No se pudo conectar a la base de datos");
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