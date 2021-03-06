<?php

session_start();

include('config.php');

include ('includes/funciones.php');

$_SESSION['track']=true;

$_SESSION['pagina'] = 'details.php';

$_SESSION['imagen']= $_GET['image_id'];

$logueado=logueado();

if(!isset($_SESSION['contar'])){
	$_SESSION['contar']=true;
}

if(!acceso_imagen($_GET['image_id'],$logueado)||isset($_GET['mode']) || preg_match("/\brder\b/i",$_GET['image_id'])
|| preg_match("/\nion\b/i",$_GET['image_id'])|| preg_match("/\elect\b/i",$_GET['image_id'])){
	redireccionar('register.php');
}

track();

if(isset($_POST['cambiar_categoria'])){
		
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'],'SELECT image_media_file,cat_id FROM '.$GLOBALS['table_prefix']."images
	WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid']."'");
	
	$fila = mysqli_fetch_row($consulta);
	
	if($fila[1]!=$_POST['cat_selected']){
		chmod('data/media/'.$fila[1].'/'.$fila[0], 0777);
		rename('data/media/'.$fila[1].'/'.$fila[0],'data/media/'.$_POST['cat_selected'].'/'.$fila[0]);
	}
	
	mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."images SET cat_id='".$_POST['cat_selected']."' 
	WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid']."'");
	
	mysqli_close($GLOBALS['conexion']);
	 
}

$_SESSION['pagina'] = 'details.php';

$ultima_imagen = 0;

if (!isset($_SESSION['insert'])) {
    $_SESSION['insert'] = false;
}

if(isset($_POST['fmr_delete_comment'])){
	
	if($_POST['delete_comment']=="yes"){
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'DELETE FROM ' . $GLOBALS['table_prefix'] .
		"comments WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid'].
		"' AND comment_id='".$_SESSION['del_comment']."'");

		mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix'] .
		"SET user_comments= user_comments-1 WHERE user_id='".$_COOKIE['4images_userid']."'");
			
		mysqli_close($GLOBALS['conexion']);
				
	}
	
	unset($_SESSION['del_comment']);
}

if(isset($_POST['comentar']) && isset($_POST['edit_comment_asunto']) && isset($_POST['edit_comment']) 
	&& !empty($_POST['edit_comment_asunto']) && !empty($_POST['edit_comment'])){

    $lista_negra = obtener_lista_negra();
        
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
			
	$consulta = mysqli_query($GLOBALS['conexion'],'SELECT comment_headline,comment_text FROM ' . $GLOBALS['table_prefix'] ."comments WHERE image_id='".$_GET['image_id']."'");
		
	$resultado = mysqli_fetch_row($consulta);
		
	mysqli_close($GLOBALS['conexion']);
	
	$_POST['edit_comment_asunto']=trim($_POST['edit_comment_asunto']);
	
	$_POST['edit_comment']=trim($_POST['edit_comment']);
	
	$_POST['edit_comment']= wordwrap($_POST['edit_comment'], 22, "<br/>" ,true);

    if ( ($resultado[0]!=$_POST['edit_comment_asunto'] || $resultado[1]!= $_POST['edit_comment'] ) &&
		comprobar_si_es_valido($_POST['edit_comment_asunto'], $lista_negra)
        && comprobar_si_es_valido($_POST['edit_comment'], $lista_negra)) {
	
				$usuarios=sacar_usuarios($_POST['edit_comment']);
			
				$size_usuarios=count($usuarios);

				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
				$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
			
				$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE ' . $GLOBALS['table_prefix'] .
                "comments SET comment_headline='" . $_POST['edit_comment_asunto'] . "',comment_text='" . $_POST['edit_comment'] . "'
					WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid']."' AND comment_id='".$_SESSION['edit_comment']."'");

					for($i=0;$i<$size_usuarios;$i++){

						$consulta=mysqli_query($GLOBALS['conexion'],'SELECT user_id,nacionalidad FROM '. $GLOBALS['table_prefix'] .
						"users WHERE user_name='". $usuarios[$i]."'");
	
						$user_id = mysqli_fetch_row($consulta);
	
						if((int)$user_id[0]>0){
						
							$consulta2=mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '. $GLOBALS['table_prefix'] .
							"users WHERE user_id='". $_COOKIE['4images_userid']."'");
							
							$remitente = mysqli_fetch_row($consulta2);
							
							mysqli_query($GLOBALS['conexion'],
							"INSERT INTO mensajes(remitente,destinatario,asunto,mensaje,leido,oculto)
			
							VALUES( '0','".$user_id[0]."','".ucwords($remitente[0]).' '.
							ver_dato('mencion', $user_id[1])."','<a href=\"../details.php?image_id=".$_GET['image_id'].
							"\"><img class=\"icono\" src=\"../img/view.png\" /></a>','0','0')");
			
						}
				
					}
				
			mysqli_close($GLOBALS['conexion']);
			
			print '<script>location.href="action.php?image_id=\''.$_GET['image_id'].'\'&del=\'false\'";</script>';

		}
	
}

