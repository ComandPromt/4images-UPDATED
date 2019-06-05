<?php
 
session_start();

date_default_timezone_set('Europe/Madrid');

function is_private_ip($ip){

	if($ip=='127.0.0.1'){
		$resultado=true;
	}
	
	else{
		$resultado=!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
	}
     return $resultado;
}

function cabecera($ruta=""){

date_default_timezone_set('Europe/Madrid');

print '

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="revisit-after" content="10 days">
	
	<script src="'.$ruta.'js/funciones.js"></script>
	<link rel="stylesheet" href="'.$ruta.'css/styles.css">
	<link rel="stylesheet" href="'.$ruta.'css/w3.css">
	<link rel="stylesheet" href="'.$ruta.'css/bootstrap.min.css">
    <link rel="stylesheet" href="'.$ruta.'css/jquery.scrollbar.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="'.$ruta.'css/css.css">
	<link rel="stylesheet" href="'.$ruta.'css/main.css">
	<link rel="stylesheet" href="'.$ruta.'css/style.css">
	<link rel="stylesheet" href="'.$ruta.'css/estilos.css">
    <link rel="stylesheet" href="'.$ruta.'css/scroll.css" />
    <link rel="stylesheet" href="'.$ruta.'css/prettify.css" />
	<link rel="stylesheet" type="text/css" href="'.$ruta.'css/default.css" />
	<link rel="stylesheet" type="text/css" href="'.$ruta.'css/component.css" />
	<link rel="stylesheet" type="text/css" href="'.$ruta.'tooltip/css/estiloDelEjemplo.css">
	<link rel="stylesheet" type="text/css" href="'.$ruta.'tooltip/css/estilo.css">
	<link rel="stylesheet" type="text/css" href="'.$ruta.'css/scrollbar.css" />
	<link rel="stylesheet" type="text/css" href="'.$ruta.'css/tablas.css" />
	<link rel="icon" type="image/ico" href="'.$ruta.'/img/favicon.ico">

	<script  src="'.$ruta.'tooltip/js/tooltip.js"></script>
 
	<title>Web</title>
	
	<script>
		//Especificar a que elementos afectará, añadiendo o quitando de la lista:
		var tgs = new Array( \'div\',\'td\',\'tr\');
		
		//Indicar el nombre de los diferentes tamaños de fuente:
		var szs = new Array( \'xx-small\',\'x-small\',\'small\',\'medium\',\'large\',\'x-large\',\'xx-large\' );
		var startSz = 2;
		
		function ts( trgt,inc ) {
			if (!document.getElementById) return
			
			var d = document,cEl = null,sz = startSz,i,j,cTags;
			
			sz += inc;
			
			if ( sz < 0 ) sz = 0;
			if ( sz > 6 ) sz = 6;
			
			startSz = sz;
			
			if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];
			
			cEl.style.fontSize = szs[ sz ];
			
			for ( i = 0 ; i < tgs.length ; i++ ) {
				cTags = cEl.getElementsByTagName( tgs[ i ] );
				for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
			}
		}
		
		var captcha_reload_count = 0;
		var captcha_image_url = "./captcha.php";
		
		function new_captcha_image() {
			if (captcha_image_url.indexOf(\'?\') == -1) {
				document.getElementById(\'captcha_image\').src= captcha_image_url+\'?c=\'+captcha_reload_count;
				} else {
				document.getElementById(\'captcha_image\').src= captcha_image_url+\'&c=\'+captcha_reload_count;
				}
		
			document.getElementById(\'captcha_input\').value="";
			document.getElementById(\'captcha_input\').focus();
			captcha_reload_count++;
		}
				
		if (document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = right;
		}
		else if (document.all && !document.getElementById){
			document.onmousedown = right;
		}
		
		var txt = "'.$GLOBALS['site_name'].'";
			document.oncontextmenu = new Function("alert(\'© Copyright by "+txt+"\');return false");
			txt=txt.toUpperCase();
			txt=" "+txt+"  ";
			var espera=600;
			var refresco=null;
		
			function rotulo_title() {
				document.title=txt;
				txt=txt.substring(1,txt.length)+txt.charAt(0);
				refresco=setTimeout("rotulo_title()",espera);
			}
			
			rotulo_title();
	
	</script>
	
	<link rel="alternate" type="application/rss+xml" title="RSS Feed: '.$GLOBALS['site_name'].'" href="'.$ruta.'rss.php">

	</head>
<body style="zoom:90%;">

<div id="navega"> 

<div id="menu"> 

<div id="fijo">

    <a style="zoom:300%;float:left;margin-left:7px;margin-top:2px;" id="menu_usuario" onclick="w3_open();"><i style="float:left" class="fa fa-bars"></i></a>

<br/>
	
	</div>
	
</div>

</div>';

menu_lateral($ruta);

print '</div</div>

</div>

<div  style="margin: auto; width: 50%;padding-left:10%;width:80%;margin-top:30px;">';

}

function poner_menu_geo($ruta=""){
	
	$ruta2="";
	$ruta3="";
	
	if($ruta=='../../'){
		$ruta2='';
		$ruta3='../';
		
	}
	else{
		$ruta2='geo/';
		
	}
	
	print '<div class="container" style="width:113%;margin-auto;padding-top:100px;">';

print '<nav>
    <ul>
            <li style="padding-top:20px;"><a href="'.$ruta3.'categories.php"><img class="icono" src="'.$ruta.'img/tag.png"/></a></li>
        <li style="padding-top:20px;"><a href="'.$ruta2.'index.php"><img class="icono" src="'.$ruta.'img/geo.png"/></a></li>

		<br clear="all" />
    </ul>

</nav>';
}

function poner_menu_conf(){
	
if(file_exists('../config.php')){
	include('../config.php');
}

if(file_exists('config.php')){
	include('config.php');
}	
	
	if(isset($_COOKIE['4images_userid'])){
	
		$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
		if($_COOKIE['4images_userid']>0){
			$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
		}
	}
	
	print '<div class="container" style="width:113%;margin-auto;padding-top:100px;">';

print '<nav>
    <ul>
        <li style="padding-top:20px;"><a href="cambiar_pass.php">
		'.ver_dato('cambiar_pass', $GLOBALS['idioma']).'</a></li>
			
        <li style="padding-top:20px;"><a href="cambiar_idioma.php">
		'.ver_dato('cambiar_idioma', $GLOBALS['idioma']).'</a></li>

		<br clear="all" />
    </ul>

</nav>';
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

function comprobar_cookie($ruta=""){
	
	$pass="";

	if(isset($_COOKIE['pass'])){
		
		$pass=saber_pass($_COOKIE['4images_userid']);

	}
	
	if(!isset($_COOKIE['4images_userid']) || !isset($_COOKIE['pass']) ||$_COOKIE['4images_userid']<=0 || $pass!=$_COOKIE['pass']){
		redireccionar($ruta.'index.php');
	}
}

function saber_pass($id){
	
	comprobar_config();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_password FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_COOKIE['4images_userid']."'");
	
	$fila = mysqli_fetch_row($consulta);
	
	return $fila[0];
}

function safe_htmlspecialchars($chars) {
  // Translate all non-unicode entities
  $chars = preg_replace(
    '/&(?!(#[0-9]+|[a-z]+);)/si',
    '&amp;',
    $chars
  );

  $chars = str_replace(">", "&gt;",   $chars);
  $chars = str_replace("<", "&lt;",   $chars);
  $chars = str_replace('"', "&quot;", $chars);
  return $chars;
}

function menu_mensajes(){
		if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
		}
	print '<nav>
    <ul>
        <li><a title="'.ver_dato('msg_write',$GLOBALS['idioma']).'" href="index.php"><img alt="'.ver_dato('msg_write',$GLOBALS['idioma']).'" class="icono" src="../img/write.png"/></a></li>
        <li style="padding-top:20px;"><a title="'.ver_dato('inbox',$GLOBALS['idioma']).'" href="inbox.php"><img title="'.ver_dato('inbox',$GLOBALS['idioma']).'" class="icono" src="../img/inbox1.png"/></a></li>
        <li style="padding-top:20px;"><a title="'.ver_dato('outbox',$GLOBALS['idioma']).'" href="outbox.php"><img title="'.ver_dato('outbox',$GLOBALS['idioma']).'" class="icono" src="../img/box.png"/></a></li>
		<br clear="all" />
    </ul>

</nav>';
}

function ver_tabla($sql,$icono){
if(file_exists('../config.php')){
	include('../config.php');
}
else{
	include('config.php');
}
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	print '<table style="border:none;margin:auto;" class="table">
		<tr ><td colspan="3"><img class="icono" src="img/'.$icono.'.png"/></td></tr>';

	$consulta = mysqli_query($GLOBALS['conexion'], $sql);
	
	while($fila = mysqli_fetch_row($consulta)){
		print '<tr><td><img style="width:6em;height:6em;" src="data/media/'.$fila[1].'/'.$fila[0].'"/></td><td>'.$fila[2].'</td><td>'.$fila[3].'</td></tr>';
	}
		
	print '</table>';
	
	mysqli_close($GLOBALS['conexion']);
}

function comprobar_config(){
	if(file_exists('../../config.php')){
	include('../../config.php');
	
}
	
	if(file_exists('../config.php')){
		include('../config.php');

	}
	
	if(file_exists('config.php')){
	include('config.php');
	
	}
}

function saber_idioma($id){
	
	comprobar_config();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT nacionalidad FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$id."'");
			
	$fila = mysqli_fetch_row($consulta);
	
	$idioma=$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	return $idioma;
}

function url_exists($url){
	
	$file_headers = @get_headers($url);
	
	if(strpos($file_headers[0],"200 OK")==false){
		$exists = false;
	}
	
	else{
		$exists = true;
	}
	
	return $exists;
}

function truncateFloat($number, $digitos){
    $raiz = 10;
	
    $multiplicador = pow ($raiz,$digitos);
	
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
	
    return number_format($resultado, $digitos);
}

function footer($ruta=""){
	print '
	</div>
		<script src="'.$ruta.'js/jquery.min.js"></script>
		<script src="'.$ruta.'js/bootstrap.min.js"></script>
		<script src="'.$ruta.'js/prettify.js"></script>
		<script src="'.$ruta.'js/jquery.scrollbar.js"></script>
		<script src="'.$ruta.'js/index.js"></script>
		<script src="'.$ruta.'js/modernizr.custom.js"></script>
		<script src="'.$ruta.'js/jquery.dlmenu.js"></script>
		<script src="'.$ruta.'js/bootstrap-select.js"></script>
		<script src="'.$ruta.'js/funciones_2.js"></script>
	</body>
</html>';
}

function obtener_lista_negra(){
	
	include('../config.php');
	
				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT Nombre FROM antispam');
		
		$lista_negra=array();
		
	while($fila = mysqli_fetch_row($consulta)){
		$lista_negra[]=$fila[0];
	}
		
	mysqli_close($GLOBALS['conexion']);	
	
	return $lista_negra;
}

function is_ani($filename) {
	
    if(!($fh = @fopen($filename, 'rb')))
        return false;
    $count = 0;

    while(!feof($fh) && $count < 2) {
        $chunk = fread($fh, 1024 * 100); //read 100kb at a time
        $count += preg_match_all('#\x00\x21\xF9\x04.{4}\x00(\x2C|\x21)#s', $chunk, $matches);
   }
    
    fclose($fh);
    return $count > 1;
}

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
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
			
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) as recuento FROM ' .
			$GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id='".$image_id."' AND user_id='" . $_COOKIE['4images_userid']."'" );
	
		$fila = mysqli_fetch_row($consulta);

		if($fila[0]!=0 ){
			$icono="fav_2.ico";
		}

		mysqli_close($GLOBALS['conexion']);
		
		if($_COOKIE['4images_userid']>0){
			$like='<div style="float:left;">

				<a id="frmajax" onclick="favorito('.$image_id.')"><img alt="fav" style="height:1.5em;width:1.5em;" src="img/'.$icono.'" id="Imagen '.$image_id.'"/></a>
		
			</div>';
		}
	}
	
	print '<td style="border-right:1px solid blue;border-top:0px;border-left:0px;border-bottom:0px;font-size:2em;"><a href="details.php?image_id='.$image_id.'"> <img id="'.$image_id.'" style="height:4em;width:4em;" alt="Imagen '.
	$image_id.'" src="data/media/'.$categoria.'/'.$imagen.'"/></a>'.$like.'
		
		<div style="float:right;">
				<a href="data/media/'.$categoria.'/'.$imagen.'" download>
					<img alt="download" style="padding-left:20px;height:2em;width:3em;" src="img/download.png"/>
				</a>
		</div>	
	</td>';
}

function ver_categoria($cat_id,$final_sentencia=""){

	if($cat_id=='*' && $final_sentencia==""){
		$final_sentencia='';
	}

	if($cat_id!='*' && $final_sentencia==""){
		
		$final_sentencia='WHERE cat_id='.$cat_id;
	}

	include('config.php');
	
	if ($conexion->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}
	
	else{

		$CantidadMostrar=9;
		$consulta='SELECT
				image_id,
				cat_id,
				image_name,
				image_media_file
				FROM
				'.$GLOBALS['table_prefix'].'images '.$final_sentencia;
		$compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
		$TotalReg       =$conexion->query($consulta);

		$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
		
		if(isset($_GET['pag'])){
			$_GET['pag']=(int) trim($_GET['pag']);	
		}
		
		else{
			$_GET['pag']=1;
		}
		
		if(is_int($_GET['pag']) && $_GET['pag']<=$TotalRegistro && $_GET['pag']>0){
	
			$consultavistas =$consulta."
								ORDER BY
								image_id DESC
								LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
		
			$consulta=$conexion->query($consultavistas);
	
			echo '<div style="margin-left:10px;" class="table-responsive-xs">
					<table style="border:none;" class="table">';
			
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
				print '<tr style="border:none;"><td style="border:none;font-size:2em;">'.$nombres[$y].'</td><td style="font-size:2em;border:none;">'.$nombres[$y+1].'</td><td style="font-size:2em;border:none;">'.$nombres[$y+2].'</td></tr>';
						
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
				
				echo '<li style="padding-left:45px;"class="btn"><a href="?cat_id='.$_GET['cat_id'].'&pag=1"><<</a></li>

				<li class="btn"><a href="?cat_id='.$_GET['cat_id'].'&pag='.$DecrementNum.'"><img style="width:3em;height:3em;" src="img/back.png"/></a></li>';

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
				
				echo '<li class="btn"><a href="?cat_id='.$_GET['cat_id'].'&pag='.$IncrimentNum.'"><img style="width:3em;height:3em;" src="img/next.png"/></a></li>';
				
				if($IncrimentNum<$TotalRegistro){
					echo '<li class="btn"><a href=?cat_id='.$_GET['cat_id'].'&pag'.$TotalRegistro.'">>></a></li></ul></div>';
				}
			}
		}
		print '</ul>';
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
			$adicional=substr($adicional,0,strripos($adicional,'/'));
		}
		
		return $_SERVER['SERVER_NAME'].$adicional;
	}
	else{
		return 'localhost';
	}
}

