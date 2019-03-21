<?php

if($_GET['l']=="yes" && isset($_SESSION['login']) && $_SESSION['login']){
	session_unset();
}
else{
	session_start();
}
include_once('includes/funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?php print $db_name;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="revisit-after" content="10 days">
	<script src="js/funciones.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="icon" type="image/ico" href="img/favicon.ico">
	
	<style>
	@media only screen and (min-width: 900px) {
	#menu_usuario {
		opacity:0;
	}
}
	</style>
	<script>
		//Especificar a que elementos afectará, añadiendo o quitando de la lista:
		var tgs = new Array( 'div','td','tr');
		
		//Indicar el nombre de los diferentes tamaños de fuente:
		var szs = new Array( 'xx-small','x-small','small','medium','large','x-large','xx-large' );
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
			if (captcha_image_url.indexOf('?') == -1) {
				document.getElementById('captcha_image').src= captcha_image_url+'?c='+captcha_reload_count;
				} else {
				document.getElementById('captcha_image').src= captcha_image_url+'&c='+captcha_reload_count;
				}
		
			document.getElementById('captcha_input').value="";
			document.getElementById('captcha_input').focus();
			captcha_reload_count++;
		}
		
			function opendetailwindow() { 
			window.open('','detailwindow','toolbar=no,scrollbars=yes,resizable=no,width=680,height=480');
		}
		
		if (document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = right;
		}
		else if (document.all && !document.getElementById){
			document.onmousedown = right;
		}
		var txt = "<?php echo $site_name;?>";
			document.oncontextmenu = new Function("alert('© Copyright by "+txt+"');return false");
		
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
	<link rel="alternate" type="application/rss+xml" title="<?php print 'RSS Feed: '.$site_name." (Nuevas imágenes)";?>" href="rss.php?action=images">
	</head>
<body>

<?php
menu_categorias();
 menu_lateral();
 
print ' 
  
</div></div> ';


/*
$consulta = mysqli_query($conexion, 'SELECT cat_id,cat_name FROM '.$table_prefix.'categories WHERE cat_id NOT IN(
SELECT DISTINCT(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id 
IN(SELECT  distinct(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id>0)
) AND cat_parent_id=0;');
$id_categorias=array();
$nombre_categoria=array();
	  while ($recuento = mysqli_fetch_array($consulta)){
			$id_categorias[]=$recuento[0];
			$nombre_categoria[]=$recuento[1];
		}

		for($x=0;$x<count($id_categorias);$x++){
			print '<a href="categories.php?cat_id='.$id_categorias[$x].'"><img alt="'.$nombre_categoria[$x].'"
			src="img/Categories/'.$nombre_categoria[$x].'.png" class="icono"></a>';
		}
		
		print '<a href="todos.php"><img alt="Buscar" src="img/search.png" class="icono"></a>
        
  <a href="./search.php?search_new_images=1" onclick="w3_close()" class="w3-bar-item w3-button w3-padding">
 <img alt="New" src="img/new.png" style="width:150px;height:150px">
 </a>';
		*/
?>
	

 
</div>




<div  style="margin: auto; width: 50%;padding-left:10%;width:80%;margin-top:30px;"> 
<div class="texto">