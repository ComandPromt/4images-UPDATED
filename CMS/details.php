<?php

session_start();

$_SESSION['track'] = true;

if(!isset($_SESSION['contar'])){
	$_SESSION['contar']=true;
}

include('config.php');

include ('includes/funciones.php');

$_SESSION['pagina'] = 'details.php';

$ultima_imagen = 0;

if (!isset($_SESSION['insert'])) {
    $_SESSION['insert'] = false;
}

if(isset($_POST['fmr_delete_comment'])){
	
	if($_POST['delete_comment']=="yes"){
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],
                'DELETE FROM ' . $GLOBALS['table_prefix'] .
                "comments WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid']."' AND comment_id='".$_SESSION['del_comment']."'");

				mysqli_close($GLOBALS['conexion']);
				
	}
	
	unset($_SESSION['del_comment']);
}

if(isset($_POST['comentar']) && isset($_POST['edit_comment_asunto']) && isset($_POST['edit_comment']) 
	&& !empty($_POST['edit_comment_asunto']) && !empty($_POST['edit_comment'])){
		
		$lista_negra = obtener_lista_negra();

        if (comprobar_si_es_valido($_POST['edit_comment_asunto'], $lista_negra)
            && comprobar_si_es_valido($_POST['edit_comment'], $lista_negra)) {
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'],
                'UPDATE ' . $GLOBALS['table_prefix'] .
                "comments SET comment_headline='" . $_POST['edit_comment_asunto'] . "',comment_text='" . $_POST['edit_comment'] . "'
				WHERE image_id='" . $_GET['image_id'] . "' AND user_id='".$_COOKIE['4images_userid']."' AND comment_id='".$_SESSION['edit_comment']."'");

				mysqli_close($GLOBALS['conexion']);
				unset($_SESSION['edit_comment']);
			}
}