if (isset($_GET['image_id'])) {

	$visibilidad_comentario=saber_visibilidad_comentario($_GET['image_id']);

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

	$consulta=mysqli_query($GLOBALS['conexion'],'SELECT visibilidad,user_id FROM '.$GLOBALS['table_prefix']."images
	WHERE image_id='" . $_GET['image_id']."'");
	
	$visibilidad = mysqli_fetch_row($consulta);

	mysqli_close($GLOBALS['conexion']);

	if( $visibilidad[0]==3 ){
		redireccionar('index.php');
	}
	
	if($visibilidad[0]==2 && !$logueado){
		redireccionar('register.php');
	}

	$subida_por_mi=subida_por_mi($_GET['image_id']);

	$_GET['image_id']=(int)$_GET['image_id'];

	if($subida_por_mi && visible($_GET['image_id'])==0 || ($_GET['image_id']>0 && visible($_GET['image_id'])) == 1){

		if (isset($_COOKIE['4images_userid'])) {

			if (isset($_POST['renombrar']) && isset($_GET['image_id']) && (int) $_GET['image_id'] > 0) {

				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
                $GLOBALS['db_password'], $GLOBALS['db_name'])
				or die("No se pudo conectar a la base de datos");

				mysqli_query($GLOBALS['conexion'],
                'UPDATE ' . $GLOBALS['table_prefix'] .
                "images SET image_name='" . $_POST['nuevo_nombre'] . "'
				WHERE image_id='" . $_GET['image_id'] . "'");

				mysqli_close($GLOBALS['conexion']);
			}

			$_COOKIE['4images_userid'] = (int) $_COOKIE['4images_userid'];

			if ($_COOKIE['4images_userid'] > 0) {
				$GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);
			}	
    }

	if (isset($_POST['comentario']) && isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>0){
	
		$_POST['mensaje']=trim($_POST['mensaje']);
		
		$_POST['asunto']=trim($_POST['asunto']);

		if(!empty($_POST['mensaje']) && !empty($_POST['asunto']) && 
		strlen($_POST['mensaje'])>0 && strlen($_POST['asunto'])>0 &&
		!empty($_POST['captcha']) && (trim(strtolower($_POST['captcha'])) == $_SESSION['captcha'])) {

        $lista_negra = obtener_lista_negra();

        if (comprobar_si_es_valido($_POST['mensaje'], $lista_negra)
            && comprobar_si_es_valido($_POST['asunto'], $lista_negra)) {

			$usuarios=sacar_usuarios($_POST['mensaje']);
			
			$size_usuarios=count($usuarios);
	
			if($size_usuarios>0){
							
				$_POST['mensaje']=str_replace("[user]","@",$_POST['mensaje']);
		
				$_POST['mensaje']=str_replace("[/user]","",$_POST['mensaje']);
				
			}

			$_POST['mensaje']= wordwrap($_POST['mensaje'], 22, "<br/>" ,true);

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
			$GLOBALS['db_password'], $GLOBALS['db_name'])
            or die("No se pudo conectar a la base de datos");

            mysqli_query($GLOBALS['conexion'],
            'INSERT INTO ' . $GLOBALS['table_prefix'] .
            "comments (image_id,user_id,comment_headline,comment_text,comment_ip,comment_date,visible)
			VALUES('" . $_GET['image_id'] . "','" . $_COOKIE['4images_userid'] . "','" . $_POST['asunto'] . "','" .
            $_POST['mensaje'] . "','" . $_SERVER['REMOTE_ADDR'] . "','" . date('Y') . '/' . date('m') . '/' . date('d') ."','".$_POST['visibilidad']."')");

			mysqli_query($GLOBALS['conexion'],
            'UPDATE '.$GLOBALS['table_prefix'] .
            "SET user_comments= user_comments+1 WHERE user_id='".$_COOKIE['4images_userid']."'");

			if($logueado){
				
				for($i=0;$i<$size_usuarios;$i++){
					
					$consulta=mysqli_query($GLOBALS['conexion'],'SELECT user_id,nacionalidad FROM '. $GLOBALS['table_prefix'] .
					"users WHERE user_name='". $usuarios[$i]."'");

					$user_id = mysqli_fetch_row($consulta);
							
					if((int)$user_id[0]>0){
					
						$consulta2=mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '. $GLOBALS['table_prefix'] .
						"users WHERE user_id='". $_COOKIE['4images_userid']."'");
						
						$remitente = mysqli_fetch_row($consulta2);
						
						mysqli_query($GLOBALS['conexion'],
						"INSERT INTO mensajes(remitente,destinatario,asunto,mensaje,leido,oculto)
		
						VALUES( '0','".$user_id[0]."','".ucwords($remitente[0]).' '.
						ver_dato('mencion', $user_id[1])."','<a href=\"../details.php?image_id=".$_GET['image_id'].
						"\"><img class=\"icono\" src=\"../img/view.png\" /></a>','0','0')");
		
					}
				
				}
								
			}

            mysqli_close($GLOBALS['conexion']);
        }

    }
    
}

    unset($_SESSION['captcha']);

    $_SESSION['pagina'] = "details.php?image_id=" . $_GET['image_id'];

    cabecera("",false,true);

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_id FROM ' .
    $GLOBALS['table_prefix'] . "images ORDER BY image_id DESC LIMIT 1");

    $fila = mysqli_fetch_row($consulta);

	$ultima_imagen = $fila[0];
	
	mysqli_close($GLOBALS['conexion']);

    if ($_GET['image_id'] <= $ultima_imagen) {

        poner_menu();

		if(!isset($_SESSION['del_comment']) && !isset($_SESSION['edit_comment']) && $_SESSION['contar']){
		
			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name'])
			or die("No se pudo conectar a la base de datos");
			
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_id FROM ' .
			$GLOBALS['table_prefix'] . "images ORDER BY image_id DESC LIMIT 1");
	
			mysqli_query($GLOBALS['conexion'],
			'UPDATE 4images_images SET image_hits=image_hits+1 WHERE image_id=' . $_GET['image_id']);
			
			mysqli_close($GLOBALS['conexion']);
		
		}
	
		$_SESSION['contar']=true;
	
		$image_name="";
	
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");

        $consulta = mysqli_query($GLOBALS['conexion'], '

		SELECT cat_id,cat_name FROM ' . $GLOBALS['table_prefix'] . 'categories where cat_id=(

		SELECT cat_id FROM ' . $GLOBALS['table_prefix'] . 'images WHERE image_id=' . $_GET['image_id'] . ')');

        $categoria = mysqli_fetch_row($consulta);

        print '<br/><br/>
		
		<div style="margin:auto;">

		<div style="float:left;margin:auto;">';
	
	    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
		
			if($logueado){
				
				print '
				
				<a style="padding-left:40px;float:right;font-weight:bold;font-size:10px;padding-bottom:30px;"
				href="upload_images/index.php?cat='.$categoria[0].'">
	
					<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/upload.png"/>
			
				</a>';
	
			}
			
			print '<a style="padding-left:140px;color:#562676;font-size:30px;font-weight:bold;"
			href="categories.php?cat_id=' . $categoria[0] . '">' . $categoria[1] . '</a>
		
		</div>

		<div style="float:left;width:100%;">';
		
        $consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_name,cat_id,image_media_file,image_description,image_id FROM ' . $GLOBALS['table_prefix'] . 'images
		WHERE image_id=' . $_GET['image_id']);

        $recuento = mysqli_fetch_row($consulta);
		$image_name=$recuento[0];
        $categoria = $recuento[1];

        print '<h1 style="color:#116C5D;">' . $recuento[0] . '</h1>

		<div style="background-color: rgba(255, 255, 255, 0);margin-left:-15px;" class="container">

			<img  class="img-fluid rounded"   alt="' . $recuento[0] . '" src="data/media/' . $recuento[1] . '/' . $recuento[2] . '" />

			<div style="background-color: rgba(255, 255, 255, 0);margin-bottom: -17px;
			
			margin-right: -17px; max-height: 505.75px;overflow: hidden;" class="overlay scrollbar-vista ">';

        if (!empty($recuento[3])) {
			
            print '<div style="height:350px;margin:auto;" class="transparente">
			
					<h2 style="width:70%;font-size:25px;margin:auto;padding-bottom:10px;
					margin:auto;background-color:#ffffff;color:blue;" class="texto">'
					 . $recuento[3] . '</h2>
				
				</div>';
        }

    print '
		</div>

	</div>';

	mysqli_close($GLOBALS['conexion']);	

    print '<hr/>
    
    <div class="float:left;">';
		
	if($logueado){
	
	$estrellas=saber_calificacion($_COOKIE['4images_userid'],$_GET['image_id']);

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	        $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_hits,image_downloads FROM ' . $GLOBALS['table_prefix'] . 'images
			WHERE image_id=' . $_GET['image_id']);

    $fila = mysqli_fetch_row($consulta);
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT CAST(AVG(Calificacion) AS DECIMAL(10,0)) AS Calificacion FROM ' . $GLOBALS['table_prefix'] . "usersraters WHERE Imagen='".$_GET['image_id']."'");
	
	$media = mysqli_fetch_row($consulta);
	
	if($estrellas==0){
		$estrellas='';
	}

	print '<div style="float:left;margin-top:-20px;" class="rating-wrapper" id="rating">

				<div class="flotar_izquierda">
			
					<label  id="rate-string">'.$estrellas.'</label>
			
					<ul>
					<li class="r1 star"></li>
					<li class="r2 star"></li>
					<li class="r3 star"></li>
					<li class="r4 star"></li>
					<li class="r5 star"></li>
					</ul>
					
				</div> 
				
				<div class="flotar_izquierda">
				
						<h3 style="margin-left:25px;margin-top:42px;" id="calificacion" >'.$estrellas.'</h3>
						
				</div>
            
				<div style="clear:both;padding-bottom:10px;" class="flotar_izquierda" >

					<button style="width:40px;height:40px;" onclick="pintar(0)">
					
						<img style="margin-left:-15px;width:30px;height:30px;"  src="img/clean.png"/>
						
					</button>

					<button style="width:40px;height:40px;margin-left:10px;" onclick="limpiar_estrellas()">
					
						<img style="margin-left:-15px;width:30px;height:30px;"  src="img/reload.png"/>
						
					</button>

					<button style="margin-left:10px;width:40px;height:40px;" onclick="calificar()">
					
						<img style="margin-left:-15px;width:30px;height:30px;"  src="img/rate.png"/>
						
					</button>

				</div>

			</div>
				
					<img alt="hits" style="height:30px;width:30px;margin-top"  src="img/view.png" />
					
					<span style="font-size:14px;color:blue;padding-right:20px;">' . $fila[0] . '</span>
		
					<img alt="top images" style="height:30px;width:30px;" src="img/top.png" />
					
					<span id="media" style="font-size:14px;color:blue;padding-right:20px;">'.(float)$media[0].'</span>
				
					<img alt="download" style="height:30px;width:30px;"  src="img/download.png"/>
					
					<span id="descargas" style="font-size:14px;color:blue;padding-right:20px;">' . $fila[1] . '</span>';

       $consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT user_invisible,user_name FROM ' . $GLOBALS['table_prefix'] . 'users
		WHERE user_id=(SELECT user_id FROM ' . $GLOBALS['table_prefix'] . 'images WHERE image_id=' . $_GET['image_id'] . ')');

       $fila = mysqli_fetch_row($consulta);
		
		if ($fila[0] == 0) {

			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT avatar FROM ' . $GLOBALS['table_prefix'] . "users WHERE user_name='" . $fila[1] . "'");
		
			$avatar = mysqli_fetch_row($consulta);
			
			$avatar = trim($avatar[0]);
		
			if ($avatar != 'nofoto.jpg' && !empty($avatar)) {
				$imagen_usuario = 'avatars/' . $avatar;
			}
           
			else {
				$imagen_usuario = 'img/nofoto.png';
           }
		
           print '<a title="'.$fila[1]. '" >
           
					<img alt="usuario" class="imgRedonda" style="margin-top:20px;padding-left:10px;width:40px;height:40px;" 
					src="' . $imagen_usuario . '"/>
			
			</a>';
		
       }
		
       $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_media_file FROM ' . $GLOBALS['table_prefix'] . "images WHERE image_id='" . $_GET['image_id'] . "'");
		
       $result = mysqli_fetch_row($consulta);
        
       $imagen=$result[0];  
          
		mysqli_close($GLOBALS['conexion']);

	    print '<div style="float:left;clear:both;border-style: dashed; border-color: blue;margin-left:100px;padding-top:20px;margin-top:20px;
		padding-left:20px;padding-right:20px;">
		
			<div style="float:left;">
			
				<a title="'.ver_dato('full_screen', $GLOBALS['idioma']). '" onclick="fullwin(' . $_GET['image_id'] . ');">
				
					<img style="margin-left:5px;" alt="full screen" class="iconos" src="img/full_screen.png">
				
				</a>
				
			</div>
				
			<div style="float:left;">
			
				<form id="frmdownload" method="post">
			
					<a onclick="descarga(' . $_GET['image_id'] . ')" href="data/media/' . $categoria . '/' . $imagen . '" download>
					
						<img alt="download" style="height:40px;width:40px;margin-left:10px;" src="img/download.png"/>
					
					</a>
			
				</form>
				
			</div>';

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");

		if(isset($_COOKIE['4images_userid']) && !empty($_COOKIE['4images_userid']) 
			&& $_COOKIE['4images_userid'] > 0) {
		
			$icono = "fav.ico";
		
			$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
			$GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=" . $_GET['image_id'] . "
			AND user_id=" . $_COOKIE['4images_userid']);
		
			$fila = mysqli_fetch_row($consulta);
		
			if ($fila[0] == 1) {
				$icono = "fav_2.ico";
			}
		
			if($icono=="fav_2.ico"){
				$titulo="img_fav";
			}
			
			else{
				$titulo="like";
			}
				
			print '<div style="float:left;">
					<a title="'.ver_dato($titulo, $GLOBALS['idioma']). '" id="frmajax" 
					onclick="favorito(' . $_GET['image_id'] . ')">
					
						<img style="margin-left:10px;" id="' . $_GET['image_id'] . '" 
						alt="favorite" class="iconos" src="img/' . $icono . '" />
					</a></div>';
		
		}
		
		mysqli_close($GLOBALS['conexion']);
			
		print '</div>';
		
	}

	$visibilidad_comentario=saber_visibilidad_comentario($_GET['image_id']);

	print '<div style="float:right;margin-bottom:40px;margin-top:21px;">';

	if($logueado && $visibilidad_comentario<3 || $visibilidad_comentario==1){
	
		print '	<div style="float:right;margin-left:10px;border-style: dashed; border-color: blue;
		padding-bottom:10px;padding:20px;">
		
			<a title="'. ver_dato('comment', $GLOBALS['idioma']) . '" data-toggle="modal" data-target="#commentModal">
			
				<img class="iconos" style="margin-left:5px;margin-right:10px;" src="img/coment.png" alt="' . ver_dato('comment', $GLOBALS['idioma']) . '"/>
				
			</a>';
	}

	if($logueado && $subida_por_mi || admin($_COOKIE['4images_userid'])){
	
		$icono2='hide.png';

		$accion='change_view_o';
	
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
				
		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_active,cat_id,image_media_file FROM ' .
		$GLOBALS['table_prefix'] . "images WHERE image_id='".$_GET['image_id']."'" );
		
		$fila = mysqli_fetch_row($consulta);
		
		if((int)$fila[0]==1){
			$icono2="view.png";
			$accion='change_view_v';
		}
		
		$cat_id=$fila[1];
		
		$file=$fila[2];
		
		print '<a title="'. ver_dato($accion, $GLOBALS['idioma']) . '" id="frm_img_'.$_GET['image_id'].'"
				onclick="ocultar_img('.$_GET['image_id'].')">
					<img alt="'. ver_dato('change_view', $GLOBALS['idioma']) . '" 
					alt="IMG_'.$_GET['image_id'].'"  id="IMG_'.$_GET['image_id'].'" class="iconos" src="img/'.$icono2.'"/>
				</a>';
		
		
		mysqli_close($GLOBALS['conexion']);
	
		print '<a title="' . ver_dato('rename', $GLOBALS['idioma']) . '" data-toggle="modal" data-target="#renameModal">
			
					<img class="iconos" style="margin-left:5px;" src="img/rename.png" alt="' . ver_dato('rename', $GLOBALS['idioma']) . '"/>
				
				</a>
			
				<a title="'. ver_dato('del_img', $GLOBALS['idioma']) . '"  
			
				href="delete.php?image_id=' . $_GET['image_id'] . "&cat_id=" . $categoria . "&file=" . $imagen . '">
				
					<img class="iconos" style="margin-left:5px;" src="img/delete.ico" alt="' . ver_dato('del_img', $GLOBALS['idioma']) . '"/>
				
				</a>
			
				<a title="'. ver_dato('change_cat', $GLOBALS['idioma']) . '" data-toggle="modal" data-target="#changecatModal">
			
					<img class="iconos" style="margin-left:5px;margin-right:10px;" src="img/tag_2.png" alt="' . ver_dato('change_cat', $GLOBALS['idioma']) . '"/>
				
				</a>
						
			<div class="modal fade transparente" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			
				<div class="modal-dialog modal-dialog-centered transparente" role="document">
			
					<div class="modal-content ">
			
						<div class="modal-header ">

							<h2 style="padding-right:10px;" class="modal-title" id="exampleModalLabel">'
								. ver_dato('rename', $GLOBALS['idioma']) . 
							 '</h2>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							
								<span aria-hidden="true">&times;</span>

							</button>
							
						</div>

					<div class="modal-body">

						<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">

							<input name="nuevo_nombre" class="button" style="padding-top:12px;" type="text" value="'.$image_name.'" placeholder="' . ver_dato('new_name', $GLOBALS['idioma']) . '"/>

							<input name="renombrar" class="negrita" style="margin-top:20px;" type="submit" value="' . ver_dato('rename', $GLOBALS['idioma']) . '" />

						</form>

					</div>

				</div>
		</div>
		
	</div>

	<div class="modal fade transparente" id="changecatModal" tabindex="-1" role="dialog" aria-labelledby="cat_changeModalLabel" aria-hidden="true">
	
		<div class="modal-dialog modal-dialog-centered transparente" role="document">
		
			<div class="modal-content ">
			
				<div class="modal-header ">

					<h2 style="padding-right:10px;" class="modal-title" id="cat_changeModalLabel">'
						. ver_dato('change_cat', $GLOBALS['idioma']) .
					'</h2>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>
					
				</div>

				<div class="modal-body">

					<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">';
					
						print '<select name="cat_selected" style="font-size:20px;">';
					
						ver_categorias($categoria);
				
						print '</select>
			
						<input class="negrita" name="cambiar_categoria" style="margin-top:20px;" value="' . ver_dato('submit', $GLOBALS['idioma']) . '" type="submit"/>
				
					</form>

				</div>

			</div>
		
		</div>
	
	</div>';
	
	}
		
	else{
		print '</div>';
	}	
	

	print '</div>';

	if($logueado && $visibilidad_comentario<3 || $visibilidad_comentario==1){
	
		print '
			<div  style=" overflow: scroll;" class="modal fade transparente" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
			
				<div class="modal-dialog modal-dialog-centered transparente" role="document">
		
					<div class="modal-content ">
			
						<div class="modal-header ">

							<h2 style="padding-right:10px;" class="modal-title" id="commentModalLabel">'
								. ver_dato('comentar', $GLOBALS['idioma']) .
							'</h2>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							
								<span aria-hidden="true">&times;</span>

							</button>
							
						</div>

						<div class="modal-body">
										
							<form action="'.$_SERVER['PHP_SELF'].'?image_id='. $_GET['image_id'].'" method="post">
							
								<div style="float:left;margin:auto;" >
								
									<a  title="' . ver_dato('comment', $GLOBALS['idioma']) . '">
										<img alt="asunto del comentario" style="height:100px;width:100px;margin:auto;" src="img/comment.png"/>
										
									</a>
			
								
									<p class="espacio_arriba">
									
										<input type="text" style="width:300px;" name="asunto" placeholder="' . 
											ver_dato('asunto', $GLOBALS['idioma']) .'" />
											
									</p>
								
									<p>
									
										<a  title="' . ver_dato('msg', $GLOBALS['idioma']) . '">
										
											<img alt="comentario" style="height:100px;width:100px;" src="img/coment.png"/>
										</a>
										
									</p>
								
									<p>
									
										<div style="float:left;height:60px;padding-bottom:100px;">';
										
										if($logueado){
											
											print '
												<a  title="' . ver_dato('mention', $GLOBALS['idioma']) . '" style="padding-left:10px;" data-toggle="modal" data-target="#mencion">
													
													<img class="icono" src="img/mention.png" />
												
												</a>';
												
										}
											
											print '<a title="URL" style="padding-left:10px;" data-toggle="modal" data-target="#url">
												
												<img class="icono" src="img/url.png" />
												
											</a>
											
											<a title="Emoji" style="padding-left:10px;" data-toggle="modal" data-target="#emojis">
												
												<img class="icono" src="img/emoji.png">
												
											</a>
											
											
											<a title="Limpiar Comentario" style="padding-left:10px;padding-right:10px;" onclick="limpiar_emoji(\'mensaje\')" >
												
												<img class="icono" src="img/clean.png">
												
											</a>
											
										</div>
									
									</p>

									<p>
	
										<textarea style="width:300px;" id="mensaje"
										name="mensaje">
										
										</textarea>
										
										<script>
											document.getElementById("mensaje").textContent = "";
										</script>
										
									</p>
								
									<p>
								
										<a title="' . ver_dato('visibilidad', $GLOBALS['idioma']) . '" >
											<img alt="title="' . ver_dato('visibilidad', $GLOBALS['idioma']) . '"" src="img/view.png" class="icono" />
										</a> 
										
										<h2>'.ver_dato('visibilidad', $GLOBALS['idioma']).'</h2>
										
										<select style="font-size:25px;width:300px;" name="visibilidad">';
											
											if($logueado){
												print '<option value="0" selected>'.ver_dato('solo_users', $GLOBALS['idioma']).'</option>';
											}
											
											else{
												print '<option value="1" >'.ver_dato('publica', $GLOBALS['idioma']).'</option>';	
											}
										
										print '</select>
									
									</p>
								
									<p>
									
										<a title="' . ver_dato('captcha', $GLOBALS['idioma']) . '" >
											<img class="rounded" alt="captcha" src="captcha/captcha.php" id="captcha" />
										</a>
									
										<a title="' . ver_dato('reload_captcha', $GLOBALS['idioma']) . '"
										class="texto nota" href="#" onclick="' . "
													document.getElementById('captcha').src='captcha/captcha.php?'+
													Math.random();
													document.getElementById('captcha-form').focus();\"
													id=\"change-image\">
													
													<img style=\"margin-left:-30px;\" alt=\"reload\" class=\"icono\"
													src=\"img/reload.png\"/>
										</a>
									
									</p>" . '
								
									<p>

										<input style="width:300px;" type="text" title="captcha" required  id="validcaptcha"
										name="captcha" size="30" value="" class="input" id="captcha_input"
										placeholder="' . ver_dato('captcha', $GLOBALS['idioma']) . '"/>
										
									</p>

									<div style="float:left;padding-bottom:30px;">

										<input class="negrita" style="width:300px;font-size:25px;margin-left:3px;" type="submit" title="' . ver_dato('comentar', $GLOBALS['idioma']) . '" name="comentario" value="' . ver_dato('submit', $GLOBALS['idioma']) . '" type="submit" />
								
									</div>
							
							</form>
			
						</div>
		
					</div>
	
				</div>

			</div>
	
		</div>
	
	<div class="modal fade transparente" id="emojis"  role="dialog" aria-labelledby="urlModalLabel" aria-hidden="true">
	
		<div class="modal-dialog modal-dialog-centered transparente" role="document">
	
			<div  class="modal-content ">
		
				<div class="modal-header ">
				
					<img class="icono" alt="Emoticono" src="img/emoji.png" />
					
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>

				<div class="modal-body">
	
					<button value="§128512;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128512;</button>
					<button value="§128563;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128563;</button>
					<button value="§128564;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128564;</button>
					<button value="§128518;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128518;</button>
					<button value="§128515;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128515;</button>
					<button value="§128541;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128541;</button>
					<button value="§128522;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128522;</button>
					<button value="§128525;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128525;</button>
					<button value="§128536;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128536;</button>
					<button value="§128537;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128537;</button>
					<button value="§128538;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128538;</button>
					<button value="§128539;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128539;</button>
					<button value="§128540;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128540;</button>
					<button value="§128514;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128514;</button>
					<button value="§128545;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128545;</button>
					<button value="§128517;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128517;</button>
					<button value="§128554;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128554;</button>
					<button value="§128546;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128546;</button>
					<button value="§128531;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128531;</button>
					<button value="§128560;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128560;</button>
					<button value="§128557;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128557;</button>
					<button value="§128526;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128526;</button>
					<button value="§128519;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128519;</button>
					<button value="§128520;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128520;</button>
					<button value="§128558;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128558;</button>
					<button value="§128561;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128561;</button>
					<button value="§128562;"  style="margin:5px;" onclick="emoji(this.value,\'mensaje\')">&#128562;</button>

				</div>

			</div>

		</div>

	</div>

	<div class="modal fade transparente" id="url" tabindex="-1" role="dialog" aria-labelledby="urlModalLabel" aria-hidden="true">
		
		<div class="modal-dialog modal-dialog-centered transparente" role="document">
		
			<div class="modal-content ">
			
				<div class="modal-header ">
	
				<h2 style="padding-right:10px;" class="modal-title" id="urlModalLabel">' . ver_dato('mention', $GLOBALS['idioma']) . '</h2>
	
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
	
				</button>
				</div>
	
				<div class="modal-body">
	
					<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
	
						<p>
		
							<input id="ctr_url" type="text" placeholder="'.ver_dato('txt_url', $GLOBALS['idioma']).'"></input>
		
						</p>
	
						<button style="width:300px;" onclick="mencionar(\'mensaje\',2);" type="button" data-dismiss="modal">
					
							<span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span>
						
						</button>
	
					</form>
	
				</div>
	
			</div>
			
		</div>
	
	</div>';
	
	if($logueado){
	
		print '
		<div class="modal fade transparente" id="mencion" tabindex="-1" role="dialog" aria-labelledby="mencionModalLabel" aria-hidden="true">
			
			<div class="modal-dialog modal-dialog-centered transparente" role="document">
			
				<div class="modal-content ">
				
					<div class="modal-header ">
		
					<h2 style="padding-right:10px;" class="modal-title" id="mencionModalLabel">' . ver_dato('mention', $GLOBALS['idioma']) . '</h2>
		
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					
						<span aria-hidden="true">&times;</span>
		
					</button>
					
					</div>
		
					<div class="modal-body">
		
						<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
								
							<h2>' . ver_dato('txt_mencion', $GLOBALS['idioma']) . '</h2>';
							
							print '<p> 
										<select id="mention_users" style="font-size:20px;font-weight:bold;margin-top:40px;" name="usuarios">';
								
							$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
							
							$consulta = $mysqli->query('SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id>0 
							
							and user_id!='".$_COOKIE['4images_userid']."' ");
								
							while($fila = $consulta->fetch_row()){
									print '<option value="'.$fila[0].'">'.$fila[0].'</option>';
							}
								
							$mysqli->close();
							
							print '</option>
							
								</select>
								
							</p>
							
							<button style="width:300px;" onclick="mencionar(\'mensaje\',1)" type="button" data-dismiss="modal">
							
								<span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span>
								
							</button>
		
							</form>
		
						</div>
		
					</div>
				
				</div>
				
			</div>';
	}

	print '</div>';

}

  if ($_GET['image_id'] > 1 || $_GET['image_id'] < $ultima_imagen) {
	  
			$id_images = array();

            $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
            $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

            $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_id FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_active='1' AND cat_id='".$categoria."'");

            while ($recuento = mysqli_fetch_row($consulta)) {
                $id_images[] = $recuento[0];
            }
            
	}
	
       if ($_GET['image_id'] > 1) {

            $imagen_anterior = array_search($_GET['image_id'], $id_images);

            $imagen_anterior--;

            if ($imagen_anterior >= 0) {

                $consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT image_media_file,cat_id,image_name FROM ' . $GLOBALS['table_prefix'] . "images
				WHERE image_id='" . $id_images[$imagen_anterior] . "'");

                $recuento = mysqli_fetch_row($consulta);

                print '<div style="float:right;margin-top:40px;margin-left:-20px;padding-bottom:30px;">';

                print '					
					<a title="'.ver_dato('back_img', $GLOBALS['idioma']). '" style="text-decoration:none;"
					href="details.php?image_id=' . $id_images[$imagen_anterior] . '" >
					
						<img class="iconos" alt="go back" src="img/back_2.png" />';
												
						if($logueado){
							print '<img style="margin-left:10px;"  alt="' . $recuento[2] . '" class="icono rounded"
							src="data/media/' . $recuento[1] . '/' . $recuento[0] . '"/>';
						}
						
					print '</a>';
					
            }

        }

        if ($_GET['image_id'] < $ultima_imagen) {

            $imagen_posterior = array_search($_GET['image_id'], $id_images);

            $imagen_posterior++;

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
            $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

            $consulta2 = mysqli_query($GLOBALS['conexion'], '
			SELECT image_media_file,cat_id,image_name FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_id='" . $id_images[$imagen_posterior] . "'");

            $recuento2 = mysqli_fetch_row($consulta2);
    
            if (!empty($recuento2[0]) && !empty($recuento2[1])) {
				
                print '
					<a title="'.ver_dato('next_img', $GLOBALS['idioma']). '"
					style="text-decoration:none;" href="details.php?image_id=' . $id_images[$imagen_posterior] . '" >';
					
					if($logueado){
						
						print '
						<img  style="margin-left:20px;" alt="' . $recuento2[2] . '" class="icono rounded"
						src="data/media/' . $recuento2[1] . '/' . $recuento2[0] . '" />';
						
					}
					
					print '<img style="margin-left:10px;margin-right:20px;" alt="go next" class="iconos" src="img/next_2.png" />
						
					</a>';
            }

            print '</div>';
		
        }

		$titulo_comentario=ver_dato('comments', $GLOBALS['idioma']);

        $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
            $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

        $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_allow_comments FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_active=1 AND image_id='" . $_GET['image_id'] . "'");

        $comentario = mysqli_fetch_row($consulta);

        if ((int)$comentario[0] == 1) {
		
            $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT COUNT(comment_id) FROM ' . $GLOBALS['table_prefix'] . "comments
			WHERE image_id='" . $_GET['image_id'] . "'");

            $recuento = mysqli_fetch_row($consulta);


			$consulta2 = mysqli_query($GLOBALS['conexion'], '
			SELECT COUNT(comment_id) FROM ' . $GLOBALS['table_prefix'] . "comments
			WHERE image_id='" . $_GET['image_id'] . "' AND visible='1'");

            $recuento2 = mysqli_fetch_row($consulta2);
			
            if ($recuento[0] > 0 && $logueado || $recuento2[0]>0 ) {
			
                print '
				<div  style="float:left;clear:both;margin-top:40px; border: dashed 2px #500C9D;margin-bottom:20px;" class="demo">
		
					<h2>'.$titulo_comentario.'</h2>	
					
					<a style="cursor: pointer;" onClick="muestra_oculta(\'contenido\')" title="" class="boton_mostrar"> <img id="ver_comentario" src="img/view.png" class="icono" /></a>
				
				</div>

				<div id="contenido" style="float:left;margin-left:-60px;
				
				margin-top:20px;border-style: none!important;width:115%;"  >

					<table class="table table-responsive-xs" style="margin:auto;text-align:center;padding-right:20px;margin-bottom:20px;" >
					
						<tr style="font-size:25px;">
						
							<th class="centrar" >'.ver_dato('asunto', $GLOBALS['idioma']).'</th>
							
							<th class="centrar" >'.ver_dato('comment',$GLOBALS['idioma']).'</th>
							
						</tr>';

	            $query_user_level = mysqli_query($GLOBALS['conexion'], '
				SELECT user_level FROM ' . $GLOBALS['table_prefix'] . "users
				WHERE user_id='" . $_COOKIE['4images_userid'] . "'");

               $user_level = mysqli_fetch_row($query_user_level);
	
                $consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT comment_headline,comment_text,visible,user_id,comment_id FROM ' . $GLOBALS['table_prefix'] . "comments
				WHERE image_id='" . $_GET['image_id'] . "' order by comment_id desc");

                while ($fila = mysqli_fetch_row($consulta)) {
							
					if($logueado || $fila[2]=='1'){
						
						$fila[1] = str_replace('[URL]', '<a href="', $fila[1]);
						$fila[1] = str_replace('[/URL]', '">' . $fila[0] . '</a>', $fila[1]);
						
						print '
						<tr>
						
							<td style="font-size:25px;">' . $fila[0] . '</td>
							
							<td style="font-size:25px;">' . $fila[1];
							
							if($fila[3]==$_COOKIE['4images_userid'] || $user_level[0]==6 || $user_level[0]==9){
								
								print '
								<a onclick="accion('.$fila[4].",".$_GET['image_id'].',\'action.php\');" style="padding-left:10px;">
									<img alt="'.$fila[0].'" id="'.$fila[4].'" src="img/edit.png" class="iconos" />
								</a>
								
								<a onclick="accion('.$fila[4].",".$_GET['image_id'].',\'delete2.php\');" style="padding-left:10px;">
								
									<img style="margin-top:10px;" src="img/delete.ico" class="iconos" />
								
								</a>';
								
							}
							
							print '</td>
							
						</tr>
						
						<tr>
							<td colspan="3"></td>
						</tr>
						';
					}
                }

                mysqli_close($GLOBALS['conexion']);
				
                print '</table>
				
				<div class="modal fade transparente" id="del_comment" tabindex="-1" role="dialog" aria-labelledby="del_commentModalLabel" aria-hidden="true">
	
					<div class="modal-dialog modal-dialog-centered transparente" role="document">
	
						<div class="modal-content ">
		
							<div class="modal-header ">
			
								<img src="img/Recycle_Bin_Full.png" class="icono"/>

									<button  type="button" class="close" data-dismiss="modal" aria-label="Close">
										
										<span aria-hidden="false">×</span>

									</button>
									
							</div>

						<div class="modal-body">

						<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
						
							<input type="radio" name="delete_comment" value="yes"><img src="img/check.png" class="icono"/></input>
							
							<input type="radio" name="delete_comment" checked value="no"><img src="img/error.png" class="icono"/></input>
							
							<input class="negrita" name="fmr_delete_comment" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>
						
						</form>
		
					</div>

				</div>
		
			</div>		
				
		</div>
				
		<div class="modal fade transparente" id="edit_comment" tabindex="-1" role="dialog" aria-labelledby="edit_commentModalLabel" aria-hidden="true">
	
			<div class="modal-dialog modal-dialog-centered transparente" role="document">
	
				<div class="modal-content ">
		
					<div class="modal-header ">
			
						<h2>'.ver_dato('comment', $GLOBALS['idioma']).'</h2>
			
						<img style="padding-right:10px;" src="img/edit.png" class="icono" />

						<button   type="button" class="close" data-dismiss="modal" aria-label="Close">
			
							<span aria-hidden="true">&times;</span>

						</button>
			
					</div>

				<div class="modal-body">';

					$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
					$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
					
					$consulta = mysqli_query($GLOBALS['conexion'], '
								SELECT comment_text,comment_headline FROM '.$GLOBALS['table_prefix']."comments
								WHERE comment_id='".$_SESSION['edit_comment']."'");
							
					$id_comentario = mysqli_fetch_row($consulta);
					
					mysqli_close($GLOBALS['conexion']);	
						
					print '	<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
					
								<p style="padding-top:20px;">
								
									<input name="edit_comment_asunto" type="text" value="'.$id_comentario[1].'"></input>
								
								</p>';
								
								if($logueado){
									
									print '
									<a  title="' . ver_dato('mention', $GLOBALS['idioma']) . '" style="padding-left:10px;" data-toggle="modal" data-target="#mencion_edit">
													
										<img class="icono" src="img/mention.png" />
												
									</a>';
									
								}
								
							print '
								<a title="URL" style="padding-left:10px;" data-toggle="modal" data-target="#urledit">
												
												<img class="icono" src="img/url.png" />
												
								</a>
					
								<a  title="Emoji" data-toggle="modal" data-target="#emojis2">
									<img style="margin-top:-40px;" class="icono" src="img/emoji.png">
								</a>
								
								<a title="Limpiar Comentario"  onclick="limpiar_emoji(\'edit_comentario\')" >
									<img style="margin-top:-40px;" class="icono" src="img/clean.png">
								</a>
										
								<p style="margin-top:20px;" >
									<textarea id="edit_comentario" name="edit_comment" type="text" >'.$id_comentario[0].'</textarea>
								</p>
				
								<input style="margin-top:-20px;" class="negrita" name="comentar" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>
				
							</form>
					
						</div>

					</div>';
	
            }
				
		if(!$logueado){
						
			print '<div style="float:left;margin-top:40px;padding-bottom:40px;">
						
						<a href="register.php">
										
							<img alt="registrar" style="height:110px;width:240px;" src="img/reg-now.gif"/>
										
						</a>
										
					</div>';

		}
			
       }
		
		
		print '</div>
		
		</div>';
		
			if($logueado){
	
		print '
		<div class="modal fade transparente" id="mencion_edit" tabindex="-1" role="dialog" aria-labelledby="mencionModalLabel_edit" aria-hidden="true">
			
			<div class="modal-dialog modal-dialog-centered transparente" role="document">
			
				<div class="modal-content ">
				
					<div class="modal-header ">
		
					<h2 style="padding-right:10px;" class="modal-title" id="mencionModalLabel_edit">' . ver_dato('mention', $GLOBALS['idioma']) . '</h2>
		
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					
						<span aria-hidden="true">&times;</span>
		
					</button>
					
					</div>
		
					<div class="modal-body">
		
						<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
								
							<h2>' . ver_dato('txt_mencion', $GLOBALS['idioma']) . '</h2>';
							
							print '<p> 
										<select id="mention_users_edit" style="font-size:20px;font-weight:bold;margin-top:40px;" name="usuarios">';
								
							$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);
							
							$consulta = $mysqli->query('SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id>0 
							
							and user_id!='".$_COOKIE['4images_userid']."' ");
								
							while($fila = $consulta->fetch_row()){
									print '<option value="'.$fila[0].'">'.$fila[0].'</option>';
							}
								
							$mysqli->close();
							
							print '</option>
							
								</select>
								
							</p>
							
							<button style="width:300px;" onclick="mencionar(\'edit_comentario\',3)" type="button" data-dismiss="modal">
							
								<span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span>
								
							</button>
		
							</form>
		
						</div>
		
					</div>
				
				</div>
				
			</div>';
	}
		
		print '<div class="modal fade transparente" id="urledit" tabindex="-1" role="dialog" aria-labelledby="urlEditModalLabel" aria-hidden="true">
		
		<div class="modal-dialog modal-dialog-centered transparente" role="document">
		
			<div class="modal-content ">
			
				<div class="modal-header ">
	
				<h2 style="padding-right:10px;" class="modal-title" id="urlEditModalLabel">' . ver_dato('mention', $GLOBALS['idioma']) . '</h2>
	
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
	
				</button>
				</div>
	
				<div class="modal-body">
	
					<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
	
						<p>
		
							<input id="ctr_url_edit" type="text" placeholder="'.ver_dato('txt_url', $GLOBALS['idioma']).'"></input>
		
						</p>
	
						<button style="width:300px;" onclick="mencionar(\'edit_comentario\',4);" type="button" data-dismiss="modal">
					
							<span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span>
						
						</button>
	
					</form>
	
				</div>
	
			</div>
			
		</div>
	
	</div>
			
		<div class="modal fade transparente" id="emojis2"  role="dialog" aria-labelledby="urlModalLabel" aria-hidden="true">
	
			<div class="modal-dialog modal-dialog-centered transparente" role="document">
			
				<div  class="modal-content ">
				
					<div class="modal-header ">
						<img class="icono" alt="Emoticono" src="img/emoji.png" />
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
			
					</div>
			
					<div class="modal-body">
			
					<button value="§128512;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128512;</button>
					<button value="§128563;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128563;</button>
					<button value="§128564;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128564;</button>
					<button value="§128518;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128518;</button>
					<button value="§128515;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128515;</button>
					<button value="§128541;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128541;</button>
					<button value="§128522;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128522;</button>
					<button value="§128525;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128525;</button>
					<button value="§128536;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128536;</button>
					<button value="§128537;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128537;</button>
					<button value="§128538;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128538;</button>
					<button value="§128539;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128539;</button>
					<button value="§128540;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128540;</button>
					<button value="§128514;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128514;</button>
					<button value="§128545;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128545;</button>
					<button value="§128517;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128517;</button>
					<button value="§128554;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128554;</button>
					<button value="§128546;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128546;</button>
					<button value="§128531;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128531;</button>
					<button value="§128560;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128560;</button>
					<button value="§128557;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128557;</button>
					<button value="§128526;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128526;</button>
					<button value="§128519;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128519;</button>
					<button value="§128520;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128520;</button>
					<button value="§128558;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128558;</button>
					<button value="§128561;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128561;</button>
					<button value="§128562;"  style="margin:5px;" onclick="emoji(this.value,\'edit_comentario\')">&#128562;</button>
			
					</div>
			
				</div>
			
			</div>
			
		</div>';
			
        footer();
		
		if(isset($_SESSION['del_comment']) ){
	
			print "<script>$('#del_comment').modal('show');</script>";
		}
		
		if(isset($_SESSION['edit_comment']) ){
	
			print "<script>$('#edit_comment').modal('show');</script>";
		}

	} 
	
		else {
		
			$_SESSION['pagina'] = "details.php?image_id=" . $ultima_imagen;
        
			redireccionar('details.php?image_id=' . $ultima_imagen);
		}
	
		restablecer_pass();
	}

	else {
		redireccionar('index.php');
	}

} 

else {
    redireccionar('index.php');
}

?> 
