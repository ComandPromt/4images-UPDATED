<?php

session_start();

$_SESSION['track']=false;

include_once('../config.php');

include('../includes/funciones.php');

comprobar_cookie('../');

cabecera('../');

if(isset($_POST['enviar_correo']) && trim($_POST['asunto'])!="" && trim($_POST['mensaje'])!="" ){
	
	include('../config.php');
	
	$_POST['asunto']=trim($_POST['asunto']);
	$_POST['mensaje']=trim($_POST['mensaje']);
			
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
	$GLOBALS['db_password'], $GLOBALS['db_name'])
	or die("No se pudo conectar a la base de datos");
			
	$consulta = mysqli_query($GLOBALS['conexion'], "INSERT INTO mensajes
	
	(remitente,destinatario,asunto,mensaje,leido,oculto,dt_fechaEnvio,dt_fechaVista,hora_envio,hora_vista)
	
	VALUES( '".$_COOKIE['4images_userid']."','".$_POST['destinatario']."','".$_POST['asunto']."','".$_POST['mensaje']."','0','0',CURDATE(),CURDATE(),CURTIME(),CURTIME())");
		
	mysqli_close($GLOBALS['conexion']);
	
	mensaje(ver_dato('msg_success', $GLOBALS['idioma']));
}

poner_menu('../');

print '<div class="container" style="margin-auto;padding-top:100px;">';

menu_mensajes();

print '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">

		<p>
			<label>
				<span>'.ver_dato('recipient', $GLOBALS['idioma']).'</span> 
				<img class="icono" src="../img/emaill.png"/>
			</label>
		
			<select name="destinatario">';
		
				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
				$GLOBALS['db_password'], $GLOBALS['db_name'])
				or die("No se pudo conectar a la base de datos");
				$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id,user_name,user_level FROM '.$GLOBALS['table_prefix']."users WHERE user_id>0 and user_id!='".$_COOKIE['4images_userid']."' ORDER BY user_level DESC,user_name");
					
				while($fila = mysqli_fetch_row($consulta)){
					
					if($fila[2]=='9'){
						$fila[1]='*Admin* - '.$fila[1];
					}
					
					print '<option value="'.$fila[0].'">'.$fila[1].'</option>';
				}
				
				mysqli_close($GLOBALS['conexion']);
		
				print '</option>
				
			</select>
		</p>
	
		<p>
			<span>'.ver_dato('asunto', $GLOBALS['idioma']).'</span>
			<input name="asunto" type="text" />
		</p>
	
		<p>
			<span>'.ver_dato('msg', $GLOBALS['idioma']).'</span>
			<textarea name="mensaje" style="height:200px;font-size:25px;color:#8105F1;"></textarea>
		</p>
	
		<input name="enviar_correo" value="'.ver_dato('submit', $GLOBALS['idioma']).'" type="submit"/>
		
	</form>
	
</div>';

restablecer_pass('../');

footer('../');

?>