<?php

session_start();

$_SESSION['track']=true;

include_once('../config.php');

include('../includes/funciones.php');

comprobar_cookie('../');

include('../config.php');

if(isset($_POST['respuesta'])){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name'])
	or die("No se pudo conectar a la base de datos");

	mysqli_query($GLOBALS['conexion'], "INSERT INTO mensajes 

	(remitente,destinatario,asunto,mensaje,leido,oculto,dt_fechaEnvio,dt_fechaVista,hora_envio,hora_vista)

	VALUES( '".$_COOKIE['4images_userid']."','".$_GET['destinatario']."','RE - ".$_GET['asunto']."','".$_POST['msg_reply']."','0','0',CURDATE(),CURDATE(),CURTIME(),CURTIME())");
	
	mysqli_close($GLOBALS['conexion']);
	
	mensaje('El email se ha enviado correctamente');
	
	redireccionar('outbox.php');
}

cabecera('../');

poner_menu('../');

print '<div class="container" style="margin-auto;padding-top:100px;padding-bottom:30px;">';

menu_mensajes();

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
$GLOBALS['db_password'], $GLOBALS['db_name'])
or die("No se pudo conectar a la base de datos");	
	
$consulta = mysqli_query($GLOBALS['conexion'], "SELECT COUNT(id) FROM mensajes WHERE oculto!='".$_COOKIE['4images_userid']."' AND remitente='".$_COOKIE['4images_userid']."'");
	
	$fila = mysqli_fetch_row($consulta);
	
	if($fila[0]>0){
		
		print '<hr/>
		<table class="table" style="margin-bottom:100px;margin:auto;">
		<tr>
		<th></th>
		<th></th>
		<th></th>
		</tr>';

		$longitud=0;
	
		$id_mensajes=array();
		
		$destinatarios=array();

		$asuntos=array();

		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT asunto,mensaje,user_name,id,destinatario,avatar FROM mensajes M JOIN '.$GLOBALS['table_prefix']."users U ON M.destinatario=U.user_id  WHERE oculto!='".$_COOKIE['4images_userid']."' AND remitente='".$_COOKIE['4images_userid']."' ORDER BY id DESC");
		
		while($fila = mysqli_fetch_row($consulta)){
			
			$asuntos[]=$fila[0];
			
			$id_mensajes[]=$fila[3];
			
			$destinatarios[]=$fila[4];
			
			$avatar='img/nofoto.png';
			
			if($fila[5]!="nofoto.jpg"){
				
				$avatar='avatars/'.$fila[5];
			}
		
			print '<tr><td style="color:#7a4a0f;font-weight:bold;">'.$fila[0].'</td><td>'.$fila[1].'</td><td class="remitente"  ><img class="imgRedonda" style="height:40px;width:40px;margin-right:20px;" src="../'.$avatar.'"/>'.$fila[2].'</td></tr>
		
				<tr><td colspan="3"><button type="button" style="height:50px;" data-toggle="modal" data-target="#reply'.$longitud.'">
				'.ver_dato('reply', $GLOBALS['idioma']).'
				</button></td>
				<tr><td colspan="3"><hr style="margin-top:-1px;"/></td>';
				
			$longitud++;	
		}

		print '</table>';

		for($x=0;$x<$longitud;$x++){
			
			print '
			<div class="modal fade transparente" id="reply'.$x.'" tabindex="-1" role="dialog" aria-labelledby="ctrlreply'.$x.'" aria-hidden="true">

			<div class="modal-dialog modal-dialog-centered transparente" role="document">
			
			<div class="modal-content ">
			
			<div class="modal-header transparente">
			
			<h2 class="modal-title"  style="padding-right:20px;" id="ctrlreply'.$x.'">'.ver_dato('reply', $GLOBALS['idioma']).'</h2>
			
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			
				<span aria-hidden="true">&times;</span>
			
			</button>
			
			</div>
			
			<div class="modal-body transparente">

			<a title="Emoji" style="padding-left:10px;" data-toggle="modal" data-target="#emojis">
				<img class="icono" src="../img/emoji.png">
			</a>
			<a title="Limpiar Comentario" style="padding-left:10px;" onclick="limpiar_emoji(\'mensaje\')" >
				<img class="icono" src="../img/Recycle_Bin_Full.png">
			</a>
					<form action="'.$_SERVER['PHP_SELF'].'?msg_id='.$id_mensajes[$x].'&destinatario='.$destinatarios[$x].'&asunto='.$asuntos[$x].'" method="post">
			
						<textarea style="margin-top:20px;" id="mensaje" class="input" name="msg_reply" type="text"></textarea>

						<input class="negrita" style="margin-top:20px;" value="'.ver_dato('reply', $GLOBALS['idioma']).'" type="submit" name="respuesta" />
					</form>
			
			</div>
			
			
			</div>
			</div>
			</div>';
		}

	}

print '

<div class="modal fade transparente" id="emojis"  role="dialog" aria-labelledby="urlModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered transparente" role="document">
	
		<div  class="modal-content ">
		
			<div class="modal-header ">
				<img class="icono" alt="Emoticono" src="../img/emoji.png" />
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

</div>';

restablecer_pass('../');

footer('../');

?>