function restablecer_pass($ruta = ""){
	
		if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
		}
	if (isset($_POST['restablecer_pass']) && !empty($_POST['correo_restablecimiento'])

    && !empty($_POST['nombre_usuario'])) {

    $numero_restablecimiento = mt_rand(0, 16585);

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
mysqli_set_charset($GLOBALS['conexion'],"utf8");

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
>
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">

<button style="margin-left:40px;float:right;" type="button" class="close"
data-dismiss="modal">
<span >&times;</span>
</button>
</div>
<div class="modal-body">
          <form method="post" action="' . $_SERVER['PHP_SELF'] . '">

        <div class="form-group">
		<img alt="usuario para registrar" class="icono2" src="'.$ruta.'img/user.png" />
		<label style="font-size:2em;" for="nombre_usuario">' . ver_dato('user_name',
    $GLOBALS['idioma']) . '</label>
<input id="nombre_usuario" name="nombre_usuario" placeholder="' . ver_dato('user_name',
    $GLOBALS['idioma']) . '" type="text" class="form-control" id="recipient-name"/>
<br/>
<img alt="correo de restablecimiento" class="icono2" src="'.$ruta.'img/email.png"/>
<label style="font-size:2em;" for="correo_restablecimiento">' . ver_dato('email',
    $GLOBALS['idioma']) . '</label>
        <input id="correo_restablecimiento" name="correo_restablecimiento" placeholder="' .ver_dato('email', $GLOBALS['idioma']) . '"
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
	
}