if (isset($_GET['image_id']) ) {
	
$_GET['image_id']=(int)$_GET['image_id'];

	if($_GET['image_id']>0 && visible($_GET['image_id']) == 1){

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

    if (isset($_POST['comentario']) && !empty($_POST['captcha']) && (trim(strtolower($_POST['captcha'])) == $_SESSION['captcha'])) {

        $lista_negra = obtener_lista_negra();

        if (comprobar_si_es_valido($_POST['mensaje'], $lista_negra)
            && comprobar_si_es_valido($_POST['asunto'], $lista_negra)) {

			$usuario="";

			if(strpos($_POST['mensaje'],"[user]")>=0 && strpos($_POST['mensaje'],"[/user]")>0){
				
				$usuario=substr($_POST['mensaje'],strpos($_POST['mensaje'],"[user]")+6,strpos($_POST['mensaje'],"[/user]")-6);
			
				$_POST['mensaje']=str_replace("[user]","@",$_POST['mensaje']);
		
				$_POST['mensaje']=str_replace("[/user]","",$_POST['mensaje']);
	
			}		

            $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
            $GLOBALS['db_password'], $GLOBALS['db_name'])
            or die("No se pudo conectar a la base de datos");

            mysqli_query($GLOBALS['conexion'],
            'INSERT INTO ' . $GLOBALS['table_prefix'] .
            "comments (image_id,user_id,comment_headline,comment_text,comment_ip,comment_date,visible)
			VALUES('" . $_GET['image_id'] . "','" . $_COOKIE['4images_userid'] . "','" . $_POST['asunto'] . "','" .
            $_POST['mensaje'] . "','" . $_SERVER['REMOTE_ADDR'] . "','" . date('Y') . '/' . date('m') . '/' . date('d') ."','".$_POST['visibilidad']."')");

			if($usuario!=""){
				
				$consulta=mysqli_query($GLOBALS['conexion'],'SELECT user_id,nacionalidad FROM '. $GLOBALS['table_prefix'] .
				"users WHERE user_name='". $usuario."'");
				
				$user_id = mysqli_fetch_row($consulta);
						
				if((int)$user_id[0]>0){
				
				$consulta2=mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '. $GLOBALS['table_prefix'] .
				"users WHERE user_id='". $_COOKIE['4images_userid']."'");
				
				$remitente = mysqli_fetch_row($consulta2);
				
				mysqli_query($GLOBALS['conexion'],
                "INSERT INTO mensajes(remitente,destinatario,asunto,mensaje,leido,oculto)

				VALUES( '".$_COOKIE['4images_userid']."','".$user_id[0]."','".ucwords($remitente[0]).' '.
				ver_dato('mencion', $user_id[1])."','<a href=\"../details.php?image_id=".$_GET['image_id'].
				"\"><img class=\"icono\" src=\"../img/view.png\" /></a>','0','0')");
	
				}
				
			}

            mysqli_close($GLOBALS['conexion']);
        }

    }

    unset($_SESSION['captcha']);

    $_SESSION['pagina'] = "details.php?image_id=" . $_GET['image_id'];

    cabecera();

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_id FROM ' .
        $GLOBALS['table_prefix'] . "images ORDER BY image_id DESC LIMIT 1");

    $fila = mysqli_fetch_row($consulta);

    $ultima_imagen = $fila[0];

    if ($_GET['image_id'] <= $ultima_imagen) {

        poner_menu();

	if(!isset($_SESSION['del_comment']) && !isset($_SESSION['edit_comment']) && $_SESSION['contar']){
	
        mysqli_query($GLOBALS['conexion'],
        'UPDATE 4images_images SET image_hits=image_hits+1 WHERE image_id=' . $_GET['image_id']);
	}
	
$_SESSION['contar']=true;

        $consulta = mysqli_query($GLOBALS['conexion'], '

		SELECT cat_id,cat_name FROM ' . $GLOBALS['table_prefix'] . 'categories where cat_id=(

		SELECT cat_id FROM ' . $GLOBALS['table_prefix'] . 'images WHERE image_id=' . $_GET['image_id'] . ')');

        $categoria = mysqli_fetch_row($consulta);

        print '<br/><br/>
		
		<div style="margin:auto;">

		<div style="float:left;margin:auto;">
			<a style="padding-left:140px;color:#562676;font-size:25px;font-weight:bold;"
			href="categories.php?cat_id=' . $categoria[0] . '">' . $categoria[1] . '</a>
		</div>

		<div style="float:left;">';

        $consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_name,cat_id,image_media_file,image_description,image_id FROM ' . $GLOBALS['table_prefix'] . 'images
		WHERE image_id=' . $_GET['image_id']);

        $recuento = mysqli_fetch_row($consulta);

        $categoria = $recuento[1];
        $imagen = $recuento[2];

        print '<h1 style="color:#116C5D;">' . $recuento[0] . '</h1>

		<div style="background-color: rgba(255, 255, 255, 0);margin-left:2%;" class="container">

			<img  class="img-fluid "   alt="' . $recuento[0] . '" src="data/media/' . $recuento[1] . '/' . $recuento[2] . '" />

			<div style="background-color: rgba(255, 255, 255, 0);
			margin-bottom: -17px; margin-right: -17px; max-height: 505.75px;overflow: hidden;"
			class="overlay scrollbar-vista ">';

        if (!empty($recuento[3])) {
            print '
				<div style="height:350px;margin:auto;" class="transparente">
					<h2 style="width:70%;font-size:25px;margin:auto;padding-bottom:10px;
					margin:auto;background-color:#ffffff;color:blue;" class="texto">' . $recuento[3] . '</h3></div>';
        }

        print '
			</div>

		</div>';

        $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_hits,image_downloads FROM ' . $GLOBALS['table_prefix'] . 'images
			WHERE image_id=' . $_GET['image_id']);

        $fila = mysqli_fetch_row($consulta);

        print '<div style="margin-left:-20px;" class="table-responsive-xs">

		<table style="border:none;margin-left:-20px;" class="table">
			<tr style="border:none;">
				<td style="border:none;">
					<img alt="hits" style="height:30px;width:30px;"  src="img/view.png"/>
					<span style="font-size:14px;color:blue;">' . $fila[0] . '</span>
				</td>

				<td style="border:none;">

					<img alt="top images" style="height:30px;width:30px;"  src="img/top.png"/>
					<span style="font-size:14px;color:blue;">8.5</span>
				</td>

				<td style="border:none;">
					<img alt="download" style="height:30px;width:30px;"  src="img/download.png"/>
					<span id="descargas" style="font-size:14px;color:blue;">' . $fila[1] . '</span>
				</td>
			</tr>
		</table>';

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
            } else {
                $imagen_usuario = 'img/user.png';
            }
            print '<div style="float:left;padding-left:135px;">
			<img alt="usuario" class="imgRedonda" style="padding-left:10px;width:40px;height:40px;" src="' . $imagen_usuario . '"/>
			<span style="font-size:20px;"> ' . $fila[1] . '</span></div>';
        }

        if ($_GET['image_id'] > 1) {

            $id_images = array();

            $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_id FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_active='1'");

            while ($recuento = mysqli_fetch_row($consulta)) {
                $id_images[] = $recuento[0];
            }

            $imagen_anterior = array_search($_GET['image_id'], $id_images);

            $imagen_anterior--;

            if ($imagen_anterior >= 0) {

                $consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT image_media_file,cat_id,image_name FROM ' . $GLOBALS['table_prefix'] . "images
				WHERE image_id='" . $id_images[$imagen_anterior] . "'");

                $recuento = mysqli_fetch_row($consulta);

                print '<div style="float:left;padding-top:40px;padding-left:30px;">';

                print '
				<a style="text-decoration:none;" href="details.php?image_id=' . $id_images[$imagen_anterior] . '" >
					<img alt="go back" style="height:40px;width:40px;" src="img/back_2.png"/>
					<img alt="' . $recuento[2] . '" style="margin-left:10px;height:50px;width:50px;" src="data/media/' . $recuento[1] . '/' . $recuento[0] . '"/>
				</a>
				</div>';
            }

        }

        if (isset($_COOKIE['4images_userid']) && !empty($_COOKIE['4images_userid']) && $_COOKIE['4images_userid'] > 0) {

            $icono = "fav.ico";

            $like = "";

            $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
                $GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=" . $_GET['image_id'] . "
		AND user_id=" . $_COOKIE['4images_userid']);

            $fila = mysqli_fetch_row($consulta);

            if ($fila[0] == 1) {
                $icono = "fav_2.ico";
            }

            $like = '<div style="float:left;padding-top:40px;padding-left:40px;">

				<a id="frmajax" onclick="favorito(' . $_GET['image_id'] . ')">
				<img id="' . $_GET['image_id'] . '" alt="favorite" class="iconos" src="img/' . $icono . '" /></a>
				</div>
			';

            if (subida_por_mi($_GET['image_id'])) {

                print '
		<div style="float:right;padding-top:40px;">

			<a style="padding-left:10px;padding-top:20px;" data-toggle="modal" data-target="#renameModal">
				<img class="iconos" style="margin-top:20px;" src="img/rename.png" alt="' . ver_dato('rename', $GLOBALS['idioma']) . '"/>
			</a>
			<a style="padding-left:10px;padding-top:20px;" href="delete.php?image_id=' . $_GET['image_id'] . "&cat_id=" . $categoria . "&file=" . $imagen . '">
				<img class="iconos" style="margin-top:20px;" src="img/delete.ico" alt="' . ver_dato('rename', $GLOBALS['idioma']) . '"/>
			</a>
			<div class="modal fade transparente" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered transparente" role="document">
		<div class="modal-content ">
			<div class="modal-header ">

			<h2 style="padding-right:10px;" class="modal-title" id="exampleModalLabel">' . ver_dato('rename', $GLOBALS['idioma']) . '</h2>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>

			</button>
			</div>

			<div class="modal-body">

				<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">

					<input name="nuevo_nombre" class="button" style="padding-top:12px;" type="text" placeholder="' . ver_dato('new_name', $GLOBALS['idioma']) . '"/>

					<input name="renombrar" style="margin-top:20px;" type="submit" value="' . ver_dato('rename', $GLOBALS['idioma']) . '" />

				</form>

			</div>

		</div>
	</div>
</div>
</div>';

            }
        }

        if ($like != "") {
            print $like;
        }

        print '<div style="float:left;padding-top:40px;padding-left:10px;">

		<div style="float:left;padding-left:20px;padding-right:40px;">
			<a onclick="fullwin(' . $_GET['image_id'] . ');">
				<img alt="full screen" style="height:40px;width:40px;" src="img/full_screen.png">
			</a>
		</div>

		<div style="float:left;">
			<form id="frmdownload" method="post">
				<a onclick="descarga(' . $_GET['image_id'] . ')" href="data/media/' . $categoria . '/' . $imagen . '" download>
				<img alt="download" style="height:40px;width:40px;" src="img/download.png"/></a>
			</form>
		</div>';

        if ($_GET['image_id'] < $ultima_imagen) {

            $id_images = array();

            $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
                $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

            $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_id FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_active='1'");

            while ($recuento = mysqli_fetch_row($consulta)) {
                $id_images[] = $recuento[0];
            }

            $imagen_posterior = array_search($_GET['image_id'], $id_images);

            $imagen_posterior++;

            $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_media_file,cat_id,image_name FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_id='" . $id_images[$imagen_posterior] . "'");

            $recuento = mysqli_fetch_row($consulta);

            print '<div style="float:left;padding-left:30px;">';

            if (!empty($recuento[0]) && !empty($recuento[1])) {
                print '
					<a style="text-decoration:none;" href="details.php?image_id=' . $id_images[$imagen_posterior] . '" >
					<img alt="' . $recuento[2] . '" style="margin-left:10px;height:50px;width:50px;" src="data/media/' . $recuento[1] . '/' . $recuento[0] . '"/>
					<img alt="go next" style="height:40px;width:40px;margin-left:10px;" src="img/next_2.png"/>
					</a>';
            }

            print '</div>';

        }

        print '</div>
		
		<div style="float:left;">';

        print '

		<div style="float:left;margin:auto;width:100%;padding-top:40px;margin-left:-10px;">';

$titulo_comentario=ver_dato('comments', $GLOBALS['idioma']);

        $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
            $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

        $consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT image_allow_comments FROM ' . $GLOBALS['table_prefix'] . "images
			WHERE image_active=1 AND image_id='" . $_GET['image_id'] . "'");

        $comentario = mysqli_fetch_row($consulta);

        if ($comentario[0] == 1) {
			
			$logueado=logueado();
			
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
<div  style=" border: dashed 2px #500C9D;" class="demo">
<h2>'.$titulo_comentario.'</h2>	
  <a style="cursor: pointer;" onClick="muestra_oculta(\'contenido\')" title="" class="boton_mostrar"> <img id="ver_comentario" src="img/view.png" class="icono" /></a>
</div>

				<div id="contenido" style="height:500px;width:90%;margin-left:10px;margin-top:30px;min-width:300px;border-style: none!important;"  >
				
					<table style="margin:auto;text-align:center;" class="table table-responsive-xs">
					
						<tr style="font-size:20px;">
							<th></th>
							<th></th>
						</tr>';

                $consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT comment_headline,comment_text,visible,user_id,comment_id FROM ' . $GLOBALS['table_prefix'] . "comments
				WHERE image_id='" . $_GET['image_id'] . "' order by comment_id desc");


                while ($fila = mysqli_fetch_row($consulta)) {
							
					if($logueado || $fila[2]=='1'){
						
                    $fila[1] = str_replace('[URL]', '<a href="', $fila[1]);
                    $fila[1] = str_replace('[/URL]', '">' . $fila[0] . '</a>', $fila[1]);
					
                    print '
					<tr>
						<td style="font-size:23px;">' . $fila[0] . '</td>
						<td style="font-size:23px;">' . $fila[1];
						
						if(  $logueado && $fila[3]==$_COOKIE['4images_userid']){
							
							print '
							<a onclick="accion('.$fila[4].",".$_GET['image_id'].',\'action.php\');" style="padding-left:10px;">
								<img alt="'.$fila[0].'" id="'.$fila[4].'" src="img/edit.png" class="iconos" />
							</a>
							
							<a onclick="accion('.$fila[4].",".$_GET['image_id'].',\'delete2.php\');" style="padding-left:10px;">
							<img src="img/delete.ico" class="iconos" /></a>';
							
							
				
						}
						
						print '</td>
						
					</tr>
					<tr>
					<td colspan="3"><hr class="comentario" /></td>
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

			<button onclick="redireciconar_accion('.$_GET['image_id'].',false);" type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span onclick="redireciconar_accion('.$_GET['image_id'].',false);" aria-hidden="false">×</span>

			</button>
			</div>

			<div class="modal-body">

				<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
<input type="radio" name="delete_comment" value="yes"><img src="img/check.png" class="icono"/></input>
  <input type="radio" name="delete_comment" checked value="no"><img src="img/error.png" class="icono"/></input>
  <input name="fmr_delete_comment" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>
				</form>

			</div>

		</div>
	</div>		
				
				</div>
				
						<div class="modal fade transparente" id="edit_comment" tabindex="-1" role="dialog" aria-labelledby="edit_commentModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered transparente" role="document">
	
		<div class="modal-content ">
		
			<div class="modal-header ">
			
<img src="img/edit.png" class="icono" />

			<button  onclick="redireciconar_accion('.$_GET['image_id'].',false);" type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span onclick="redireciconar_accion('.$_GET['image_id'].',true);" aria-hidden="true">&times;</span>

			</button>
			</div>

			<div class="modal-body">
';

$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT comment_text,comment_headline FROM '.$GLOBALS['table_prefix']."comments
				WHERE comment_id='".$_SESSION['edit_comment']."'");
			
	$id_comentario = mysqli_fetch_row($consulta);
	
	mysqli_close($GLOBALS['conexion']);	
		
	print '	<form action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '" method="post">
	
		<p><input name="edit_comment_asunto" type="text" value="'.$id_comentario[1].'"></input></p>
		
		<p><textarea name="edit_comment" type="text" >'.$id_comentario[0].'</textarea></p>

<input name="comentar" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>

				</form>

			</div>

		</div>
	</div>	
				
				
			
				
				
				';
            }

            if (isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid'] > 0) {

                print '

							</div>
							</div>
							
						<div style="float:left;padding-left:30%;padding-top:20px;">

					<div style="float:left;margin-left:-110px;">
					
							<form method="post" action="' . $_SERVER['PHP_SELF'] . '?image_id=' . $_GET['image_id'] . '">
							
								<p><img alt="asunto del comentario" style="height:100px;width:100px;" src="img/comment.png"/></p>
								
								<p><input type="text" style="width:300px;" name="asunto" placeholder="' . ver_dato('asunto', $GLOBALS['idioma']) . '" /></p>
								
								<p><img alt="comentario" style="height:100px;width:100px;" src="img/coment.png"/></p>
								
								<p>
								
								<div style="float:left;height:60px;padding-bottom:100px;">
								
									<a style="padding-left:10px;" data-toggle="modal" data-target="#mencion"><img class="icono"
									src="img/mention.png" /></a>
									
									<a style="padding-left:10px;" data-toggle="modal" data-target="#url"><img class="icono"
									src="img/url.png" /></a>
									
								</div>
								
								</p>

								<p>
									<textarea style="width:300px;" id="mensaje" placeholder="' . ver_dato('msg', $GLOBALS['idioma']) . '"
									name="mensaje"></textarea>
								</p>
								
								<p>
									<img src="img/view.png" class="icono" /> <h2>'.ver_dato('visibilidad', $GLOBALS['idioma']).'</h2>
									
									<select style="font-size:25px;width:300px;" name="visibilidad">
										<option value="0" selected>'.ver_dato('solo_users', $GLOBALS['idioma']).'</option>
										<option value="1" >'.ver_dato('publica', $GLOBALS['idioma']).'</option>
									</select>
									
								</p>
								
								<p><img alt="captcha" src="captcha/captcha.php" id="captcha" />
								
									<a  class="texto nota" href="#" onclick="' . "
													document.getElementById('captcha').src='captcha/captcha.php?'+
													Math.random();
													document.getElementById('captcha-form').focus();\"
													id=\"change-image\"><img alt=\"reload\" class=\"icono2\"
													src=\"img/reload.png\"/>
									</a>
								</p>" . '
								
								<p>

									<input style="width:300px;" type="text" title="captcha" required  id="validcaptcha"
										name="captcha" size="30" value="" class="input" id="captcha_input"
										placeholder="' . ver_dato('captcha', $GLOBALS['idioma']) . '"/>
								</p>

<div style="float:left;padding-bottom:30px;">
									<input style="width:300px;font-size:25px;margin-left:3px;" type="submit" title="captcha" name="comentario" value="' . ver_dato('submit', $GLOBALS['idioma']) . '" type="submit" />
								</div>
							
							</form>
							
							</div>
							
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
					
	print '<p><select id="mention_users" style="font-size:20px;font-weight:bold;margin-top:40px;" name="usuarios">';
	
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
$GLOBALS['db_password'], $GLOBALS['db_name'])
or die("No se pudo conectar a la base de datos");
$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id>0 and user_id!='".$_COOKIE['4images_userid']."' ");
	
while($fila = mysqli_fetch_row($consulta)){
		print '<option value="'.$fila[0].'">'.$fila[0].'</option>';
}
	
mysqli_close($GLOBALS['conexion']);

print '</option>
	</select>
</p>

<button style="width:300px;" onclick="mencionar(1)" type="button" data-dismiss="modal"><span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span></button>

				</form>

			</div>

		</div>
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

	<p><input id="ctr_url" type="text"></input>
</p>

<button style="width:300px;" onclick="mencionar(2);" type="button" data-dismiss="modal"><span style="font-size:25px;" >'.ver_dato('submit', $GLOBALS['idioma']).'</span></button>

				</form>

			</div>

		</div>
	</div>
				
					
				';
            } else {

                print '<div style="float:left;padding-top:80px;padding-bottom:40px;">
					<a style="font-size:30px;padding-bottom:60px;" href="register.php">
						<img alt="registrar" style="height:110px;width:240px;" src="img/reg-now.gif"/>
					</a>
				</div>';

            }
        }
		
        footer();
		

		if(isset($_SESSION['del_comment']) ){
	
			print "<script>$('#del_comment').modal('show');</script>";
		}
		
		if(isset($_SESSION['edit_comment']) ){
	
			print "<script>$('#edit_comment').modal('show');</script>";
		}

    } else {
        $_SESSION['pagina'] = "details.php?image_id=" . $ultima_imagen;
        redireccionar('details.php?image_id=' . $ultima_imagen);
    }
}
} else {
    redireccionar('index.php');
}

restablecer_pass();

?>