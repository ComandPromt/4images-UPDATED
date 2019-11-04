<?php
 
date_default_timezone_set('Europe/Madrid');

function categoria_link(){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $cat_consulta = mysqli_query($GLOBALS['conexion'],
	'SELECT cat_id FROM '.$GLOBALS['table_prefix']."categories WHERE cat_name='Links'");
		 
    $cat = mysqli_fetch_row($cat_consulta);
	
	$cat=(int)$cat[0];

	if($cat>0){
		
		print '	<a title="Links" href="details.php?image_id=1326">
					
			<img style="margin-top:20px;" alt="Enlaces" class="icono" src="img/url.png"/>
		</a>
			<a title="Youtube Links" href="details.php?image_id=29210">
					
			<img style="margin-top:20px;" alt="Enlaces" class="icono" src="img/Social/youtube.png"/>
		</a>
		';
	}
		
}

function registrar(){
	
	print '
	<div style="padding-bottom:40px;margin-left:-60px;margin-top:-20px;" class="flotar_izquierda">
	<a href="register.php">
	
			<img alt="registrar" style="height:100px;width:150px;" src="img/reg-now.gif"/>
		</a></div>';
}

function num_categorias(){
	
	$categorias=array();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $cat_consulta = mysqli_query($GLOBALS['conexion'],
	'SELECT cat_id FROM '.$GLOBALS['table_prefix'].'categories');
		 
    while( $cat = mysqli_fetch_row($cat_consulta)){
		$categorias[]=$cat[0];
	}
	  
	mysqli_close($GLOBALS['conexion']);
	
	return $categorias;
}

