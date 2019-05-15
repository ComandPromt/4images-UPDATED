<?php

function redireccionar($ruta){
	 echo '<script>location.href="'.$ruta.'";</script>';
}

function deliver_response($status){
    header("HTTP/1.1 $status $status_message");
    $response['respuesta'] = $status;
    $json_response = json_encode($response);
    echo $json_response;
}

function vercampo($nombre,$categoria,$imagen,$image_id){
	
	$icono="fav.ico";
	$like="";
	
	if(isset($_COOKIE['4images_userid'])){
		
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");


    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
        $GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=".$image_id." AND user_id=" . $_COOKIE['4images_userid'] );

    $fila = mysqli_fetch_row($consulta);
	
	if($fila[0]==1){
		$icono="fav_2.ico";
	}
	
	mysqli_close($GLOBALS['conexion']);
	
	$like='<div style="float:left;">
		<form id="frmajax" method="post">
			<a onclick="favorito('.$image_id.')"><img style="height:40px;width:40px;" src="img/'.$icono.'" id="Imagen '.$image_id.'"/></a>
		</form>
		</div>';
	}
	
	print '<td style="border-right:1px solid blue;border-top:0px;border-left:0px;border-bottom:0px;font-size:20px;"><a href="details.php?image_id='.$image_id.'"> <img id="'.$image_id.'" style="height:80px;width:80px;" alt="Imagen '.
	$image_id.'" src="data/media/'.$categoria.'/'.$imagen.'"/></a>'.$like.'
		
		<div style="float:right;">
				<a href="data/media/'.$categoria.'/'.$imagen.'" download>
					<img style="padding-left:20px;height:50px;width:70px;" src="img/download.png"/>
				</a>
		</div>	
	</td>';
	
	
}

function ver_categoria($cat_id){

if($cat_id==='*'){
	$final_sentencia='';
}

else{
	$final_sentencia='WHERE cat_id='.$cat_id;
}

	include('config.php');
	
	if ($conexion->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}
	
	else{
		
		$CantidadMostrar=9;

		$compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
		$TotalReg       =$conexion->query("SELECT
							image_id,
							cat_id,
							image_name,
							image_media_file
							FROM
							4images_images ".$final_sentencia);

		$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
		
		if(isset($_GET['pag'])){
			$_GET['pag']=(int) trim($_GET['pag']);	
		}
		
		else{
			$_GET['pag']=1;
		}
		
		if(is_int($_GET['pag']) && $_GET['pag']<=$TotalRegistro && $_GET['pag']>0){
	
			$consultavistas ="SELECT
								image_id,
								cat_id,
								image_name,
								image_media_file
								FROM
								4images_images ".$final_sentencia."
								ORDER BY
								image_id DESC
								LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
		
			$consulta=$conexion->query($consultavistas);
			
			echo '<div class="table-responsive-xs">
  <table style="border:none;margin:auto;" class="table">';
			
			$ids=array();
			
			$nombres=array();
			
			$categorias=array();
			
			$imagenes=array();
			
			while ($lista=$consulta->fetch_row()) {
				
				$ids[]=$lista[0];
				$categorias[]=$lista[1];
				$nombres[]=$lista[2];
				$imagenes[]=$lista[3];	 
			}
			
				$y=0;		
			for($x=0;$x<count($nombres)-1;$x++){
				print '<tr style="border:none;"><td style="border:none;font-size:20px;">'.$nombres[$y].'</td><td style="font-size:20px;border:none;">'.$nombres[$y+1].'</td><td style="font-size:20px;border:none;">'.$nombres[$y+2].'</td></tr>';
						
				print '<tr style="border:none;">';
				
				vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x]);
					
					++$x;
					
					if(!empty($imagenes[$x])){
						
						vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x]);
					}
					
					++$x;
					
					if(!empty($imagenes[$x])){
						
						vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x]);
					}
					
					print '</tr>';
			}
		
			echo "</table></div>";
			
			if(!isset($_GET['pag'])){
				$IncrimentNum =2;
				$DecrementNum =1;
			}
			
			else{
				
				if($_GET['pag']>=$TotalRegistro){
					$IncrimentNum=$TotalRegistro;
				}
				else{
					$IncrimentNum=$_GET['pag']+1;
						$DecrementNum=$_GET['pag']-1;
				}
		
				if($DecrementNum<=0){
					$DecrementNum=1;
				}
				
			}
			
			$_GET['pag']=(int)$_GET['pag'];
		
			echo '<div style="padding-top:30px;float:right;"><ul>';
			
			if($_GET['pag']>0 && $_GET['pag']>1){
				
				echo '<li style="padding-left:45px;"class="btn"><a href="?pag=1"><<</a></li>

				<li class="btn"><a href="?pag='.$DecrementNum.'"><img style="width:45px;height:45px;" src="img/back.png"/></a></li>';

			}
				
			$Desde=$compag-(ceil($CantidadMostrar/2)-1);
			$Hasta=$compag+(ceil($CantidadMostrar/2)-1);

			$Desde=($Desde<1)?1: $Desde;
			$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
			
			for($i=$Desde; $i<=$Hasta;$i++){
				
				if($i<=$TotalRegistro){
			
				if($i==$compag){
					echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
				}
				else {
					echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
				}     		
				}
			}
					
			if($_GET['pag']>0 && $_GET['pag']<$TotalRegistro){
				
				echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\"><img style=\"width:45px;height:45px;\" src=\"img/next.png\"/></a></li>";
				
				if($IncrimentNum<$TotalRegistro){
					echo "<li class=\"btn\"><a href=\"?pag=".$TotalRegistro."\">>></a></li></ul></div>";
				}
			}
		}
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
		return 'localhost';
	}
}

