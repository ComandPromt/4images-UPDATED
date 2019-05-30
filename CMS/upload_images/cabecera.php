<?php

date_default_timezone_set('Europe/Madrid');

if(file_exists('../config.php')){
	include_once('../config.php');
}

include_once('../includes/funciones.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="revisit-after" content="10 days">
	<script src="../js/funciones.js"></script>
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.scrollbar.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/css.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/scroll.css" />
    <link rel="stylesheet" href="../css/prettify.css" />
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="stylesheet" type="text/css" href="../css/component.css" />
	<link rel="stylesheet" type="text/css" href="../tooltip/css/estiloDelEjemplo.css">
	<link rel="stylesheet" type="text/css" href="../tooltip/css/estilo.css">
	<link rel="stylesheet" type="text/css" href="../css/scrollbar.css" />
	<link rel="stylesheet" type="text/css" href="../css/tablas.css" />
	<link rel="icon" type="image/ico" href="../img/favicon.ico">

	<script  src="../tooltip/js/tooltip.js"></script>
 
	<title>Web</title>
	
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
	
	<link rel="alternate" type="application/rss+xml" title="<?php print 'RSS Feed: '.$GLOBALS['site_name']." (Nuevas imágenes)";?>" href="../rss.php?action=images">
	
	</head>
<body style="zoom:90%;">

<div id="navega"> 

<div id="menu"> 

<div id="fijo">

    <a style="zoom:300%;float:left;margin-left:7px;margin-top:2px;" id="menu_usuario" onclick="w3_open();"><i style="float:left" class="fa fa-bars"></i></a>

<br/>
	
	</div>
	
</div>

</div>

<?php

menu_lateral('../');

print '</div</div>';

?>
	 
</div>

<div  style="margin: auto; width: 50%;padding-left:10%;width:80%;margin-top:30px;"> 