function ver_dato($accion,$idioma){
	
	$dato="";
	
	comprobar_config();

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");

	$consulta=mysqli_query($GLOBALS['conexion'],'SELECT texto FROM '.$idioma." WHERE accion='".$accion."'");
    
	$fila = mysqli_fetch_row($consulta);
	
	$dato=$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	return $dato;
}

function menu_lateral($ruta = ""){
	
	if(!isset($_SESSION['track']) || $_SESSION['track']){
	
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$tx_pagina              = $_SERVER['REQUEST_URI']; 
		$tx_paginaOrigen        = $_SERVER['HTTP_REFERER'];
		$tx_paginaActual        =   $_SERVER['PHP_SELF']; 
		$i_direccionIp      = $_SERVER['REMOTE_ADDR'];   
		$tx_navegador       =   $_SERVER['HTTP_USER_AGENT']; 
		
		if(strlen($i_direccionIp)<12){
			$i_direccionIp='127.0.0.1';
		}
		
		mysqli_query ($GLOBALS['conexion'], "INSERT INTO 
		tbl_tracking (tx_pagina,tx_paginaOrigen,tx_ipRemota,tx_navegador,dt_fechaVisita) 
		VALUES('$tx_pagina','$tx_paginaOrigen','$i_direccionIp','$tx_navegador',now()) ;");
		
		mysqli_close($GLOBALS['conexion']);
	
	}
	
	if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
		}
		
	if($ruta=='todos'){
		$ruta='';
	}
	
print '

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left redondo " style="padding-left:70px;padding-right:20px;width:13em;overflow-x: hidden;" id="mySidebar"><br>
  <div  class="w3-container">
    <a  onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey fa fa-remove" title="close menu"> 

    </a>
   
  </div>
  <div style="margin-left:-50px;" class="w3-bar-block">';
  
    if(strpos("index.php",$_SERVER['PHP_SELF'])>=0){
		print '<a title="'.ver_dato('home', $GLOBALS['idioma']).'" href="'.$ruta.'index.php"><img alt="inicio" class="icono" src="'.$ruta.'img/home.png" ></a><hr/>';
	}
	
	if($_GET['l']=='yes' || $_COOKIE['4images_userid']=="-1" || !isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']=="-1"){
		
		print '<form method="post" action="'.$ruta.'login.php" >

       <img alt="nombre de usuario" class="icono" style="margin:auto;padding-left:8px;" src="'.$ruta.'img/user.png">
		<br/><br/>
		<label for="user_name"  style="font-size:2em;">'.ver_dato('user_name',$GLOBALS['idioma']).'</label>
		<input id="user_name" style="height:40px;font-size:2em;" type="text" name="user_name" class="logininput">
        
		<br/>
		<img alt="clave de acceso" class="icono" style="margin:auto;" src="'.$ruta.'img/user_pass.png"><br/><br/>
			<label for="user_password" style="font-size:2em;">'.ver_dato('password',$GLOBALS['idioma']).'</label>
        <input id="user_password" title="user password" style="font-size:2em;margin-right:10px;" type="password" size="10" name="user_password" class="logininput">
        <br/><br/>

   
		<input id="login" style="margin-top:10px;margin-left:-3px;" title="login" name="login" type="submit" value="'.ver_dato('login',$GLOBALS['idioma']).'" class="button">
      </form>
	  <hr/>
	  
	  <a title="'.ver_dato('register',$GLOBALS['idioma']).'" style="font-size:1em;" href="'.$ruta.'register.php"><img alt="registar" class="icono" src="'.$ruta.'img/registrar.png"></a>
	  <a  data-toggle="modal" data-target="#exampleModal">
	  <img alt="'.ver_dato('recordar',$GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/forgot_password.png"/>
	 </a>
	 ';
	}
	
	else{
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
		
			$consulta = mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_COOKIE['4images_userid']."'");
		$fila = mysqli_fetch_row($consulta);
		
		$consulta = mysqli_query($GLOBALS['conexion'],"SELECT COUNT(id) FROM mensajes WHERE destinatario='".$_COOKIE['4images_userid']."' AND leido=0");
		$recuento = mysqli_fetch_row($consulta);
		
		mysqli_close($GLOBALS['conexion']);

		if($recuento[0]>0){
			print '
			<a title="'.ver_dato('new_msg', $GLOBALS['idioma']).'" href="messages/inbox.php"><span style="font-size:2em;">'.$recuento[0].'</span></a>';
		}
		
		print '<a title="'.ver_dato('msg', $GLOBALS['idioma']).'" href="'.$ruta.'messages/index.php"><img alt="'.ver_dato('msg', $GLOBALS['idioma']).'" style="height:3.4em;width:3.4em;" src="'.$ruta.'img/email.png"></a>
	   <img alt="'.ver_dato('user_name', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/user.png"/><br/><br/><span class="redondo" style="margin-left:-10px;font-size:1.5em;">'.$fila[0].'</span>
       <a title="'.ver_dato('img_fav', $GLOBALS['idioma']).'" href="'.$ruta.'favoritos.php"><br/><br/><img alt="'.ver_dato('img_fav', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/fav.png"></a><br>
	   <br><a title="'.ver_dato('config', $GLOBALS['idioma']).'" href="'.$ruta.'member.php"><img alt="'.ver_dato('config', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/settings.png"></a><br/>
       <br>
	   <a title="'.ver_dato('img_upload', $GLOBALS['idioma']).'" href="'.$ruta.'upload_images/index.php"><img alt="'.ver_dato('img_upload', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/upload.png"></a><br/>
       <br>
	   
	   <a title="'.ver_dato('logout', $GLOBALS['idioma']).'" href="'.$ruta.'logout.php" ><img alt="'.ver_dato('logout', $GLOBALS['idioma']).'" style="padding-bottom:10px;" class="icono" src="'.$ruta.'img/logout.png"></a>
	   ';

	}
	
