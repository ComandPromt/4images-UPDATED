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

	(remitente,destinatario,asunto,mensaje,leido,oculto)

	VALUES( '".$_COOKIE['4images_userid']."','".$_GET['destinatario']."','RE - ".$_GET['asunto']."','".$_POST['msg_reply']."','0','0')");
	
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

		$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT asunto,mensaje,user_name,id,destinatario FROM mensajes M JOIN '.$GLOBALS['table_prefix']."users U ON M.destinatario=U.user_id  WHERE oculto!='".$_COOKIE['4images_userid']."' AND remitente='".$_COOKIE['4images_userid']."' ORDER BY id DESC");
	
		while($fila = mysqli_fetch_row($consulta)){
			
			$asuntos[]=$fila[0];
			
			$id_mensajes[]=$fila[3];
			
			$destinatarios[]=$fila[4];
			
				print '<tr><td style="color:#7a4a0f;font-weight:bold;">'.$fila[0].'</td><td>'.$fila[1].'</td><td><img style="height:40px;width:40px;margin-right:20px;" src="../img/user.png"/>'.$fila[2].'</td></tr>
		
				<tr><td colspan="3"><button type="button" style="height:50px;" data-toggle="modal" data-target="#reply'.$longitud.'">
   '.ver_dato('reply', $GLOBALS['idioma']).'
</button></td>
				<tr><td colspan="3"><hr style="margin-top:-1px;"/></td>';
			$longitud++;	
		}

		print '</table>';

		for($x=0;$x<$longitud;$x++){
			
			print '<div class="modal fade transparente" id="reply'.$x.'" tabindex="-1" role="dialog" aria-labelledby="ctrlreply'.$x.'" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered transparente" role="document">
<div class="modal-content ">
<div class="modal-header transparente">
<h2 class="modal-title"  style="padding-right:20px;" id="ctrlreply'.$x.'">'.ver_dato('reply', $GLOBALS['idioma']).'</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body transparente">
          <form action="'.$_SERVER['PHP_SELF'].'?msg_id='.$id_mensajes[$x].'&destinatario='.$destinatarios[$x].'&asunto='.$asuntos[$x].'" method="post">

		     <input class="input" name="msg_reply" type="text"/>
			 <input style="margin-top:20px;" value="'.ver_dato('reply', $GLOBALS['idioma']).'" type="submit" name="respuesta" />
        </form>

</div>

</div>
</div>
</div>';
		}

	}

print '

</div>';

restablecer_pass('../');

footer('../');

?>