function restablecer_pass($ruta = ""){
	
	if (isset($_POST['restablecer_pass']) && !empty($_POST['correo_restablecimiento'])

    && !empty($_POST['nombre_usuario'])) {

    $numero_restablecimiento = mt_rand(0, 16585);

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM ' .
        $GLOBALS['table_prefix'] . "users WHERE user_name='" . $_POST['nombre_usuario'] . "'
	AND  user_email='" . $_POST['correo_restablecimiento'] . "'");
    $comprobacion = mysqli_affected_rows($GLOBALS['conexion']);

    if ($comprobacion == 1) {

        $fila = mysqli_fetch_row($consulta);
        $_SESSION['correo_restablecimiento'] = $_POST['correo_restablecimiento'];
        $_SESSION['id_usuario'] = $fila[0];
       redireccionar($ruta.'restablecer_pass.php');
    }

    mysqli_close($GLOBALS['conexion']);

}

	echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title titulo" id="exampleModalLabel">' . ver_dato('cambiar_pass', $GLOBALS['idioma']) . '</h3>
<button style="margin-left:40px;float:right;" type="button" class="close"
data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
          <form method="post" action="' . $_SERVER['PHP_SELF'] . '">
        <div class="form-group">
		<img alt="usuario para registrar" class="icono2" src="'.$ruta.'img/user.png"/>
		<input  name="nombre_usuario" placeholder="' . ver_dato('user_name',
    $GLOBALS['idioma']) . '" type="text" class="form-control" id="recipient-name"/>
<br/>
<img alt="usuario para registrar" class="icono2" src="'.$ruta.'img/email.png"/>
        <input  name="correo_restablecimiento" placeholder="' .
ver_dato('email', $GLOBALS['idioma']) . '"
		type="text" class="form-control" />
      <br/>
	  </div>
		<br/><br/>
           <input name="restablecer_pass" type="submit" value="' .
ver_dato('cambiar_pass', $GLOBALS['idioma']) . '" />
		 </form>
</div>
</div>
</div>';
}

function crear_carpetas(){
	
	if(!file_exists('data/media')){
			mkdir('data/media', 0777, true);
		}
	
	if(!file_exists('data/tmp_media')){
		mkdir('data/tmp_media', 0777, true);
	}
	
}

function ver_dato($accion,$idioma){
	if(file_exists('config.php')){
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
		mysqli_set_charset($GLOBALS['conexion'],"utf8");
		$consulta=mysqli_query($GLOBALS['conexion'],'SELECT texto FROM '.$idioma." WHERE accion='".$accion."'");

		$fila = mysqli_fetch_row($consulta);
	
		return $fila[0];
		mysqli_close($GLOBALS['conexion']);
	}
}

