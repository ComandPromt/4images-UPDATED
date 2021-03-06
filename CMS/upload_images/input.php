<?php

include('../includes/funciones.php');

include('../config.php');

$_SESSION['track']=false;

comprobar_cookie('../');

if(isset($_POST['categoria']) && !empty($_POST['categoria'])){

	if(!file_exists('../data/media/'.$_POST['categoria'])){
			mkdir('../data/media/'.$_POST['categoria'], 0777, true);
		}
}
	
session_start();


if(isset($_GET['periquito'])){
	$_SESSION['periquito']=$_GET['periquito'];
}

?>

<!DOCTYPE html>

<html lang="es" class="js">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Drag and Drop File Uploading</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/estilos.css">
		<link rel="icon" type="image/ico" href="../img/favicon.ico">
	
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
		
		<?php print'var txt = "'.$GLOBALS['site_name'].'";'; ?>

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
	
	<style>
				body{
					font-family: Roboto, sans-serif;
					color: #0f3c4b;
					background-color: #e5edf1;
					padding: 5rem 1.25rem; /* 80 20 */
				}
	
				.container{
					width: 100%;
					max-width: 680px; /* 800 */
					text-align: center;
					margin: 0 auto;
				}
	
				.container h1{
					font-size: 42px;
					font-weight: 300;
					color: #0f3c4b;
					margin-bottom: 40px;
				}

				.container h1 a:hover,
				.container h1 a:focus{
						color: #39bfd3;
				}
	
				.container nav{
					margin-bottom: 40px;
				}

				.container nav a{
					border-bottom: 2px solid #c8dadf;
					display: inline-block;
					padding: 4px 8px;
					margin: 0 5px;
				}
						.container nav a.is-selected
						{
							font-weight: 700;
							color: #39bfd3;
							border-bottom-color: currentColor;
						}
						.container nav a:not( .is-selected ):hover,
						.container nav a:not( .is-selected ):focus
						{
							border-bottom-color: #0f3c4b;
						}
	
					.container footer
					{
						color: #92b0b3;
						margin-top: 40px;
					}
						.container footer p + p
						{
							margin-top: 1em;
						}
						.container footer a:hover,
						.container footer a:focus
						{
							color: #39bfd3;
						}
	
					.box
					{
						font-size: 1.25rem; /* 20 */
						background-color: #c8dadf;
						position: relative;
						padding: 100px 20px;
					}
					.box.has-advanced-upload
					{
						outline: 2px dashed #92b0b3;
						outline-offset: -10px;
	
						-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
						transition: outline-offset .15s ease-in-out, background-color .15s linear;
					}
					.box.is-dragover
					{
						outline-offset: -20px;
						outline-color: #c8dadf;
						background-color: #fff;
					}
						.box__dragndrop,
						.box__icon
						{
							display: none;
						}
						.box.has-advanced-upload .box__dragndrop
						{
							display: inline;
						}
						.box.has-advanced-upload .box__icon
						{
							width: 100%;
							height: 80px;
							fill: #92b0b3;
							display: block;
							margin-bottom: 40px;
						}
	
						.box.is-uploading .box__input,
						.box.is-success .box__input,
						.box.is-error .box__input
						{
							visibility: hidden;
						}
	
						.box__uploading,
						.box__success,
						.box__error
						{
							display: none;
						}
						.box.is-uploading .box__uploading,
						.box.is-success .box__success,
						.box.is-error .box__error
						{
							display: block;
							position: absolute;
							top: 50%;
							right: 0;
							left: 0;
	
							-webkit-transform: translateY( -50% );
							transform: translateY( -50% );
						}
						.box__uploading
						{
							font-style: italic;
						}
						.box__success
						{
							-webkit-animation: appear-from-inside .25s ease-in-out;
							animation: appear-from-inside .25s ease-in-out;
						}
							@-webkit-keyframes appear-from-inside
							{
								from	{ -webkit-transform: translateY( -50% ) scale( 0 ); }
								75%		{ -webkit-transform: translateY( -50% ) scale( 1.1 ); }
								to		{ -webkit-transform: translateY( -50% ) scale( 1 ); }
							}
							@keyframes appear-from-inside
							{
								from	{ transform: translateY( -50% ) scale( 0 ); }
								75%		{ transform: translateY( -50% ) scale( 1.1 ); }
								to		{ transform: translateY( -50% ) scale( 1 ); }
							}
	
						.box__restart
						{
							font-weight: 700;
						}
						.box__restart:focus,
						.box__restart:hover
						{
							color: #39bfd3;
						}
	
						.js .box__file
						{
							width: 0.1px;
							height: 0.1px;
							opacity: 0;
							overflow: hidden;
							position: absolute;
							z-index: -1;
						}
						.js .box__file + label
						{
							max-width: 80%;
							text-overflow: ellipsis;
							white-space: nowrap;
							cursor: pointer;
							display: inline-block;
							overflow: hidden;
						}
						.js .box__file + label:hover strong,
						.box__file:focus + label strong,
						.box__file.has-focus + label strong
						{
							color: #39bfd3;
						}
						.js .box__file:focus + label,
						.js .box__file.has-focus + label
						{
							outline: 1px dotted #000;
							outline: -webkit-focus-ring-color auto 5px;
						}
							.js .box__file + label *{
								/* pointer-events: none; */ /* in case of FastClick lib use */
							}
	
						.no-js .box__file + label
						{
							display: none;
						}
	
						.no-js .box__button
						{
							display: block;
						}
						.box__button
						{
							font-weight: 700;
							color: #e5edf1;
							background-color: #39bfd3;
							display: none;
							padding: 8px 16px;
							margin: 40px auto 0;
						}
							.box__button:hover,
							.box__button:focus
							{
								background-color: #0f3c4b;
							}
		</style>
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
	</head>
	
	<body>
	
		<div style="margin-top:-60px;" class="container">
		
		<?php
		
			$nombre_categoria="";
		
			if(isset($_POST['categoria'])){
				$nombre_categoria=$_POST['categoria'];
			}
			
			if(isset($_SESSION['categoria'])){
				$nombre_categoria=$_SESSION['categoria'];
			}
			
			if($nombre_categoria!=""){
				
				print '<div style="float:right;padding-right:10px;">
				<img class="iconos" style="margin-left:10px;" src="../img/tag_2.png"/> <h2 style="margin-left:10px;font-size:20px;margin-top:5px;font-weight:bold;
	color:#FFC151;
	background-color:#0B7C92;
	padding-left:5px;
	padding-right:5px;
	border: 1px solid #4D56EE;
	-moz-border-radius: 9px;
	-webkit-border-radius:9px;">'.saber_categoria($nombre_categoria).'</h2>
				</div>';
				
				print '<div style="float:right;padding-right:20px;border-right: 4px dotted blue;">

								<img class="iconos" src="../img/write.png"/> <h2  style="font-size:20px;margin-top:5px;font-weight:bold;
	color:#FFC151;
	background-color:#0B7C92;
	padding-left:5px;
	padding-right:5px;
	border: 1px solid #4D56EE;
	-moz-border-radius: 9px;
	-webkit-border-radius:9px;" >'.$_POST['nombre'].'</h2>
								
								</div>';
			}
		?>
		
		<p style="padding-bottom:20px;">
		
			<a href="../index.php">
				<img style="height:40px;width:40px;margin-right:20px;" src="../img/home.png"/>
			</a>
			
			<a href="index.php">
				<img style="height:40px;width:40px;" src="../img/back_2.png"/>
			</a>
		</p>
		
			<form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">
					<div class="box__input">
						<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
						<input type="file" name="upload[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple=""/>
						<h1><label id="mensaje" for="file">Select</label></h1>
					</div>
				<input type="hidden" name="ajax" value="1"/>
			</form>
		</div>
		
		<script>
			'use strict';
		
			;( function ( document, window, index )
			{
				var isAdvancedUpload = function()
					{
						var div = document.createElement( 'div' );
						return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
					}();
				var forms = document.querySelectorAll( '.box' );
				Array.prototype.forEach.call( forms, function( form )
				{
					var input		 = form.querySelector( 'input[type="file"]' ),
						label		 = form.querySelector( 'label' ),
						errorMsg	 = form.querySelector( '.box__error span' ),
						restart		 = form.querySelectorAll( '.box__restart' ),
						droppedFiles = false,
						showFiles	 = function( files )
						{
							label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
						},
						triggerFormSubmit = function()
						{
							var event = document.createEvent( 'HTMLEvents' );
							event.initEvent( 'submit', true, false );
							form.dispatchEvent( event );
						};
					var ajaxFlag = document.createElement( 'input' );
					ajaxFlag.setAttribute( 'type', 'hidden' );
					ajaxFlag.setAttribute( 'name', 'ajax' );
					ajaxFlag.setAttribute( 'value', 1 );
					form.appendChild( ajaxFlag );
					input.addEventListener( 'change', function( e )
					{
						showFiles( e.target.files );
		
						
						triggerFormSubmit();
		
						
					});
					if( isAdvancedUpload )
					{
						form.classList.add( 'has-advanced-upload' ); // letting the CSS part to know drag&drop is supported by the browser
		
						[ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( function( event )
						{
							form.addEventListener( event, function( e )
							{
								// preventing the unwanted behaviours
								e.preventDefault();
								e.stopPropagation();
							});
						});
						[ 'dragover', 'dragenter' ].forEach( function( event )
						{
							form.addEventListener( event, function()
							{
								form.classList.add( 'is-dragover' );
							});
						});
						[ 'dragleave', 'dragend', 'drop' ].forEach( function( event )
						{
							form.addEventListener( event, function()
							{
								form.classList.remove( 'is-dragover' );
							});
						});
						form.addEventListener( 'drop', function( e )
						{
							droppedFiles = e.dataTransfer.files; // the files that were dropped
							showFiles( droppedFiles );
		
							
							triggerFormSubmit();
		
											});
					}
		
					form.addEventListener( 'submit', function( e )
					{
						if( form.classList.contains( 'is-uploading' ) ) return false;
		
						form.classList.add( 'is-uploading' );
						form.classList.remove( 'is-error' );
		
						if( isAdvancedUpload ) 
						{
							e.preventDefault();
	
							var ajaxData = new FormData( form );
							if( droppedFiles )
							{
								Array.prototype.forEach.call( droppedFiles, function( file )
								{
									ajaxData.append( input.getAttribute( 'name' ), file );
								});
							}
							var ajax = new XMLHttpRequest();
							ajax.open( form.getAttribute( 'method' ), form.getAttribute( 'action' ), true );
		
							ajax.onload = function()
							{
								form.classList.remove( 'is-uploading' );

								
								if( ajax.status >= 200 && ajax.status < 400 )
								{
									var data = JSON.parse( ajax.responseText );
									form.classList.add( data.success == true ? 'is-success' : 'is-error' );
									if( !data.success ) errorMsg.textContent = data.error;
									
								}
							
							};
		
							ajax.send( ajaxData );
							
							if(document.getElementById("mensaje").innerHTML!="Select"){
								document.getElementById("mensaje").innerHTML='Select';
							}
					
						}
						else
						{
							var iframeName	= 'uploadiframe' + new Date().getTime(),
							iframe		= document.createElement( 'iframe' );
							$iframe		= $( '<iframe name="' + iframeName + '" style="display: none;"></iframe>' );
							iframe.setAttribute( 'name', iframeName );
							iframe.style.display = 'none';
							document.body.appendChild( iframe );
							form.setAttribute( 'target', iframeName );
							iframe.addEventListener( 'load', function()
							{
								var data = JSON.parse( iframe.contentDocument.body.innerHTML );
								form.classList.remove( 'is-uploading' )
								form.classList.add( data.success == true ? 'is-success' : 'is-error' )
								form.removeAttribute( 'target' );
								if( !data.success ) errorMsg.textContent = data.error;
								iframe.parentNode.removeChild( iframe );
							});
						}
					});
	
						Array.prototype.forEach.call( restart, function( entry )
					{
						entry.addEventListener( 'click', function( e )
						{
							e.preventDefault();
							form.classList.remove( 'is-error', 'is-success' );
							input.click();
						});
					});
					input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
					input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
		
				});
			}( document, window, 0 ));
		</script>
		
		<?php
		
		if(!isset($_SESSION['user_id'])){
			$_SESSION['user_id']=0;
		}
		
		if(isset($_GET['cat_id']) && isset($_GET['nombre'])){
				
					$_SESSION['categoria']=$_GET['cat_id'];
			
					$_SESSION['nombre']=$_GET['nombre'];
		}
		
		else{
			
			$_POST['nombre']=eliminar_espacios($_POST['nombre']);
			
			if(isset($_POST['admin_upload']) && !empty($_POST['categoria'])
			 && !empty($_POST['nombre'])){
				$_SESSION['categoria']=$_POST['categoria'];
				$_SESSION['nombre']=trim($_POST['nombre']);
				$_SESSION['subida']=false;
			}
			
			else{
				redireccionar('index.php');
			}
		}
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id
		FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$_POST['usuario']."'");

		if(mysqli_affected_rows($GLOBALS['conexion'])==1){
	
			$fila = mysqli_fetch_row($consulta);
			$_SESSION['user_id']=$fila[0];

		}

		if(isset($_FILES['upload']['name'])){

			$fecha=date('Y').'-'.date('m').'-'.date('d');
			
			$y=0;
			
			$nombresImagenes=array();
			
			for($i=1; $i<=count($_FILES['upload']['name']); $i++) {
							
				$extension=strtolower(substr($_FILES['upload']['name'][$y],-3));
				
				if($extension=='peg'){
					$extension='jpg';
					$_FILES['upload']['name'][$y]=substr($_FILES['upload']['name'][$y],0,-4).'jpg';
				}
				
				if($extension=='jpg' || $extension=='png'|| $extension=='gif'){
					
					$fichTemporal = $_FILES['upload']['tmp_name'][$y];

					$shaimage=hash_file('sha256',$fichTemporal);
					
					$nombre_fecha=date('Y').'_'.date('m').'_'.date('j').'_'.date('G').'-'.date('i').'-'.date('s').'_'.$i.'.'.$extension;
					
					if(isset($_SESSION['periquito']) && $_SESSION['periquito']=="si"){
								
						$nombre_imagen_bd=basename($_FILES['upload']['name'][$y]);
					}
					
					else{
						$nombre_imagen_bd=$nombre_fecha;
					}
				
					$nombresImagenes[]=$nombre_imagen_bd;

					$destino = '../data/media/'.$_SESSION['categoria'].'/'.$nombre_imagen_bd;
					
					move_uploaded_file($fichTemporal, $destino);
					
					$consulta=mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(image_id) 
					FROM '.$GLOBALS['table_prefix']."images WHERE sha256='".$shaimage."'");
				
					$fila = mysqli_fetch_row($consulta);
				
					if($fila[0]==0){
						
						$_SESSION['subida']=true;
											
						$consulta=mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(image_id) FROM '.$GLOBALS['table_prefix']."images WHERE image_media_file='$nombre_imagen_bd'");
					
						$comprobacion = mysqli_fetch_row($consulta);
						
						$comprobacion[0]=(int)$comprobacion[0];
						
						if($comprobacion[0]==1){
							$nombre_imagen_bd=$nombre_fecha;
						}
						
						mysqli_query($GLOBALS['conexion'], '
					
						INSERT INTO '.$GLOBALS['table_prefix']."images
						(cat_id, user_id,image_name,image_description,
						image_keywords,image_date,image_active,image_media_file,
						image_allow_comments,image_comments,image_downloads,
						image_votes,image_rating,image_hits,sha256,nivel_descarga,nivel_comentario)
						
						VALUES('".$_SESSION['categoria']."','".
						$_COOKIE['4images_userid']."','".$_SESSION['nombre'].
						"',NULL,NULL,'".$fecha."','1','".$nombre_imagen_bd.
						"',DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,'".
						$shaimage."',DEFAULT,DEFAULT)");
						
					}
					
					else{
						unlink('../data/media/'.$_SESSION['categoria'].'/'.$nombre_imagen_bd);
					}
				
				}
				
					$y++;
				
			}
					
			$nombreImagenBd="";
			
			for($i=0;$i<count($nombresImagenes);$i++){
				
				$nombreImagenBd=$nombresImagenes[$i];
				
				if(!file_exists('../data/media/'.$_SESSION['categoria'].'/'.$nombreImagenBd)){
					mysqli_query($GLOBALS['conexion'], 'DELETE FROM '.$GLOBALS['table_prefix']."images WHERE image_media_file='".$nombreImagenBd."'");
				}
				
			}
			
			mysqli_close($GLOBALS['conexion']);
									
			if($_SESSION['subida']){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);
				mensaje(ver_dato('upload_success', $GLOBALS['idioma']));
			}

		}
					
		?>
		
	</body>
	
</html>