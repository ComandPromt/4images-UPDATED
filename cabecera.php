<?php

date_default_timezone_set('Europe/Madrid');

if(file_exists('config.php')){
	include_once('config.php');
}

include_once('includes/funciones.php');

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
	<script src="js/funciones.js"></script>

	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.scrollbar.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/scroll.css" />
    <link rel="stylesheet" href="css/prettify.css" />

	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet" type="text/css" href="tooltip/css/estiloDelEjemplo.css">
	<link rel="stylesheet" type="text/css" href="tooltip/css/estilo.css">

	<link rel="icon" type="image/ico" href="img/favicon.ico">

	<script  src="tooltip/js/tooltip.js"></script>
 
	<title>Web</title>
	<style>
			  *{
				  background-color:#ffffff;
			  }
              /******************* WINDOWS VISTA SCROLLBAR *******************/
              
              .scrollbar-vista > .scroll-content.scroll-scrolly_visible { left: -17px; margin-left: 17px; }
              .scrollbar-vista > .scroll-content.scroll-scrollx_visible { top:  -17px; margin-top:  17px; }
              
              
              .scrollbar-vista > .scroll-element {
                  background-color: #fcfdff;
              }
              
              .scrollbar-vista > .scroll-element,
              .scrollbar-vista > .scroll-element *
              {
                  border: none;
                  margin: 0;
                  overflow: hidden;
                  padding: 0;
                  position: absolute;
                  z-index: 10;
              }
              
              .scrollbar-vista > .scroll-element .scroll-element_outer,
              .scrollbar-vista > .scroll-element .scroll-element_size,
              .scrollbar-vista > .scroll-element .scroll-element_inner-wrapper,
              .scrollbar-vista > .scroll-element .scroll-element_inner,
              .scrollbar-vista > .scroll-element .scroll-bar,
              .scrollbar-vista > .scroll-element .scroll-bar div
              {
                  height: 100%;
                  left: 0;
                  top: 0;
                  width: 100%;
              }
              
              .scrollbar-vista > .scroll-element .scroll-element_outer,
              .scrollbar-vista > .scroll-element .scroll-element_size,
              .scrollbar-vista > .scroll-element .scroll-element_inner-wrapper,
              .scrollbar-vista > .scroll-element .scroll-bar_body
              {
                  background: none !important;
              }
                            
              .scrollbar-vista > .scroll-element.scroll-x {
                                border-top: solid 1px #fcfdff;
                                bottom: 0;
                                height: 16px;
                                left: 0;
                                min-width: 100%;
                                width: 100%;
                            }

              .scrollbar-vista > .scroll-element.scroll-y {
                                border-left: solid 1px #fcfdff;
                                height: 100%;
                                min-height: 100%;
                                right: 0;
                                top: 0;
                                width: 16px;
               }

               .scrollbar-vista > .scroll-element.scroll-y div {
				background-image: url('skins/vista-y.png');
				background-repeat: repeat-y;
               }

               .scrollbar-vista > .scroll-element.scroll-x .scroll-arrow {}

                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar { min-width: 16px; background-position: 0px -34px; background-repeat: no-repeat; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_body { left: 2px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_body-inner { left: -4px; background-position: 0px -17px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_center { left: 50%; margin-left: -6px; width: 12px; background-position: 24px -34px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_bottom { left: auto; right: 0; width: 2px; background-position: 37px -34px; }


                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar { min-height: 16px; background-position: -34px 0px; background-repeat: no-repeat; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_body { top: 2px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_body-inner { top: -4px; background-position: -17px 0px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_center { top: 50%; margin-top: -6px; height: 12px; background-position: -34px 24px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_bottom { top: auto; bottom: 0; height: 2px; background-position: -34px 37px; }



                            /* SCROLL ARROWS */

                            .scrollbar-vista > .scroll-element .scroll-arrow { display: none; }
                            .scrollbar-vista > .scroll-element.scroll-element_arrows_visible .scroll-arrow { display: block; z-index: 12; }


                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-arrow_less { height: 100%; width: 17px; background-position: 0px -51px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-arrow_more { height: 100%; left: auto; right: 0; width: 17px; background-position: 17px -51px;}

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_outer { left: 17px; }
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_inner { left: -34px; }
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_size { left: -34px; }


                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-arrow_less { width: 100%; height: 17px; background-position: -51px 0px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-arrow_more { width: 100%; top: auto; bottom: 0; height: 17px; background-position: -51px 17px;}

                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_outer { top: 17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_inner { top: -34px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_size { top: -34px; }


                            /* PROCEED OFFSET IF ANOTHER SCROLL VISIBLE */

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size { left: -17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size { top: -17px; }

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_inner { left: -17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_inner { top: -17px; }


                            /* PROCEED OFFSET IF ARROWS & ANOTHER SCROLL */

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-arrow_more { right: 17px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-element_inner { left: -51px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-element_size { left: -51px;}


                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-arrow_more { bottom: 17px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-element_inner { top: -51px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-element_size { top: -51px;}

		@media only screen and (min-width: 900px) {
			#menu_usuario {
				opacity:0;
			}
		}
	
		.tooltip {
	
		display: inline-block;
	
		}
	
		.tooltip .tooltiptext {
			visibility: hidden;
	
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			
			/* Position the tooltip */
			position: absolute;
			z-index: 1;
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
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
	<link rel="alternate" type="application/rss+xml" title="<?php print 'RSS Feed: '.$GLOBALS['site_name']." (Nuevas imágenes)";?>" href="rss.php?action=images">
	</head>
<body>

<?php

menu_categorias();
menu_lateral();

print '</div</div>';

?>
	 
</div>

<div  style="margin: auto; width: 50%;padding-left:10%;width:80%;margin-top:30px;"> 
<div class="texto">