function menu_lateral($ruta = ""){
	
	if($ruta=='todos'){
		$ruta='';
	}
	
print '

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left redondo " style="padding-left:70px;padding-right:20px;width:220px;overflow-x: hidden;" id="mySidebar"><br>
  <div  class="w3-container">
    <a  href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
   
  </div>
  <div style="margin-left:-50px;" class="w3-bar-block">';
  
    if(strpos("index.php",$_SERVER['PHP_SELF'])>=0){
		print '<a href="'.$ruta.'index.php"><img alt="inicio" class="icono" src="'.$ruta.'img/home.png" ></a><hr/>';
	}
	
	if($_GET['l']=='yes' || $_COOKIE['4images_userid']=="-1" || !isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']=="-1"){
		
		print '<form method="post" action="'.$ruta.'login.php" >

       <img alt="usuario" class="icono" style="margin:auto;padding-left:8px;" src="'.$ruta.'img/user.png">
		<br/><br/><input title="user name" style="text-align:center;height:40px;font-size:30px;background-color:#f6fcff;" type="text" name="user_name" class="logininput">
        
		<br/>
		<img alt="contraseña" class="icono" style="margin:auto;" src="'.$ruta.'img/user_pass.png"><br/><br/>
        <input title="user password" style="text-align:center;height:40px;font-size:30px;margin-right:10px;background-color:#f6fcff;" type="password" size="10" name="user_password" class="logininput">
        <br/><br/>

		<input style="margin-top:10px;margin-left:-3px;" title="login" name="login" type="submit" value="'.ver_dato('login',$GLOBALS['idioma']).'" class="button">
      </form>
	  <hr/>
	  
	  <a style="font-size:15px;" href="'.$ruta.'register.php"><img alt="registar" class="icono" src="'.$ruta.'img/registrar.png"></a>
	  <a  data-toggle="modal" data-target="#exampleModal">
	  <img alt="'.ver_dato('recordar',$GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/forgot_password.png"/>
	 </a>
	 ';
	}
	
	else{

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
		$consulta = mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_COOKIE['4images_userid']."'");
		$fila = mysqli_fetch_row($consulta);

		mysqli_close($GLOBALS['conexion']);

		print '
		<a href="'.$ruta.'messages/index.php"><img style="height:55px;width:55px;" src="'.$ruta.'img/email.png"></a>
	  <img class="icono" src="'.$ruta.'img/user.png"/><br/><br/><span class="redondo" style="font-size:24px;">'.$fila[0].'</span>
      <a href="'.$ruta.'lightbox.php"><br/><br/><img class="icono" src="'.$ruta.'img/fav.png"></a><br>
	  <br><a href="'.$ruta.'member.php?action=editprofile"><img class="icono" src="'.$ruta.'img/settings.png"></a><br/>
       <br>
	   <form action="'.$_SERVER['PHP_SELF'].'" method="post">
	   <a href="'.$ruta.'logout.php" ><img style="padding-bottom:10px;" class="icono" src="'.$ruta.'img/logout.png"></a>
	   </form>';
	}
	
print '<hr/>';

$imagen_aleatoria=imagen_aleatoria();

$image_thumb=substr($imagen_aleatoria,strpos($imagen_aleatoria,"-")+1,strpos($imagen_aleatoria,"*"));
$image_thumb=substr($image_thumb,0,strpos($image_thumb,"*"));

if($imagen_aleatoria!="vacio"){
	
	print '
	<img alt="aleatorio" class="icono" src="'.$ruta.'img/aleatorio.png"/>
	<br/><br/>';

	$image_id=substr($imagen_aleatoria,strpos($imagen_aleatoria,"*")+1,strpos($imagen_aleatoria,"#"));
	$image_id=substr($image_id,0,strpos($image_id,"#"));

	print '
	<a href="'.$ruta.'details.php?image_id='.$image_id.'">
	<img style="height:120px;width:120px;"  src="'.$ruta.'data/media/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb.'" alt="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" title="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'"/></a>
	<br/><br/>
	<hr/>
	';
}

$redes_sociales='';

  if(gettype($GLOBALS['facebook'])=='string' && $GLOBALS['facebook']!=""){
	$redes_sociales.='<a target="_blank" href="https://www.facebook.com/'.$GLOBALS['facebook'].'"><img alt="Facebook" class="social" src="'.$ruta.'img/Social/facebook.png"/></a>';  
  }
  
  if(gettype($GLOBALS['instagram'])=='string' && $GLOBALS['instagram']!=""){
	$redes_sociales.=' <a target="_blank" href="https://www.instagram.com/'.$GLOBALS['instagram'].'/"><img alt="Instagram" class="social" src="'.$ruta.'img/Social/instagram.png"/></a>';  
  }
  
    if(gettype($GLOBALS['twitter'])=='string' && $GLOBALS['twitter']!=""){
	$redes_sociales.='<a target="_blank" href="https://twitter.com/'.$GLOBALS['twitter'].'"><img alt="Twitter" class="social" src="'.$ruta.'img/Social/twitter.png"/></a>';  
  }
  
    if(gettype($GLOBALS['youtube'])=='string' && $GLOBALS['youtube']!=""){
	$redes_sociales.='<a target="_blank" href="https://www.youtube.com/user/'.$GLOBALS['youtube'].'"><img alt="Youtube" class="social" src="'.$ruta.'img/Social/youtube.png"/></a>';   
  }
  
    if(gettype($GLOBALS['debianart'])=='string' && $GLOBALS['debianart']!=""){
	$redes_sociales.='<br/><a target="_blank" href="https://www.deviantart.com/'.$GLOBALS['debianart'].'/gallery/?catpath=scraps"><img alt="Debianart" class="social" src="'.$ruta.'img/Social/debianart.png"/></a>';   
  }
  
    if(gettype($GLOBALS['slideshare'])=='string' && $GLOBALS['slideshare']!=""){
		
		if(empty($GLOBALS['deviantart'])){
			$redes_sociales.='<br/>';
		}
		
	$redes_sociales.='<a target="_blank" href="https://es.slideshare.net/'.$GLOBALS['slideshare'].'"><img class="social" alt="Slideshare" src="'.$ruta.'img/Social/slideshare.png"/></a>';  
   }
   
    if(gettype($GLOBALS['github'])=='string' && $GLOBALS['github']!=""){
		
		if(empty($GLOBALS['debianart']) && empty($GLOBALS['instagram'])){
			$redes_sociales.='<br/>';
		}
		
	$redes_sociales.='<a target="_blank" href="https://github.com/'.$GLOBALS['github'].'"><img class="social" alt="Github" src="'.$ruta.'img/Social/github.png"/></a>';    
  }
      

     if(!empty($redes_sociales)){
		print '<div style="-moz-transform: scale(1.5,1.5);zoom:150%;" class="w3-panel w3-large">';
		print $redes_sociales.'</div>
		<hr/>';
	 }        	     

