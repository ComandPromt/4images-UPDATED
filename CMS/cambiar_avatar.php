<?php

session_start();

$_SESSION['track']=false;

$_SESSION['pagina']="member.php";

include_once('config.php');

include('includes/funciones.php');

cabecera();

comprobar_cookie();

poner_menu();

poner_menu_conf();

print '<div class="content">';


	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name'])
	or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'], 'SELECT avatar FROM '.$GLOBALS['table_prefix'] . "users WHERE user_id='".$_COOKIE['4images_userid']."'");
	
	$fila = mysqli_fetch_row($consulta);
	
	$fila[0]=trim($fila[0]);
	
	if($fila[0]!='nofoto.jpg' && !empty($fila[0])){
		print '
		<hr/>
		<img alt="avatar" style="height:150px;width:150px;" src="avatars/'.$fila[0].'" />
		<hr/>';
	}
	
	mysqli_close($GLOBALS['conexion']);
	
print '<form enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'" method="post">
<p><input style="font-size:25px;" name="uploadedfile" type="file"/></p>
<p><input style="font-size:25px;" type="submit" value="'.ver_dato('cambiar_avatar', $GLOBALS['idioma']).'"/></p>
</form>
</div></div>';

if(!file_exists('avatars')){
	mkdir('avatars');
}

$extension= substr($_FILES['uploadedfile']['name'], -4);

if($extension=='jpeg' || $extension=='JPEG' || $extension=='.JPG'){
	$extension='.jpg';
}

$ext_validas = array(".jpg",".JPG", ".png", ".PNG", ".gif", ".GIF");
 
if(!in_array($extension, $ext_validas)){
	$avatar='nofoto.jpg';
}

if($avatar!="nofoto.jpg"){
	
	$nombre = date('Y').'_'.date('m').'_'.date('j').'_'.date('G').'-'.date('i').'-'.date('s');
	
	$extension=strtolower($extension);
	
	$avatar=$nombre.$extension; 
}
	
$target_path = "avatars/" . basename($avatar);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){ 

	rename('avatars/'.$_FILES['uploadedfile']['name'],'avatars/'.$avatar);
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name'])
	or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'], 'SELECT avatar FROM '.$GLOBALS['table_prefix'] . "users WHERE user_id='".$_COOKIE['4images_userid']."'");

	$fila = mysqli_fetch_row($consulta);

	if(file_exists('avatars/'.$fila[0])){
		unlink('avatars/'.$fila[0]);
	}

	mysqli_query($GLOBALS['conexion'], 'UPDATE '.$GLOBALS['table_prefix'] . "users SET avatar='".$avatar."' WHERE user_id='".$_COOKIE['4images_userid']."'");
	
	mysqli_close($GLOBALS['conexion']);
	
	redireccionar('index.php');
}

restablecer_pass();
		
footer();
 
?>