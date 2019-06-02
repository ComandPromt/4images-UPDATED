<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

$_SESSION['insert_pag']='details.php';

$_SESSION['insert_pag']='details.php';

$ultima_imagen=0;

if(!isset($_SESSION['insert'])){
	$_SESSION['insert']=false;
}
	
if(isset($_GET['image_id']) &&  (int)$_GET['image_id']>0){
	
	include('config.php');

	if(isset($_COOKIE['4images_userid'])){
	
		$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
		if($_COOKIE['4images_userid']>0){
			$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
		}
	}

	if (isset($_POST['comentario'])&&!empty($_POST['captcha']) && (trim(strtolower($_POST['captcha'])) == $_SESSION['captcha'])) {
				
		$lista_negra=obtener_lista_negra();

		if(comprobar_si_es_valido($_POST['mensaje'],$lista_negra)
		&& comprobar_si_es_valido($_POST['asunto'],$lista_negra)){
	
			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
			$GLOBALS['db_password'], $GLOBALS['db_name'])
			or die("No se pudo conectar a la base de datos");
	
			mysqli_query($GLOBALS['conexion'],
			'INSERT INTO '.$GLOBALS['table_prefix'] .
			"comments (image_id,user_id,comment_headline,comment_text,comment_ip,comment_date) VALUES('".$_GET['image_id']."','".$_COOKIE['4images_userid']."','".$_POST['asunto']."','".$_POST['mensaje']."','".$_SERVER['REMOTE_ADDR']."','".date('Y').'/'.date('m').'/'.date('d')."')" );
		
			mysqli_close($GLOBALS['conexion']);
		}
		
	}
	
    unset($_SESSION['captcha']);

	$_SESSION['pagina']="details.php?image_id=".$_GET['image_id'];
	
	cabecera();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],$GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_id FROM ' .
    $GLOBALS['table_prefix'] . "images ORDER BY image_id DESC LIMIT 1");

    $fila = mysqli_fetch_row($consulta);
	
	$ultima_imagen=$fila[0];

	if($_GET['image_id']<=$ultima_imagen){
	
		poner_menu();
		
		mysqli_query($GLOBALS['conexion'],
		'UPDATE 4images_images SET image_hits=image_hits+1 WHERE image_id='.$_GET['image_id']);
		
		$consulta =mysqli_query($GLOBALS['conexion'], '
		
		SELECT cat_id,cat_name FROM '.$GLOBALS['table_prefix'].'categories where cat_id=(
		
		SELECT cat_id FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$_GET['image_id'].')');
		
		$categoria = mysqli_fetch_row($consulta);
		
		print '<br/><br/>
		
		<div style="float:left;padding-left:20px;">
			<a style="color:#562676;font-size:25px;font-weight:bold;"
			href="categories.php?cat_id='.$categoria[0].'">'.$categoria[1].'</a>
		</div>
		
		<div style="float:left;margin-left:10%;">';
		
		$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_name,cat_id,image_media_file,image_description,image_id FROM '.$GLOBALS['table_prefix'].'images
		WHERE image_id='.$_GET['image_id']);
		
		$recuento = mysqli_fetch_row($consulta);
		
		$categoria=$recuento[1];
		$imagen=$recuento[2];
		$image_id=$recuento[4];
		
		print '<h1 style="color:#116C5D;">'.$recuento[0].'</h1>
		
		<div class="container">
		
		<img id='.$image_id.' alt="'.$recuento[0].'" src="data/media/'.$categoria.'/'.$imagen.'" class="image">
		
		<div class="overlay">';
		
		if(!empty($recuento[3])){
			print '<h3 style="font-size:20px;margin-top:10px;text-align:center;background-color:#008CBA;color:#ffffff;font-weight:bold;">'.$recuento[3].'</h3>';
		}
	
		print '
		</div>
	
		</div>';
	
		$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_hits,image_downloads FROM '.$GLOBALS['table_prefix'].'images
			WHERE image_id='.$_GET['image_id']);
	
			$fila = mysqli_fetch_row($consulta);
	
		print '<div style="margin-left:-20px;" class="table-responsive-xs">
	
		<table style="border:none;margin:auto;" class="table">
			<tr style="border:none;">
				<td style="border:none;">
					<img style="height:30px;width:30px;"  src="img/view.png"/>
					<span style="font-size:14px;color:blue;">'.$fila[0].'</span>
				</td>
		
				<td style="border:none;">
		
					<img style="height:30px;width:30px;"  src="img/top.png"/>
					<span style="font-size:14px;color:blue;">8.5</span>
				</td>
		
				<td style="border:none;">
				
					<img style="height:30px;width:30px;"  src="img/download.png"/>
					<span id="descargas" style="font-size:14px;color:blue;">'.$fila[1].'</span>
				</td>
			</tr>
		</table>';
	
		$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT user_invisible,user_name FROM '.$GLOBALS['table_prefix'].'users 
		WHERE user_id=(SELECT user_id FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$_GET['image_id'].')');
	
		$fila = mysqli_fetch_row($consulta);
			
		if($fila[0]==0){
			print '<div style="float:left;padding-left:55px;"><img style="width:40px;height:40px;" src="img/user.png"/><span style="font-size:15px"> '.$fila[1].'</span></div>';
		}
		
		if(file_exists('data/media/'.$categoria.'/'.$imagen)){
			
			$pesoimagen=truncateFloat(truncateFloat(filesize ( 'data/media/'.$categoria.'/'.$imagen)/1024,2)/1024,2);
		
			if($pesoimagen!=0){
				print '<div style="float:left;padding-bottom:40px;padding-left:10px;"><img style="width:40px;height:40px;" src="img/size.png"/><span style="font-size:15px;"> '.$pesoimagen.'</span></div>';
			}
		}
				
		if($_GET['image_id']>1){
	
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_media_file FROM '.$GLOBALS['table_prefix'].'images
			WHERE image_id='.$_GET['image_id'].'-1');
			
			$recuento = mysqli_fetch_row($consulta);
			
			print '<div style="float:left;padding-left:30px;">
			<a style="text-decoration:none;" href="details.php?image_id='.(--$image_id).'" ><img style="height:40px;width:40px;" src="img/back.png"/>
			<img style="margin-left:10px;height:50px;width:50px;" src="data/media/'.$categoria.'/'.$recuento[0].'"/></a>
			</div>';
		}	
	
		$image_id++;
	
		$icono="fav.ico";
	
		$like="";
	
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
		$GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=".$_GET['image_id']."
		AND user_id=" . $_COOKIE['4images_userid'] );
		
		$fila = mysqli_fetch_row($consulta);
			
		if($fila[0]==1){
			$icono="fav_2.ico";
		}
			
		if($_COOKIE['4images_userid']>0){
			$like='<div style="float:left;padding-left:40px;">
			<form id="frmajax" method="post">
				<a onclick="favorito('.$_GET['image_id'].')"><img style="height:40px;width:40px;" src="img/'.$icono.'" id="Imagen '.$_GET['image_id'].'"/></a>
			</form></div>';
		}
	
		if($like!=""){
			print $like;
		}
	
		print '<div style="float:left;padding-left:40px;">
	
		<div style="float:left;padding-right:40px;">
			<a onclick="fullwin('.$_GET['image_id'].');">
				<img style="height:40px;width:40px;" src="img/full_screen.png">
			</a>
		</div>
		
			<div style="float:left;">
				<form id="frmdownload" method="post">
				<a onclick="descarga('.$_GET['image_id'].')" href="data/media/'.$categoria.'/'.$imagen.'" download><img style="height:40px;width:40px;" src="img/download.png"/></a>
			</form>
		</div>';
	
		if($_GET['image_id']<$ultima_imagen){
		
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_media_file FROM '.$GLOBALS['table_prefix'].'images
			WHERE image_id='.$_GET['image_id'].'+1');
			
			$recuento = mysqli_fetch_row($consulta);
		
			print '
			<div style="float:left;padding-left:40px;">
				<a style="text-decoration:none;" href="details.php?image_id='.(++$_GET['image_id']).'" ><img style="height:50px;width:50px;" src="data/media/'.$categoria.'/'.$recuento[0].'"/>
			<img style="margin-left:10px;height:40px;width:40px;" src="img/next.png"/></a></div>';
		}	
	
		print'</div>
		<div style="float:left;width:100%;margin:auto;padding-left:60px;">';
	
		print '
		<hr/>
		<div style="float:left;margin:auto;width:100%;">';
	
		$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_allow_comments FROM '.$GLOBALS['table_prefix']."images
			WHERE image_id='".--$_GET['image_id']."'");
			
		$comentario = mysqli_fetch_row($consulta);
			
		if($comentario[0]==1){
			
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT COUNT(comment_id) FROM '.$GLOBALS['table_prefix']."comments
			WHERE image_id='".$_GET['image_id']."'");
			
			$recuento = mysqli_fetch_row($consulta);
			
			if($recuento[0]>0){
							
				print '
				<table style="margin:auto;text-align:center;" class="table" >
					<tr style="font-size:20px;">
						<th>
						</th>
						<th>
						</th>
					</tr>';
					
				$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT comment_headline,comment_text FROM '.$GLOBALS['table_prefix']."comments
				WHERE image_id='".$_GET['image_id']."'");
			
				while($fila = mysqli_fetch_row($consulta)){
					print '
					<tr>
						<td style="font-size:23px;">'.$fila[0].'</td>
						<td style="font-size:23px;">'.$fila[1].'</td>
					</tr>';
				}
				
				mysqli_close($GLOBALS['conexion']);
				print '</table><hr/>';
			}
			
			if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>0){

				print '
				
				</div>
			
				<form method="post" action="'.$_SERVER['PHP_SELF'].'?image_id='.$_GET['image_id'].'">
					<p><img style="height:100px;width:100px;" src="img/comment.png"/></p>
					<p><input type="text" name="asunto" placeholder="'.ver_dato('asunto', $GLOBALS['idioma']).'" /></p>
					<p><img style="height:100px;width:100px;" src="img/coment.png"/></p>
					<p><textarea placeholder="'.ver_dato('msg', $GLOBALS['idioma']).'" name="mensaje"></textarea></p>
					<p><img src="captcha/captcha.php" id="captcha" />
					<a  class="texto nota" href="#" onclick="'."
									document.getElementById('captcha').src='captcha/captcha.php?'+
									Math.random();
									document.getElementById('captcha-form').focus();\"
									id=\"change-image\"><img alt=\"reload\" class=\"icono2\"
									src=\"img/reload.png\"/></a></p>".'
					<p>
				
					<input type="text" title="captcha" required  id="validcaptcha"
						name="captcha" size="30" value="" class="input" id="captcha_input"
						placeholder="' . ver_dato('captcha', $GLOBALS['idioma']) . '"/></p>
					<div style="margin-top:-20px;padding-bottom:20px;"><input name="comentario" value="'.ver_dato('submit', $GLOBALS['idioma']).'" type="submit" /></div>
				</form>
			
				</div>
			
				</div>';
			}
		}
	
		footer();
	}

	else{
		$_SESSION['pagina']="details.php?image_id=".$ultima_imagen;
		redireccionar('details.php?image_id='.$ultima_imagen);
	}
	
}

?>