if($_COOKIE['4images_userid']>=0 && file_exists('config.php')){
	
	$vars = get_defined_vars();  


	$administrators=array();

	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM '.$GLOBALS['table_prefix'].'users WHERE user_level=9');
	 
	while ($administradores = mysqli_fetch_array($consulta)){
		$administrators[]=$administradores[0];
	}
	
	mysqli_close($GLOBALS['conexion']);
	 
	if(in_array($_COOKIE['4images_userid'], $administrators)){
		print '<a href="'.$ruta.'admin/index.php"><img class="icono" src="'.$ruta.'img/admin.png"  border="0"></a><br/>';
	}
		
}

print '
 <br/> <a href="'.$ruta.'rss.php?action=images"><img class="icono" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" /></a>
<br/><br/><br/><br/><br/><br/><br/>
</div>
</nav>';

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
	
if(file_exists('config.php')){
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(cat_id) FROM '.$GLOBALS['table_prefix'].'categories');
	$recuento = mysqli_fetch_row($consulta);
	
	if($recuento[0]>0){
		print '<aside style="float:right;margin-left:37%;margin-top:-45px;position:fixed;">
	<div >
				<div>
					<div style="width:160px;float:right;" id="dl-menu" class="dl-menuwrapper">
					<br/>	<button class="dl-trigger"></button>
						<ul style="margin-top:-15px;font-size:40px;"  class="dl-menu">
						';		
								$id_categorias=array();

	  $consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT DISTINCT(cat_parent_id) FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id>0');

	  while ($recuento = mysqli_fetch_row($consulta)){
			$id_categorias[]=$recuento[0];
		}

		for($x=0;$x<count($id_categorias);$x++){
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_id='.$id_categorias[$x]);
			$fila = mysqli_fetch_row($consulta);
			
			print '
			<li  class="menu_categorias">
			<a style="color:#ffffff;font-size:20px;font-weight:bold;" href="#">'.$fila[0].'</a>';
			
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id='.$id_categorias[$x]);
			
			$y=1;

			while ($subcategorias = mysqli_fetch_array($consulta)){
				if($y==1){
					print '<ul style="margin-top:10px;" class="dl-submenu">';
					print '<li style="first-child:margin-top:15px;">
							<a style="margin-top:20px;font-size:20px;font-weight:bold;" href="categories.php?cat_id='.$subcategorias[1].'">'.$subcategorias[0].'</a>
					   </li>';
				}
else{
				print '<li>
							<a style="font-size:20px;font-weight:bold;" href="#">'.$subcategorias[0].'</a>
					   </li>';
}
				$y++;		
			}
				print '</ul>
							</li>';	
		}

	  $consulta = mysqli_query($GLOBALS['conexion'], 
	  'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id=0 AND cat_id NOT IN (SELECT DISTINCT cat_parent_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id!=0)');

	while ($fila = mysqli_fetch_row($consulta)){

		print '
			<li class="menu_categorias menu">
			<a style="color:#ffffff;font-size:20px;font-weight:bold;" href="categories.php?cat_id='.$fila[1].'">'.$fila[0].'</a></li>';
	}
		
print '		</ul>
					</div>
				</div>
			</div></aside>

	';
	}
}
}

function imagen_aleatoria(){
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	  $consulta = mysqli_query($GLOBALS['conexion'],'SELECT MAX(image_id) FROM '.$GLOBALS['table_prefix'].'images WHERE image_active=1');

 if(mysqli_affected_rows($GLOBALS['conexion'])>0){
		  $num_imagenes = mysqli_fetch_array($consulta);
	  if($num_imagenes[0]!=""){
	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT FLOOR(RAND()*'.$num_imagenes[0].')+1');
	  $id_imagen_aleatoria = mysqli_fetch_array($consulta);
	  $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_id,image_media_file,image_id,image_name FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$id_imagen_aleatoria[0]);
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