function ver_categorias($categoria){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $cat_consulta = mysqli_query($GLOBALS['conexion'],
	'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id>0 UNION 

	SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id=0 AND
	cat_id NOT IN (SELECT DISTINCT cat_parent_id FROM '.$GLOBALS['table_prefix'].'categories WHERE 
	cat_parent_id!=0) order by cat_name');
		 
    while( $cat = mysqli_fetch_row($cat_consulta)){
		
		if($categoria!=$cat[1]){
			print '<option value="'.$cat[1].'">'.$cat[0].'</option>';
		}
	}
	  
	mysqli_close($GLOBALS['conexion']);
}

function saber_categoria($cat){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT cat_name FROM '.$GLOBALS['table_prefix']."categories
				WHERE cat_id='".$cat."'");
			
	$categoria = mysqli_fetch_row($consulta);
	
	mysqli_close($GLOBALS['conexion']);	
	
	return $categoria[0];
	
}

function nevar(){
	
	if(!is_private_ip($i_direccionIp)){
		
	$geo = json_decode(file_get_contents('http://extreme-ip-lookup.com/json/'.$_SERVER['REMOTE_ADDR']));
	$geo->lat=(int)$geo->lat;
			
	if($geo->lat>0){
		
			print '		<script>
		
var f = new Date();

if(f.getDate()>=23 && f.getMonth()==8 || f.getDate()>=1 && f.getMonth()<11 && f.getMonth()>=9||
		f.getDate()<=21 && f.getMonth()==11 ){
			var fallObjects=new Array();function newObject(url,height,width){fallObjects[fallObjects.length]=new Array(url,height,width);}
			
			var numObjs=40, waft=50, fallSpeed=10, wind=0;
			newObject("img/oto.png",22,22);
			newObject("img/oto.png",22,22);
			
			function winSize(){winWidth=(moz)?window.innerWidth-180:document.body.clientWidth-180;winHeight=(moz)?window.innerHeight+500:document.body.clientHeight+500;}
			function winOfy(){winOffset=(moz)?window.pageYOffset:document.body.scrollTop;}
			function fallObject(num,vari,nu){
			objects[num]=new Array(parseInt(Math.random()*(winWidth-waft)),-30,(parseInt(Math.random()*waft))*((Math.random()>0.5)?1:-1),0.02+Math.random()/20,0,1+parseInt(Math.random()*fallSpeed),vari,fallObjects[vari][1],fallObjects[vari][2]);
			if(nu==1){document.write(\'<img id="fO\'+i+\'" class="fijo" src="\'+fallObjects[vari][0]+\'">\'); }
			}
			function fall(){
			for(i=0;i<numObjs;i++){
			var fallingObject=document.getElementById(\'fO\'+i);
			if((objects[i][1]>(winHeight-(objects[i][5]+objects[i][7])))||(objects[i][0]>(winWidth-(objects[i][2]+objects[i][8])))){fallObject(i,objects[i][6],0);}
			objects[i][0]+=wind;objects[i][1]+=objects[i][5];objects[i][4]+=objects[i][3];
			with(fallingObject.style){ top=objects[i][1]+winOffset+\'px\';left=objects[i][0]+(objects[i][2]*Math.cos(objects[i][4]))+\'px\';}
			}
			setTimeout("fall()",31);
			}
			var objects=new Array(),winOffset=0,winHeight,winWidth,togvis,moz=(document.getElementById&&!document.all)?1:0;winSize();
			for (i=0;i<numObjs;i++){fallObject(i,parseInt(Math.random()*fallObjects.length),1);}
			fall();
}

else{
	
if(f.getDate()>=20 && f.getMonth()==11 || f.getDate()>=1 && f.getMonth()<2 || f.getDate()<=20 && f.getMonth()==2){
	var fallObjects=new Array();function newObject(url,height,width){fallObjects[fallObjects.length]=new Array(url,height,width);}
			
			var numObjs=40, waft=50, fallSpeed=10, wind=0;
			newObject("img/nieve2_jessi_diyva.png",22,22);
			newObject("img/nieve1_jessi_diyva.png",22,22);
			
			function winSize(){winWidth=(moz)?window.innerWidth-180:document.body.clientWidth-180;winHeight=(moz)?window.innerHeight+500:document.body.clientHeight+500;}
			function winOfy(){winOffset=(moz)?window.pageYOffset:document.body.scrollTop;}
			function fallObject(num,vari,nu){
			objects[num]=new Array(parseInt(Math.random()*(winWidth-waft)),-30,(parseInt(Math.random()*waft))*((Math.random()>0.5)?1:-1),0.02+Math.random()/20,0,1+parseInt(Math.random()*fallSpeed),vari,fallObjects[vari][1],fallObjects[vari][2]);
			if(nu==1){document.write(\'<img id="fO\'+i+\'" class="fijo" src="\'+fallObjects[vari][0]+\'">\'); }
			}
			function fall(){
			for(i=0;i<numObjs;i++){
			var fallingObject=document.getElementById(\'fO\'+i);
			if((objects[i][1]>(winHeight-(objects[i][5]+objects[i][7])))||(objects[i][0]>(winWidth-(objects[i][2]+objects[i][8])))){fallObject(i,objects[i][6],0);}
			objects[i][0]+=wind;objects[i][1]+=objects[i][5];objects[i][4]+=objects[i][3];
			with(fallingObject.style){ top=objects[i][1]+winOffset+\'px\';left=objects[i][0]+(objects[i][2]*Math.cos(objects[i][4]))+\'px\';}
			}
			setTimeout("fall()",31);
			}
			var objects=new Array(),winOffset=0,winHeight,winWidth,togvis,moz=(document.getElementById&&!document.all)?1:0;winSize();
			for (i=0;i<numObjs;i++){fallObject(i,parseInt(Math.random()*fallObjects.length),1);}
			fall();
}
}
	
			</script>';
	}
	
	else{
		
		print '<script>var f = new Date();


if(f.getDate()>=21 && f.getMonth()==2 || f.getDate()>=1 && f.getMonth()==3||
f.getDate()>=1 && f.getMonth()==4 ||
		f.getDate()<=20 && f.getMonth()==5 ){
				var fallObjects=new Array();function newObject(url,height,width){fallObjects[fallObjects.length]=new Array(url,height,width);}
			
			var numObjs=40, waft=50, fallSpeed=10, wind=0;
			newObject("img/oto.png",22,22);
			newObject("img/oto.png",22,22);
			
			function winSize(){winWidth=(moz)?window.innerWidth-180:document.body.clientWidth-180;winHeight=(moz)?window.innerHeight+500:document.body.clientHeight+500;}
			function winOfy(){winOffset=(moz)?window.pageYOffset:document.body.scrollTop;}
			function fallObject(num,vari,nu){
			objects[num]=new Array(parseInt(Math.random()*(winWidth-waft)),-30,(parseInt(Math.random()*waft))*((Math.random()>0.5)?1:-1),0.02+Math.random()/20,0,1+parseInt(Math.random()*fallSpeed),vari,fallObjects[vari][1],fallObjects[vari][2]);
			if(nu==1){document.write(\'<img id="fO\'+i+\'" class="fijo" src="\'+fallObjects[vari][0]+\'">\'); }
			}
			function fall(){
			for(i=0;i<numObjs;i++){
			var fallingObject=document.getElementById(\'fO\'+i);
			if((objects[i][1]>(winHeight-(objects[i][5]+objects[i][7])))||(objects[i][0]>(winWidth-(objects[i][2]+objects[i][8])))){fallObject(i,objects[i][6],0);}
			objects[i][0]+=wind;objects[i][1]+=objects[i][5];objects[i][4]+=objects[i][3];
			with(fallingObject.style){ top=objects[i][1]+winOffset+\'px\';left=objects[i][0]+(objects[i][2]*Math.cos(objects[i][4]))+\'px\';}
			}
			setTimeout("fall()",31);
			}
			var objects=new Array(),winOffset=0,winHeight,winWidth,togvis,moz=(document.getElementById&&!document.all)?1:0;winSize();
			for (i=0;i<numObjs;i++){fallObject(i,parseInt(Math.random()*fallObjects.length),1);}
			fall();
		}
		
		else{
			if(f.getDate()>=21 && f.getMonth()==5 || f.getDate()>=1 && f.getMonth()==6 || f.getDate()>=1 && f.getMonth()==7 ||
			f.getDate()<=21 && f.getMonth()==8){
			var fallObjects=new Array();function newObject(url,height,width){fallObjects[fallObjects.length]=new Array(url,height,width);}
			
			var numObjs=40, waft=50, fallSpeed=10, wind=0;
			newObject("img/nieve2_jessi_diyva.png",22,22);
			newObject("img/nieve1_jessi_diyva.png",22,22);
			
			function winSize(){winWidth=(moz)?window.innerWidth-180:document.body.clientWidth-180;winHeight=(moz)?window.innerHeight+500:document.body.clientHeight+500;}
			function winOfy(){winOffset=(moz)?window.pageYOffset:document.body.scrollTop;}
			function fallObject(num,vari,nu){
			objects[num]=new Array(parseInt(Math.random()*(winWidth-waft)),-30,(parseInt(Math.random()*waft))*((Math.random()>0.5)?1:-1),0.02+Math.random()/20,0,1+parseInt(Math.random()*fallSpeed),vari,fallObjects[vari][1],fallObjects[vari][2]);
			if(nu==1){document.write(\'<img id="fO\'+i+\'" class="fijo" src="\'+fallObjects[vari][0]+\'">\'); }
			}
			function fall(){
			for(i=0;i<numObjs;i++){
			var fallingObject=document.getElementById(\'fO\'+i);
			if((objects[i][1]>(winHeight-(objects[i][5]+objects[i][7])))||(objects[i][0]>(winWidth-(objects[i][2]+objects[i][8])))){fallObject(i,objects[i][6],0);}
			objects[i][0]+=wind;objects[i][1]+=objects[i][5];objects[i][4]+=objects[i][3];
			with(fallingObject.style){ top=objects[i][1]+winOffset+\'px\';left=objects[i][0]+(objects[i][2]*Math.cos(objects[i][4]))+\'px\';}
			}
			setTimeout("fall()",31);
			}
			var objects=new Array(),winOffset=0,winHeight,winWidth,togvis,moz=(document.getElementById&&!document.all)?1:0;winSize();
			for (i=0;i<numObjs;i++){fallObject(i,parseInt(Math.random()*fallObjects.length),1);}
			fall();	
			}
		}
		
			</script>';
		
		
	}
	}
}

function admin($id){
	
	$admin=false;
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT user_level FROM '.$GLOBALS['table_prefix']."users
				WHERE user_id='".$_COOKIE['4images_userid']."'");
			
	$user_id = mysqli_fetch_row($consulta);
	
	mysqli_close($GLOBALS['conexion']);	
	
	if((int)$user_id[0]==9){
		$admin=true;
	}
	
	return $admin;
}

function subida_por_mi($id){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT image_id FROM '.$GLOBALS['table_prefix']."images
				WHERE image_id='".$id."' AND user_id='".$_COOKIE['4images_userid']."'");
			
	$imagen = mysqli_fetch_row($consulta);
	
	mysqli_close($GLOBALS['conexion']);	
	
	return (int)$imagen[0];
}

function visible($imagen){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT image_active FROM '.$GLOBALS['table_prefix']."images
				WHERE image_id='".$imagen."'");
			
	$visible = mysqli_fetch_row($consulta);
	
	mysqli_close($GLOBALS['conexion']);	
	
	return (int)$visible[0];
}

function zona_privada($ruta=""){
	
	if(isset($_COOKIE['4images_userid'])){
		
		$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
		
		$salir=false;
		
		if($_COOKIE['4images_userid']<=0){
			$salir=true;
		}
		
		else{
			
			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'],
	'SELECT user_level FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_COOKIE['4images_userid']."'");
		
	$fila = mysqli_fetch_row($consulta);
	
	$dato=(int)$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	if($dato!=9){
		$salir=true;
	}
	
		}
	}
	
if($salir){
	redireccionar($ruta.'index.php');
}

}

function saber_orden(){
	
	comprobar_config();
	
	$dato=0;

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'],
	'SELECT MAX(orden)+1 FROM '.$GLOBALS['table_prefix']."lightboxes WHERE user_id='".$_COOKIE['4images_userid']."'");
		
	$fila = mysqli_fetch_row($consulta);
	
	$dato=(int)$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	return $dato;
}

function ver_os($os,$final=""){
	
	$dato=0;
	
	comprobar_config();

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
	$sql="SELECT count(id_tracking) FROM tbl_tracking WHERE tx_navegador like '%".$os."%'";
	
	if($final!=""){
		$sql.=" AND tx_navegador NOT LIKE '%".$final."%'";
	}
	
	$consulta=mysqli_query($GLOBALS['conexion'],$sql);
    
	$fila = mysqli_fetch_row($consulta);
	
	$dato=$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	return $dato;
}

function ver_hits($pais){
	
	$dato=0;
	
	comprobar_config();

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");

	$consulta=mysqli_query($GLOBALS['conexion'],"SELECT count(id_tracking) FROM tbl_tracking where pais='".$pais."'");
    
	$fila = mysqli_fetch_row($consulta);
	
	$dato=$fila[0];
	
	mysqli_close($GLOBALS['conexion']);
	
	return $dato;
}

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
	<meta name="robots" content="index, nofollow">
	<script src="'.$ruta.'js/funciones.js"></script>
	<link rel="stylesheet" href="'.$ruta.'css/dashboard.css"/>
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
	<link rel="icon" type="image/ico" href="'.$ruta.'img/favicon.ico">

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
	var txt = " '.$GLOBALS['site_name']. ' ";
	var espera=600;
	var refresco=null;
			function rotulo_title() {
				document.title=txt;
				txt=txt.substring(1,txt.length)+txt.charAt(0);
				refresco=setTimeout("rotulo_title()",espera);
			}
			
			rotulo_title();
	
	</script>';
	
	if(!logueado()){
		
		print '<script>	
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
			
		</script>';
	}
	
	print '<link rel="alternate" type="application/rss+xml" title="RSS Feed: '.$GLOBALS['site_name'].'" href="'.$ruta.'rss.php">

	</head>
	
<body>

'.nevar().'

<div id="navega"> 

	<div id="menu"> 

		<div id="fijo">

			<a  id="menu_usuario" onclick="w3_open();">
				<i class="flotar_izquierda fa fa-bars"></i>
			</a>

		</div>

	</div>

</div>';

menu_lateral($ruta);

print '</div></div>

</div>

<div id="div_arriba_principio">';

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
	
	print '<div class="container" id="contenedor">';

print '<nav>

    <ul>
		<li class="espacio_arriba_3">
			<a href="'.$ruta3.'categories.php">
				<img class="icono" src="'.$ruta.'img/tag.png"/>
			</a>
		</li>

		<li class="espacio_arriba_3">
			<a href="'.$ruta2.'index.php">
				<img class="icono" src="'.$ruta.'img/geo.png"/>
			</a>
		</li>

		<li class="espacio_arriba_3">
			<a href="'.$ruta2.'estadisticas.php">
				<img class="icono" src="'.$ruta.'img/statics.png"/>
			</a>
		</li>

		<li class="espacio_arriba_3">
			<a href="'.$ruta3.'imagenes_repetidas.php">
				<img class="icono" src="'.$ruta.'img/repeat.gif"/>
			</a>
		</li>

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
	
	print '<div class="container" id="menu_conf">';

	print '<nav>

    	<ul>
			<li class="espacio_arriba_3">
				<a href="cambiar_pass.php">
				'.ver_dato('cambiar_pass', $GLOBALS['idioma']).'</a>
			</li>

			<li class="espacio_arriba_3">
				<a href="cambiar_idioma.php">
				'.ver_dato('cambiar_idioma', $GLOBALS['idioma']).'</a>
			</li>

			<li class="espacio_arriba_3">
				<a href="cambiar_avatar.php">
				'.ver_dato('cambiar_avatar', $GLOBALS['idioma']).'</a>
			</li>

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

function logueado($ruta=""){
	
$respuesta=false;

	if(isset($_COOKIE['pass']) && isset($_COOKIE['4images_userid']) && (int)$_COOKIE['4images_userid']>0 && !empty($_COOKIE['pass'])){
		
		$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
			
		$consulta = $mysqli->query( 'SELECT user_password FROM ' .
		$GLOBALS['table_prefix'] . "users WHERE user_id='".$_COOKIE['4images_userid']."'");
	
		$resultado = $consulta->fetch_row();
		
		if($resultado[0]==$_COOKIE['pass']){
			$respuesta=true;
		}
		
		$mysqli->close();
	}

	return $respuesta;
	
}

function comprobar_cookie($ruta=""){
	
	$pass="";

	if(isset($_COOKIE['pass']) && isset($_COOKIE['4images_userid']) && (int)$_COOKIE['4images_userid']>0 && !empty($_COOKIE['pass'])){
				
			$pass=saber_pass($_COOKIE['4images_userid']);
	}
	
	else{
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
	
		<li>
			<a title="'.ver_dato('msg_write',$GLOBALS['idioma']).'" href="index.php">
				<img alt="'.ver_dato('msg_write',$GLOBALS['idioma']).'" class="icono" src="../img/write.png"/>
			</a>
		</li>

		<li class="espacio_arriba_3">
			<a title="'.ver_dato('inbox',$GLOBALS['idioma']).'" href="inbox.php">
				<img title="'.ver_dato('inbox',$GLOBALS['idioma']).'" class="icono" src="../img/inbox1.png"/>
			</a>
		</li>
		
		<li class="espacio_arriba_3">
			<a title="'.ver_dato('outbox',$GLOBALS['idioma']).'" href="outbox.php">
				<img title="'.ver_dato('outbox',$GLOBALS['idioma']).'" class="icono" src="../img/box.png"/>
			</a>
		</li>
		
		<li class="espacio_arriba_3">
			<a data-toggle="modal" data-target="#clear" title="'.ver_dato('outbox',$GLOBALS['idioma']).'" href="outbox.php">
				<img title="'.ver_dato('outbox',$GLOBALS['idioma']).'" class="icono" src="../img/Recycle_Bin_Full_2.png"/>
			</a>
		</li>

		<br clear="all" />

    </ul>

</nav>

<div class="modal fade transparente" id="clear" tabindex="-1" role="dialog" aria-labelledby="clearLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered transparente" role="document">
<div class="modal-content ">
<div class="modal-header">

<h2 class="modal-title id_modal_mensaje" id="clearLabel">'.ver_dato('reset', $GLOBALS['idioma']).'</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body" >
          <form id="limpiar_mensajes">
		      <p><a href="clear.php?delete=1"><span>'.ver_dato('clear_inbox', $GLOBALS['idioma']).'</span></a></p>
			  <p><a href="clear.php?delete=2"><span>'.ver_dato('clear_outbox', $GLOBALS['idioma']).'</span></a></p>
        </form>

</div>


</div>
</div>
</div>
';

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
	
	print '<div id="ver_tabla" class="table-responsive-xs">
	
		<table class="table" id="ver_tabla_tabla">
		
		<tr>
			<td colspan="3">
				<img class="icono" src="img/'.$icono.'.png"/>
			</td>
		</tr>';

	$consulta = mysqli_query($GLOBALS['conexion'], $sql);
	
	while($fila = mysqli_fetch_row($consulta)){

		print '<tr>
				<td>
					<a href="details.php?image_id='.$fila[4].'">

					<img class="imagen_figura" src="data/media/'.$fila[1].'/'.$fila[0].'"/></a>
				</td>
				<td>'.$fila[2].'</td>
				<td>'.$fila[3].'</td>
			</tr>';
	}
		
	print '</table></div>';
	
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
	<script src="'.$ruta.'js/popper.min.js"></script>
		<script src="'.$ruta.'js/jquery.min.js"></script>
		<script src="'.$ruta.'js/bootstrap.min.js"></script>
		<script src="'.$ruta.'js/prettify.js"></script>
		<script src="'.$ruta.'js/jquery.scrollbar.js"></script>
		<script src="'.$ruta.'js/index.js"></script>
		<script src="'.$ruta.'js/modernizr.custom.js"></script>
		<script src="'.$ruta.'js/jquery.dlmenu.js"></script>
		<script src="'.$ruta.'js/bootstrap-select.js"></script>
		<script src="'.$ruta.'js/funciones_2.js"></script>
		<script src="'.$ruta.'js/modificarEstiloInputFile.js"></script>
	</body>
</html>';
}

function obtener_lista_negra($sql="SELECT Nombre FROM antispam"){
	
	comprobar_config();
	
				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
	$consulta = mysqli_query($GLOBALS['conexion'], $sql);
		
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

function vercampo($nombre,$categoria,$imagen,$image_id,$mis_cargas=false,$ruta="",$colspan=false){
	
	$icono="fav.ico";
	
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
		
		
	}
	
	$relleno="";
	
	if($colspan){
		$relleno='colspan=3';
	}
	
	print '<td '.$relleno.' id="relleno">

			<a href="'.$ruta.'details.php?image_id='.$image_id.'"> 
				<img class="img-fluid" alt="Imagen '.$image_id.'" src="'.$ruta.'data/media/'.$categoria.'/'.$imagen.'"/>
			</a>'.$like.'
		
		<div class="flotar_derecha clear">';
		
			if($_COOKIE['4images_userid']>0){
			print '

				<a id="frmajax_img_'.$image_id.'" onclick="favorito('.$image_id.')">
					<img alt="fav" style="height:1em;width:1em;" src="'.$ruta.'img/'.$icono.'" id="'.$image_id.'"/>
				</a>
		<a href="'.$ruta.'data/media/'.$categoria.'/'.$imagen.'" download>
					<img alt="download" style="padding-left:20px;height:1em;width:2em;" src="'.$ruta.'img/download.png"/>
				</a>
			';
		}
				
				if($mis_cargas || admin($_COOKIE['4images_userid'])){
					
					if($mis_cargas){
						$final_sentencia="AND user_id='".$_COOKIE['4images_userid']."'";
					}
					
				$icono2='hide.png';
				
					$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
			
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_active,cat_id,image_media_file FROM ' .
		$GLOBALS['table_prefix'] . "images WHERE image_id='".$image_id."' ".$final_sentencia );
	
		$fila = mysqli_fetch_row($consulta);
	
		if((int)$fila[0]==1){
			$icono2="view.png";
		}
	
		$cat_id=$fila[1];
		
		$file=$fila[2];

		mysqli_close($GLOBALS['conexion']);
		
		print "<a id=\"frm_img_del_".$image_id.'" href="'.$ruta.'delete.php?image_id='.$image_id."&cat_id=".$cat_id."&file=".$file."&pag=".$_GET['pag']."\">
					<img alt=\"delete image ".$image_id.'" id="IMG_delete_'.$image_id.'" style="height:1em;width:1em;" src="'.$ruta.'img/delete.ico"/>
				</a>';
					
		print '<a id="frm_img_'.$image_id.'" onclick="ocultar_img('.$image_id.')">
					<img alt="IMG_'.$image_id.'" id="IMG_'.$image_id.'" style="height:1em;width:1em;" src="'.$ruta.'img/'.$icono2.'"/>
				</a>';
				
				}
				
		print '	
	
		</div>	
	</td>';
	
}

function ver_categoria($cat_id,$final_sentencia="WHERE image_active=1 ",$favorito=false,
$mis_cargas=false,$filtro=false,$ruta="",$orden=" ORDER BY image_id DESC LIMIT ",$comentario=false){

	if($cat_id=='*' && $final_sentencia=="" && $ruta==""){
		$final_sentencia='WHERE image_active=1 ';
	}

	if($cat_id!='*' && $final_sentencia==""){
		
		$final_sentencia='WHERE image_active=1 AND cat_id='.$cat_id;
	}
	
	if($mis_cargas){
	
		$final_sentencia="WHERE user_id='".$_COOKIE['4images_userid']."'";
	}

	if($filtro){
	
		$final_sentencia="WHERE image_active=1 AND image_id='".$_GET['image_id']."'";
	}

	if($comentario){
	
		$final_sentencia='JOIN '.$GLOBALS['table_prefix']."comments C ON C.image_id=I.image_id
		where image_active='1' ";
	}

	include($ruta.'config.php');
	
	if ($conexion->connect_errno) {
		echo 'Fallo al conectar a MySQL: (' . $conexion->connect_errno . ') ' . $conexion->connect_error;
	}
	
	else{

		$CantidadMostrar=9;
		$consulta='SELECT
				distinct(I.image_id),
				I.cat_id,
				I.image_name,
				I.image_media_file
				FROM
				'.$GLOBALS['table_prefix'].'images I '.$final_sentencia;

		if($favorito){
			
			$consulta='SELECT I.image_id, I.cat_id, I.image_name, I.image_media_file,F.orden 
		
			FROM '.$GLOBALS['table_prefix'].'images I JOIN '.$GLOBALS['table_prefix'].'lightboxes F ON I.image_id=F.lightbox_image_id
		
			WHERE image_id IN ( SELECT lightbox_image_id FROM '.$GLOBALS['table_prefix']."lightboxes  WHERE user_id='".$_COOKIE['4images_userid']."' order by orden desc)";
			$orden=' ORDER BY F.orden DESC LIMIT ';
		}
				
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
	
			$consultavistas =$consulta.$orden.(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;

			$consulta=$conexion->query($consultavistas);
	
			echo '<div style="padding-top:40px;" class="table-responsive-xs" >
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
			
			$y=-1;
			
			$recuento=count($nombres);

			if($recuento>1){

				for($x=0;$x<$recuento-1;$x++){
					
					print '<tr style="border:none;">
							<td style="border:none;font-size:1.8em;font-weight:bold;">'.$nombres[++$y].'</td>
							<td style="font-size:1.8em;border:none;font-weight:bold;">'.$nombres[++$y].'</td>
							<td style="font-size:1.8em;border:none;font-weight:bold;">'.$nombres[++$y].'</td>
						</tr>';
							
					print '<tr style="border:none;">';
					
					vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x],$mis_cargas,$ruta);
						
					++$x;
						
					if(!empty($imagenes[$x])){
							
						vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x],$mis_cargas,$ruta);
					}
						
					++$x;
					
					if(count($nombres)>2){
						
						if(!empty($imagenes[$x])){
							
						vercampo($nombres[$x],$categorias[$x],$imagenes[$x],$ids[$x],$mis_cargas,$ruta);
						}
					}	
					
					print '</tr>';
	
						print '<tr style="border:none;">
						<td style="border:none;" colspan=3><hr/>
						</td></tr>';
											
				}
			}
		
			else{
			
				if(!empty($nombres[0])){
				
					vercampo($nombres[0],$categorias[0],$imagenes[0],$ids[0],$mis_cargas,$ruta,true);	
				}
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
		
			echo '<div style="float:right;"><ul>';
			
			if($_GET['pag']>2){
				
				
				echo '<li class="btn">
						<a href="'.$ruta.'?cat_id='.$_GET['cat_id'].'&pag=1"><<</a>
					</li>
				
				<li class="btn">
					<a href='.$ruta.'"?cat_id='.$_SESSION['categoria'].'&pag='.$DecrementNum.'">
						<img alt="go back" style="width:3em;height:3em;" src="'.$ruta.'img/back.png"/>
					</a>
				</li>';

			}
				
			$Desde=$compag-(ceil($CantidadMostrar/2)-1);
			$Hasta=$compag+(ceil($CantidadMostrar/2)-1);

			$Desde=($Desde<1)?1: $Desde;
			$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
			
			for($i=$Desde; $i<=$Hasta;$i++){
				
				if($i<=$TotalRegistro){
			
				if($i==$compag){
					echo "<li class=\"active\"><a href=\"".$ruta."?cat_id=".$_SESSION['categoria']."&pag=".$i."\">".$i."</a></li>";
				}
				else {
					echo "<li><a href=\"".$ruta."?cat_id=".$_SESSION['categoria']."&pag=".$i."\">".$i."</a></li>";
				}     		
				}
			}
					
			if($_GET['pag']>0 && $_GET['pag']+1<$TotalRegistro){
				
				echo '<li class="btn"><a href="'.$ruta.'?cat_id='.$_SESSION['categoria'].'&pag='.$IncrimentNum.'"><img alt="go next" style="width:3em;height:3em;" src="'.$ruta.'img/next.png"/></a></li>';
				
				if($IncrimentNum<$TotalRegistro){
					echo '<li style="margin-left:10px;" class="btn"><a href="'.$ruta.'?cat_id='.$_SESSION['categoria'].'&pag='.$TotalRegistro.'">>></a></li></ul></div>';
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

	echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<span style="font-size:20px;">' . ver_dato('cambiar_pass',$GLOBALS['idioma']). '</span>
<button style="margin-left:30px;float:right;" type="button" class="close"
data-dismiss="modal">
<span >&times;</span>
</button>
</div>
<div class="modal-body">
          <form method="post" action="' . $_SERVER['PHP_SELF'] . '">

        <div class="form-group">
		<img alt="usuario para registrar" class="icono2" src="'.$ruta.'img/user.png" />
		<label style="font-size:2em;" for="nombre_usuario">' . ver_dato('user_name',$GLOBALS['idioma']). '</label>
<input style="margin:auto;width:80%;" id="nombre_usuario" name="nombre_usuario" placeholder="' . ver_dato('user_name',
    $GLOBALS['idioma']) . '" type="text" class="form-control" id="recipient-name"/>
<br/>
<img alt="correo de restablecimiento" class="icono2" src="'.$ruta.'img/email.png"/>
<label style="font-size:2em;" for="correo_restablecimiento">' . ver_dato('email',
    $GLOBALS['idioma']) . '</label>
        <input style="margin:auto;width:80%;" id="correo_restablecimiento" name="correo_restablecimiento" placeholder="' .ver_dato('email', $GLOBALS['idioma']) . '"
		type="text" class="form-control" />
      <br/>
	  </div>
		<br/><br/>
           <input style="margin:auto;" name="restablecer_pass" type="submit" value="' .
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
	
	if(!file_exists('avatars')){
			mkdir('avatars', 0777, true);
	}
}

function ver_dato($accion,$idioma){
	
		$dato="";
	
	comprobar_config();

	$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	if (!$mysqli->connect_error) {
				
		$mysqli->set_charset("utf8");
	
		$consulta = $mysqli->query(	
		'SELECT texto FROM '.$idioma." WHERE accion='".$accion."'");
		
		$fila = $consulta->fetch_row();
	
		$dato=$fila[0];
		
		$mysqli->close();
	}
	
	return $dato;
}

function track(){
	
		if(!isset($_SESSION['track']) || $_SESSION['track']){
			
		$lista_negra=obtener_lista_negra('SELECT IP FROM bots');
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta=mysqli_query($GLOBALS['conexion'],"SELECT * FROM ver_bots");
				
			while($bots = mysqli_fetch_row($consulta)){
				
				mysqli_query($GLOBALS['conexion'],"INSERT INTO bots (IP) VALUES('".$bots[0]."');");

				$lista_negra[]=$bots[0];
			}
			
		mysqli_query($GLOBALS['conexion'],"DELETE FROM tbl_tracking where tx_navegador like '%crawler%' OR tx_navegador like '%Bot%' AND tx_ipRemota!='127.0.0.1';");

		$i_direccionIp      = $_SERVER['REMOTE_ADDR'];   
				
		if(comprobar_si_es_valido($i_direccionIp,$lista_negra)){
			
			$tx_pagina              = $_SERVER['REQUEST_URI']; 
			$tx_paginaOrigen        = $_SERVER['HTTP_REFERER'];
			$tx_paginaActual        =   $_SERVER['PHP_SELF']; 
			$tx_navegador       =   $_SERVER['HTTP_USER_AGENT']; 
			
		if(strlen($i_direccionIp)<12){
			$i_direccionIp='127.0.0.1';
			$country ="home";
		}
		
		if(is_private_ip($i_direccionIp)){
			$country ="home";
			$region ="home";
		}
		
		else{
			
			$geo = json_decode(file_get_contents('http://extreme-ip-lookup.com/json/'.$i_direccionIp));
			
			$region=$geo->city;
			
			switch($geo->country){
			
				case "Spain":
				$country ="es";
				break;
			
				case "France":
				$country ="fr";
				break;
				
				case "Germany":
				$country ="de";
				break;
				
				case "United States":
				$country ="us";
				break;
				
				case "Norway":
				$country ="no";
				break;
				
				case "Belgium":
				$country ="be";
				break;
				
				case "Ukraine":
				$country ="ukr";
				break;
				
				case "Canada":
				$country ="ca";
				break;

				case "United Kingdom":
				$country ="uk";
				break;
				
				case "India":
				$country ="india";
				break;
				
				case "Chile":
				$country ="chile";
				break;
				
				case "Brazil":
				$country ="brasil";
				break;
				
				case "Thailand":
				$country ="tai";
				break;
				
				case "Turkey":
				$country ="turkia";
				break;
				
				case "Pakistan":
				$country ="pakistan";
				break;
				
				case "Vietnam":
				$country ="vietnam";
				break;
				
				case "Peru":
				$country ="peru";
				break;
				
				case "Poland":
				$country ="polonia";
				break;
				
				case "Indonesia":
				$country ="indonesia";
				break;
				
				case "Ireland":
				$country ="ireland";
				break;
				
				case "South Korea":
				$country ="corea";
				break;
				
				case "Greece":
				$country ="grecia";
				break;
					
				case "Italy":
				$country ="italia";
				break;
				
				case "Netherlands":
				$country ="holanda";
				break;
				
				case "Czechia":
				$country ="chequia";
				break;
				
				case "Finland":
				$country ="finlandia";
				break;
				
				case "Iran":
				$country ="iran";
				break;
				
				case "Portugal":
				$country ="portugal";
				break;
				
				case "China":
				$country ="china";
				break;
				
				case "Israel":
				$country ="israel";
				break;
				
				case "Romania":
				$country ="romania";
				break;
				
				case "Russia":
				$country ="rusia";
				break;
				
				case "Armenia":
				$country ="armenia";
				break;
				
				case "Mauritius":
				$country ="mauricio";
				break;
				
				case "Iraq":
				$country ="iraq";
				break;
				
				case "Malaysia":
				$country ="malasia";
				break;
					
				case "Philippines":
				$country ="filipinas";
				break;
				
				case "Bangladesh":
				$country ="bangladesh";
				break;	
				
				case "Colombia":
				$country ="colombia";
				break;
				
				case "Reunion":
				$country ="reunion";
				break;
				
				case "Hong Kong":
				$country ="hongkong";
				break;
				
				case "Cambodia":
				$country ="camboya";
				break;
				
				case "United Arab Emirates":
				$country ="emiratos";
				break;
				
				case "South Africa":
				$country ="sudafrica";
				break;
				
				case "Mexico":
				$country ="mexico";
				break;
				
				case "Estonia":
				$country ="estonia";
				break;
				
				case "Austria":
				$country ="austria";
				break;
				
				case "Argentina":
				$country ="argentina";
				break;
				
				case "Japan":
				$country ="japon";
				break;
				
				case "Palestinian Territory":
				$country ="palestina";
				break;
				
				case "Bolivia":
				$country ="bolivia";
				break;
				
				case "Switzerland":
				$country ="suiza";
				break;
				
				case "Sweden":
				$country ="suecia";
				break;
				
				case "Morocco":
				$country ="marruecos";
				break;
				
				case "Venezuela":
				$country ="venezuela";
				break;
				
				case "Democratic Republic of the Congo":
				$country ="congo";
				break;
				
				case "Botswana":
				$country ="botswana";
				break;
				
				case "Singapore":
				$country ="singapur";
				break;
				
				case "Moldova":
				$country ="moldavia";
				break;
				
				case "Honduras":
				$country ="honduras";
				break;
				
				case "Ecuador":
				$country ="ecuador";
				break;
				
				case "Mongolia":
				$country ="mongolia";
				break;
				
				case "Nigeria":
				$country ="nigeria";
				break;
				
				case "Egypt":
				$country ="egipto";
				break;
				
				case "Latvia":
				$country ="letonia";
				break;
				
				case "Croatia":
				$country ="croacia";
				break;
				
				case "Slovakia":
				$country ="eslovaquia";
				break;
				
				case "Nepal":
				$country ="nepal";
				break;
				
				case "Angola":
				$country ="angola";
				break;
				
				case "Kenya":
				$country ="kenia";
				break;
				
				case "Australia":
				$country ="australia";
				break;
				
				case "Hungary":
				$country ="hungria";
				break;
				
				case "Kazakhstan":
				$country ="kazajistan";
				break;
				
				case "Denmark":
				$country ="dinamarca";
				break;
				
				case "Tunisia":
				$country ="tunez";
				break;
				
				case "Bulgaria":
				$country ="bulgaria";
				break;
				
				case "Timor Leste":
				$country ="timor-oriental";
				break;
				
				case "Serbia":
				$country ="serbia";
				break;
				
				case "Lithuania":
				$country ="lituania";
				break;
				
				case "Nicaragua":
				$country ="nicaragua";
				break;
				
				case "Panama":
				$country ="panama";
				break;
				
				case "Saudi Arabia":
				$country ="arabia-saudi";
				break;
				
				case "Georgia":
				$country ="georgia";
				break;
				
				case "Taiwan":
				$country ="taiwan";
				break;
				
				case "Paraguay":
				$country ="paraguay";
				break;
				
				case "New Zealand":
				$country ="nueva_zelanda";
				break;
				
				case "Albania":
				$country ="albania";
				break;
				
				case "Guam":
				$country ="guam";
				break;
				
				case "Slovenia":
				$country ="eslovenia";
				break;
				
				case "Malawi":
				$country ="malaui";
				break;
				
				case "Zimbabwe":
				$country ="zimbabue";
				break;
				
				case "Uganda":
				$country ="uganda";
				break;
				
				case "Madagascar":
				$country ="madagascar";
				break;
				
				case "Mali":
				$country ="mali";
				break;
				
				case "Sri Lanka":
				$country ="sri_lanka";
				break;
				
				case "Kosovo":
				$country ="kosovo";
				break;
				
				case "Bosnia and Herzegovina":
				$country ="bosnia";
				break;
				
				case "Cyprus":
				$country ="chipre";
				break;
				
				case "Costa Rica":
				$country ="costa_rica";
				break;
				
				case "Belarus":
				$country ="bielorrusia";
				break;
				
				case "Lebanon":
				$country ="libano";
				break;
				
				case "Cameroon":
				$country ="camerun";
				break;
				
				case "Sierra Leone":
				$country ="sierra_leona";
				break;
				
				case "Macedonia":
				$country ="macedonia";
				break;
				
				case "Sudan":
				$country ="sudan";
				break;
				
				case "Kyrgyzstan":
				$country ="kirguistan";
				break;
				
				case "Ghana":
				$country ="ghana";
				break;
				
				case "Uruguay":
				$country ="uruguay";
				break;
				
				case "Myanmar":
				$country ="birmania";
				break;
				
				case "Qatar":
				$country ="qatar";
				break;
				
				case "South Sudan":
				$country ="sudan_sur";
				break;
				
				case "Guatemala":
				$country ="guatemala";
				break;
				
				case "Dominican Republic":
				$country ="republica_dominicana";
				break;
				
				case "Luxembourg":
				$country ="luxemburgo";
				break;
				
				case "Puerto Rico":
				$country ="puerto_rico";
				break;
				
				case "Namibia":
				$country ="namibia";
				break;
				
				case "Uzbekistan":
				$country ="uzbekistan";
				break;
				
				case "Turkmenistan":
				$country ="turkmenistan";
				break;
				
				case 'Syria':
				$country ="siria";
				break;
				
				case "Algeria":
				$country ='argelia';
				break;
				
				case "Oman":
				$country ='oman';
				break;
				
				case "Tajikistan":
				$country ='tayikistan';
				break;
				
				case "Montenegro":
				$country ='montenegro';
				break;
				
				case "Azerbaijan":
				$country ='azerbaiyan';
				break;
				
				case "Swaziland":
				$country ='esuatini';
				break;
				
				case "Libya":
				$country ='libia';
				break;
				
				case "Zambia":
				$country ="zambia";
				break;
				
				case "Benin":
				$country ="benin";
				break;
				
				case "Mozambique":
				$country ="mozambique";
				break;
				
				case "Malta":
				$country ="malta";
				break;
				
				case "Laos":
				$country ="laos";
				break;
				
				case "Jamaica":
				$country ="jamaica";
				break;
				
				case "Somalia":
				$country ="somalia";
				break;
				
				case "Iceland":
				$country ="islandia";
				break;
				
				case "Guinea":
				$country ="guinea";
				break;
				
				default:
				$country ="unknow";
				break;
			}
		}
		

			mysqli_query ($GLOBALS['conexion'], "INSERT INTO 
			tbl_tracking (tx_pagina,tx_paginaOrigen,tx_ipRemota,tx_navegador,dt_fechaVisita,pais,ciudad) 
			VALUES('$tx_pagina','$tx_paginaOrigen','$i_direccionIp','$tx_navegador',now(),'$country','$region') ;");
		}
				
		mysqli_close($GLOBALS['conexion']);
	
	}
}

function menu_lateral($ruta = ""){
	track();
	
	if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
		}
		
	if($ruta=='todos'){
		$ruta='';
	}
	
?>

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="padding-left:70px;padding-right:20px;width:13em;overflow-x: hidden;" id="mySidebar"><br>
 
<div  class="w3-container">

    <a  onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey fa fa-remove" title="close menu"></a>
   
</div>

<div style="margin-left:-50px;" class="w3-bar-block">
  
<?php

    if(strpos("index.php",$_SERVER['PHP_SELF'])>=0){

		print '<a title="'.ver_dato('home', $GLOBALS['idioma']).'" href="'.$ruta.'index.php">
					<img alt="inicio" class="icono" style="margin-top:20px;" src="'.$ruta.'img/home.png" >
				</a>
				
				<hr class="separador"/>';
	}
	
	if($_GET['l']=='yes' || $_COOKIE['4images_userid']=="-1" || !isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']=="-1"){
		
		print '<form method="post" action="'.$ruta.'login.php" >

       		<a title="'.ver_dato('user_name',$GLOBALS['idioma']).'"><img alt="nombre de usuario" class="icono" style="margin:auto;padding-left:8px;" src="'.$ruta.'img/user.png"/></a>
	
			<label for="user_name"  style="font-size:2em;">'.ver_dato('user_name',$GLOBALS['idioma']).'</label>
		
			<input id="user_name" style="height:40px;font-size:2em;" type="text" name="user_name" class="logininput">
        
			<a title="'.ver_dato('password',$GLOBALS['idioma']).'"><img alt="clave de acceso" class="icono" style="margin:auto;margin-top:30px;" src="'.$ruta.'img/user_pass.png"/></a>
	
			<label for="user_password" style="font-size:2em;">'.ver_dato('password',$GLOBALS['idioma']).'</label>
		
			<input id="user_password" title="user password" style="font-size:2em;margin-right:10px;" type="password" size="10" name="user_password" class="logininput">
       
			<input id="login" style="margin-top:30px;margin-left:-3px;" title="login" name="login" type="submit" value="'.ver_dato('login',$GLOBALS['idioma']).'" class="button">
	  
		</form>

		  <hr class="separador"/>
		  
	 <div class="flotar_izquierda">
	  
		<a title="'.ver_dato('register',$GLOBALS['idioma']).'" style="font-size:1em;"
		href="'.$ruta.'register.php">

			<img alt="registar" class="icono" src="'.$ruta.'img/registrar.png">
		</a>

		<a title="'.ver_dato('recordar',$GLOBALS['idioma']).'" data-toggle="modal" 
		data-target="#exampleModal">

			  <img alt="'.ver_dato('recordar',$GLOBALS['idioma']).'" 
			  class="icono espacio_arriba" src="'.$ruta.'img/forgot_password.png"/>
		 </a>
		 
	</div>';
	
	}
	
	else{
		
		$imagen_usuario=$ruta.'img/nofoto.png';
		
		$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		
		$consulta = $mysqli->query('SELECT user_name FROM '.$GLOBALS['table_prefix']."users 
		WHERE user_id='".$_COOKIE['4images_userid']."'");

		$fila = $consulta->fetch_row();
		
		$consulta = $mysqli->query("SELECT COUNT(id) FROM mensajes WHERE oculto!='".$_COOKIE['4images_userid']."' AND destinatario='".$_COOKIE['4images_userid']."' AND leido=0");
		
		$recuento = $consulta->fetch_row();
		
		$consulta = $mysqli->query( 'SELECT avatar FROM '.$GLOBALS['table_prefix'] . "users WHERE user_id='".$_COOKIE['4images_userid']."'");
	
		$avatar = $consulta->fetch_row();
	
		$avatar=trim($avatar[0]);
		
		if($avatar!='nofoto.jpg' && !empty($avatar)){
			
			$imagen_usuario=$ruta.'avatars/'.$avatar;
		}
		
		$mysqli->close();

		if($recuento[0]>0){
		
			if(strpos($_SERVER['PHP_SELF'],"messages")>0){
				$enlace="";
			}

			else{
				$enlace="messages/";
			}

			print '<div style="float:left;">
				<a title="'.ver_dato('new_msg', $GLOBALS['idioma']).'" href="'.$enlace.'inbox.php">
					<span style="font-size:2em;">'.$recuento[0].'</span>
				</a>
			</div>';
		}
		
		print '<div style="float:left;padding-left:10px;">
				
				<a title="'.ver_dato('msg', $GLOBALS['idioma']).'" href="'.$ruta.'messages/index.php">
					<img alt="'.ver_dato('msg', $GLOBALS['idioma']).'" style="height:3.4em;width:3.4em;" src="'.$ruta.'img/email.png"/>
				</a>

			</div>
		
			<div style="float:left;padding-top:60px;">

				<a title="'.ver_dato('cambiar_avatar', $GLOBALS['idioma']).'" 
				href="'.$ruta.'cambiar_avatar.php">

					<img alt="'.ver_dato('user_name', $GLOBALS['idioma']).'" 
					class="icono imgRedonda" src="'.$imagen_usuario.'"/>
				</a>
				
			</div>
		
		<div style="width:100%;float:left;padding-top:10px;padding-left:4px;">

		<span id="estilo_usuario" >'.ucwords($fila[0]).'</span>
	
		<hr class="separador"/></div>
		
		<div class="flotar_izquierda clear">

		<div class="flotar_izquierda espacios_3">
	   <a title="'.ver_dato('config', $GLOBALS['idioma']).'" href="'.$ruta.'member.php">
			<img alt="'.ver_dato('config', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/settings.png">
		</a>
		</div>

		<div class="flotar_izquierda espacios_3">
       <a title="'.ver_dato('img_upload', $GLOBALS['idioma']).'" href="'.$ruta.'upload_images/index.php">
		<img alt="'.ver_dato('img_upload', $GLOBALS['idioma']).'" class="icono espacio_izquierda" src="'.$ruta.'img/upload.png"/>
	   </a>
	   </div>

	   <div class="flotar_izquierda espacios_3">
	   <a title="'.ver_dato('img_upload', $GLOBALS['idioma']).'" href="'.$ruta.'my_uploads.php">
			<img alt="'.ver_dato('img_upload', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/my_uploads.ico"/>
		</a></div>
		
		<div class="flotar_izquierda espacios_3">
	   <a title="'.ver_dato('img_fav', $GLOBALS['idioma']).'" href="'.$ruta.'favoritos.php">
		<img alt="'.ver_dato('img_fav', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/fav_2.ico"/>
		</a></div>
		
		<div class="flotar_izquierda espacios_3">
	   <a title="' . ver_dato('comentarios', $GLOBALS['idioma']) . '" href="'.$ruta.'comments.php">
			<img alt="' . ver_dato('comentarios', $GLOBALS['idioma']) . '" class="icono" src="'.$ruta.'img/coment.png"/>
		</a></div>
		
		<div class="flotar_izquierda espacios_3">
			<a title="' . ver_dato('search', $GLOBALS['idioma']) . '" href="'.$ruta.'search.php">
			<img alt="' . ver_dato('search', $GLOBALS['idioma']) . '" class="icono espacio_izquierda" src="'.$ruta.'img/search.png"/>
			</a>
		</div>

		<div class="flotar_izquierda">

			<hr/>
		
	  		<a  title="'.ver_dato('logout', $GLOBALS['idioma']).'" href="'.$ruta.'logout.php" >
				<img alt="'.ver_dato('logout', $GLOBALS['idioma']).'"  class="icono" src="'.$ruta.'img/logout.png"/>
			</a>

		</div>

	</div>';

	}

$imagen_aleatoria=imagen_aleatoria();

$image_thumb=substr($imagen_aleatoria,strpos($imagen_aleatoria,"-")+1,strpos($imagen_aleatoria,"*"));
$image_thumb=substr($image_thumb,0,strpos($image_thumb,"*"));

if($imagen_aleatoria!="vacio" && file_exists($ruta.'data/media/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb)){
	
	print '<div style="float:left;width:100%;"><hr class="separador"/>
	<a title="'.ver_dato('img_random', $GLOBALS['idioma']).'" ><img alt="aleatorio" style="height:5em;width:5em;" src="'.$ruta.'img/aleatorio.png"/></a>
	</div>';

	$image_id=substr($imagen_aleatoria,strpos($imagen_aleatoria,"*")+1,strpos($imagen_aleatoria,"#"));
	$image_id=substr($image_id,0,strpos($image_id,"#"));

	print '
	<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;">
	<a title="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" href="'.$ruta.'details.php?image_id='.$image_id.'">
	<img style="height:7.5em;width:7.5em;"  src="'.$ruta.'data/media/'.substr($imagen_aleatoria,0,strpos($imagen_aleatoria,"-")).'/'.$image_thumb.'" alt="'.substr($imagen_aleatoria,strpos($imagen_aleatoria,"#")+1).'" /></a>

	<hr class="separador" /></div>';
}

$redes_sociales='';

if(gettype($GLOBALS['facebook'])=='string' && $GLOBALS['facebook']!=""){	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a  title="facebook" target="_blank" href="https://www.facebook.com/'.$GLOBALS['facebook'].'"><img alt="Facebook" class="social" src="'.$ruta.'img/Social/facebook.png"/></a></div>';  
}

if(gettype($GLOBALS['instagram'])=='string' && $GLOBALS['instagram']!=""){	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"> <a  title="instagram" target="_blank" href="https://www.instagram.com/'.$GLOBALS['instagram'].'/"><img alt="Instagram" class="social" src="'.$ruta.'img/Social/instagram.png"/></a></div>';  
}

  if(gettype($GLOBALS['twitter'])=='string' && $GLOBALS['twitter']!=""){	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a  title="twitter" target="_blank" href="https://twitter.com/'.$GLOBALS['twitter'].'"><img alt="Twitter" class="social" src="'.$ruta.'img/Social/twitter.png"/></a></div>';  
}
  
if(gettype($GLOBALS['youtube'])=='string' && $GLOBALS['youtube']!=""){
	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a  title="youtube" target="_blank" href="https://www.youtube.com/user/'.$GLOBALS['youtube'].'"><img alt="Youtube" class="social" src="'.$ruta.'img/Social/youtube.png"/></a></div>';   
}
  
if(gettype($GLOBALS['debianart'])=='string' && $GLOBALS['debianart']!=""){
	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a  title="debianart" target="_blank" href="https://www.deviantart.com/'.$GLOBALS['debianart'].'/gallery/?catpath=scraps"><img alt="Debianart" class="social" src="'.$ruta.'img/Social/debianart.png"/></a></div>';   
}
  
if(gettype($GLOBALS['slideshare'])=='string' && $GLOBALS['slideshare']!=""){
	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a title="slideshare" target="_blank" href="https://es.slideshare.net/'.$GLOBALS['slideshare'].'"><img class="social" alt="Slideshare" src="'.$ruta.'img/Social/slideshare.png"/></a></div>';  
}
   
if(gettype($GLOBALS['github'])=='string' && $GLOBALS['github']!=""){
	$redes_sociales.='<div style="float:left;padding-top:20px;margin:auto;padding-left:20px;"><a title="github" target="_blank" href="https://github.com/'.$GLOBALS['github'].'"><img class="social" alt="Github" src="'.$ruta.'img/Social/github.png"/></a></div>';    
}

if(!empty($redes_sociales)){
		print '<div style="float:left;zoom:150%;-moz-transform: scale(1.3,1.3);">';
		print $redes_sociales.'</div>';
}        	     

if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>=0 ){
	
	$vars = get_defined_vars();  

	$administrators=array();
	
	$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	$consulta = $mysqli->query('SELECT user_id FROM '.$GLOBALS['table_prefix'].'users WHERE user_level=9');
	 
	while ($administradores = $consulta->fetch_row()){
		$administrators[]=$administradores[0];
	}
	
	$mysqli->close();
	 
	if(in_array($_COOKIE['4images_userid'], $administrators)){

	$admin='
			<div style="float:left;"><a title="'.ver_dato('adm', $GLOBALS['idioma']).'" href="'.$ruta.'admin/index.php">
				<img alt="'.ver_dato('adm', $GLOBALS['idioma']).'" class="icono" src="'.$ruta.'img/admin.png" / >
			</a><hr/></div>
		';
	}
		
}

print '

  <div class="flotar_izquierda" id="panel_admin">
  
    <hr/>'.$admin;
	
	if(file_exists($ruta.'forum')){
			
		print '<div class="flotar_izquierda">	
			<a title="foro" target="_blank" href="'.$ruta.'forum">
				<img  class="icono espacio_arriba_2" src="'.$ruta.'img/forum.png" alt="Ir al foro" />
			</a>
		</div>';	
		
	}
	
	if(logueado()){

		print '<div class="flotar_izquierda" > 

			<a title="buscador" href="'.$ruta.'search.php">

				<img class="icono espacio_arriba_2" src="'.$ruta.'img/search.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" />
			</a>

		</div>';
	}
	
	print '<div style="float:left;padding-top:20px;"> 

				<a title="rss" href="'.$ruta.'rss.php">
					<img style="margin-top:20px;" class="icono" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" />
				</a>

			</div>
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

		$consulta = mysqli_query($GLOBALS['conexion'],
		'SELECT COUNT(cat_id) FROM '.$GLOBALS['table_prefix'].'categories');

		$recuento = mysqli_fetch_row($consulta);
	
		if($recuento[0]>0){

			print '<aside class="transparente flotar_derecha" id="menu_categorias">
			<div class="transparente">
				<div class="transparente">
					<div id="dl-menu" class="dl-menuwrapper transparente flotar_derecha">
						<button class="dl-trigger"></button>
						<ul id="menu_aside" class="dl-menu " style="background-color: rgba(255, 255, 255, 0);" >
						';		
			$id_categorias=array();

			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT DISTINCT(cat_parent_id) FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id>0 ORDER BY cat_name');

			while ($recuento = mysqli_fetch_row($consulta)){
				$id_categorias[]=$recuento[0];
			}

			for($x=0;$x<count($id_categorias);$x++){
				
				$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_id='.$id_categorias[$x]);
				$fila = mysqli_fetch_row($consulta);
			
				print '
				<li style="background-color: rgba(255, 255, 255, 0);padding-top:20px;" class="menu_categorias">
				<a style="color:#ffffff;background-color:#9D37BE;font-size:0.7em;font-weight:bold;" href="#">'.$fila[0].'</a>';
			
				$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id='.$id_categorias[$x].' ORDER BY cat_name');
			
				$y=1;
				
				print '<ul style="background-color: rgba(255, 255, 255, 0);" class="dl-submenu ">';
						
				while ($subcategorias = mysqli_fetch_array($consulta)){
					
						print '<li style="background-color: rgba(255, 255, 255, 0);" >
						<a style="margin-left:-20px;margin-top:20px;font-size:0.7em;font-weight:bold;" href="'.$ruta.'categories.php?cat_id='.$subcategorias[1].'">'.$subcategorias[0].'</a>
						</li>';
									
					$y++;		
				}
				
				print '</ul>
				</li>';	
				
			}

			$consulta = mysqli_query($GLOBALS['conexion'], 
			'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id=0 AND cat_id NOT IN (SELECT DISTINCT cat_parent_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id!=0) ORDER BY cat_name');

			while ($fila = mysqli_fetch_row($consulta)){

				print '
				<li style="padding-top:20px;background-color: rgba(255, 255, 255, 0);" class="menu_categorias menu ">
				<a style="color:#ffffff;background-color:#4952C2;font-size:0.7em;font-weight:bold;" href="'.$ruta.'categories.php?cat_id='.$fila[1].'">'.$fila[0].'</a></li>';
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
	
	$resultado="";
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	  $consulta = mysqli_query($GLOBALS['conexion'],'SELECT image_id FROM '.$GLOBALS['table_prefix']."images WHERE image_active='1'");

	if(mysqli_affected_rows($GLOBALS['conexion'])>0){
	 
	 $id_imagenes=array();
	 
		while($num_imagenes = mysqli_fetch_array($consulta)){
			$id_imagenes[]=$num_imagenes[0];
		}
				
			$id_imagen_aleatoria = $id_imagenes[array_rand($id_imagenes)];
		
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_id,image_media_file,image_name FROM '.$GLOBALS['table_prefix']."images WHERE image_active='1' AND image_id='".$id_imagen_aleatoria."'");
			
			$imagen_aleatoria = mysqli_fetch_array($consulta);
	  
			$resultado=$imagen_aleatoria[0]."-".$imagen_aleatoria[1]."*".$id_imagen_aleatoria."#".$imagen_aleatoria[2];
		}
	
	else{
		$resultado= 'vacio';
	}
	
	mysqli_close($GLOBALS['conexion']);
 
	return $resultado;
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