print '<hr/>';

$imagen_aleatoria=imagen_aleatoria();

$image_thumb=substr($imagen_aleatoria,strpos($imagen_aleatoria,"-")+1,strpos($imagen_aleatoria,"*"));
$image_thumb=substr($image_thumb,0,strpos($image_thumb,"*"));

if($imagen_aleatoria!="vacio" && file_exists($ruta.'data/media/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb)){
	
	print '
	<img alt="aleatorio" style="margin-left:10px;height:5em;width:5em;" src="'.$ruta.'img/aleatorio.png"/>
	<br/><br/>';

	$image_id=substr($imagen_aleatoria,strpos($imagen_aleatoria,"*")+1,strpos($imagen_aleatoria,"#"));
	$image_id=substr($image_id,0,strpos($image_id,"#"));

	print '
	<a title="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" href="'.$ruta.'details.php?image_id='.$image_id.'">
	<img style="height:7.5em;width:7.5em;"  src="'.$ruta.'data/media/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb.'" alt="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" /></a>
	<br/><br/>
	<hr/>';
}

$redes_sociales='';

  if(gettype($GLOBALS['facebook'])=='string' && $GLOBALS['facebook']!=""){
	$redes_sociales.='<a title="facebook" target="_blank" href="https://www.facebook.com/'.$GLOBALS['facebook'].'"><img alt="Facebook" class="social" src="'.$ruta.'img/Social/facebook.png"/></a>';  
  }
  
  if(gettype($GLOBALS['instagram'])=='string' && $GLOBALS['instagram']!=""){
	$redes_sociales.=' <a title="instagram" target="_blank" href="https://www.instagram.com/'.$GLOBALS['instagram'].'/"><img alt="Instagram" class="social" src="'.$ruta.'img/Social/instagram.png"/></a>';  
  }
  
    if(gettype($GLOBALS['twitter'])=='string' && $GLOBALS['twitter']!=""){
	$redes_sociales.='<a title="twitter" target="_blank" href="https://twitter.com/'.$GLOBALS['twitter'].'"><img alt="Twitter" class="social" src="'.$ruta.'img/Social/twitter.png"/></a>';  
  }
  
    if(gettype($GLOBALS['youtube'])=='string' && $GLOBALS['youtube']!=""){
	$redes_sociales.='<a title="youtube" target="_blank" href="https://www.youtube.com/user/'.$GLOBALS['youtube'].'"><img alt="Youtube" class="social" src="'.$ruta.'img/Social/youtube.png"/></a>';   
  }
  
    if(gettype($GLOBALS['debianart'])=='string' && $GLOBALS['debianart']!=""){
	$redes_sociales.='<br/><a title="debianart" target="_blank" href="https://www.deviantart.com/'.$GLOBALS['debianart'].'/gallery/?catpath=scraps"><img alt="Debianart" class="social" src="'.$ruta.'img/Social/debianart.png"/></a>';   
  }
  
    if(gettype($GLOBALS['slideshare'])=='string' && $GLOBALS['slideshare']!=""){
		
		if(empty($GLOBALS['deviantart'])){
			$redes_sociales.='<br/>';
		}
		
	$redes_sociales.='<a title="slideshare" target="_blank" href="https://es.slideshare.net/'.$GLOBALS['slideshare'].'"><img class="social" alt="Slideshare" src="'.$ruta.'img/Social/slideshare.png"/></a>';  
   }
   
    if(gettype($GLOBALS['github'])=='string' && $GLOBALS['github']!=""){
		
		if(empty($GLOBALS['debianart']) && empty($GLOBALS['instagram'])){
			$redes_sociales.='<br/>';
		}
		
	$redes_sociales.='<a title="debianart" target="_blank" href="https://github.com/'.$GLOBALS['github'].'"><img class="social" alt="Github" src="'.$ruta.'img/Social/github.png"/></a>';    
  }
      

     if(!empty($redes_sociales)){
		print '<div style="-moz-transform: scale(1.2,1.2);zoom:150%;" class="w3-panel w3-large">';
		print $redes_sociales.'</div>
		<hr/>';
	 }        	     

if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>=0 ){
	
	$vars = get_defined_vars();  

	$administrators=array();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    
	$GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM '.$GLOBALS['table_prefix'].'users WHERE user_level=9');
	 
	while ($administradores = mysqli_fetch_array($consulta)){
		$administrators[]=$administradores[0];
	}
	
	mysqli_close($GLOBALS['conexion']);
	 
	if(in_array($_COOKIE['4images_userid'], $administrators)){
		print '<a title="'.ver_dato('adm', $GLOBALS['idioma']).'" href="'.$ruta.'admin/index.php"><img alt="'.ver_dato('adm', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/admin.png"  ></a><br/>';
	}
		
}

print '
 <br/> <a title="rss" href="'.$ruta.'rss.php"><img class="icono" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" /></a>
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

function poner_menu($ruta = ""){

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	if(file_exists($ruta.'config.php')){
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(cat_id) FROM '.$GLOBALS['table_prefix'].'categories');
		$recuento = mysqli_fetch_row($consulta);
	
		if($recuento[0]>0){
			print '<aside style="float:right;margin-left:37%;margin-top:-45px;position:fixed;z-index:1;">
			<div>
				<div>
					<div style="width:10em;float:right;background-color: rgba(255, 255, 255, 0);" id="dl-menu" class="dl-menuwrapper">
					<br/>	<button class="dl-trigger">a</button>
						<ul style="margin-top:-15px;font-size:3em;background-color: rgba(255, 255, 255, 0);" class="dl-menu">
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
				<li  style="background-color: rgba(255, 255, 255, 0);" class="menu_categorias">
				<a style="color:#ffffff;background-color:green;font-size:0.7em;font-weight:bold;" href="#">'.$fila[0].'</a>';
			
				$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id='.$id_categorias[$x]);
			
				$y=1;

				while ($subcategorias = mysqli_fetch_array($consulta)){
					if($y==1){
						print '<ul style="margin-top:10px;background-color: rgba(255, 255, 255, 0);" class="dl-submenu">';
						print '<li style="margin:auto;text-align:center;first-child:margin-top:15px;background-color: rgba(255, 255, 255, 0);">
						<a style="margin-left:-20px;margin-top:20px;font-size:0.7em;font-weight:bold;" href="'.$ruta.'categories.php?cat_id='.$subcategorias[1].'">'.$subcategorias[0].'</a>
						
						</li>';
					}
				
					else{
						print '<li style="margin:auto;text-align:center;padding-top:20px;background-color: rgba(255, 255, 255, 0);">
						<a style="font-size:0.7;font-weight:bold;" href="#">'.$subcategorias[0].'</a>
						</li>';
					}
				
					$y++;		
				}
				
				print '</ul></li>';	
			}

			$consulta = mysqli_query($GLOBALS['conexion'], 
			'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id=0 AND cat_id NOT IN (SELECT DISTINCT cat_parent_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id!=0)');

			while ($fila = mysqli_fetch_row($consulta)){

				print '
				<li style="margin:auto;text-align:center;padding-top:10px;background-color: rgba(255, 255, 255, 0);" class="menu_categorias menu">
				<a style="color:#ffffff;background-color:blue;font-size:0.7em;font-weight:bold;" href="'.$ruta.'categories.php?cat_id='.$fila[1].'">'.$fila[0].'</a></li>';
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
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
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
	
	mysqli_close($GLOBALS['conexion']);
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