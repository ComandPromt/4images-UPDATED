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
			<input style="margin-top:20px;" name="asunto" type="text" />
		</p>
	
		<p>

		<a title="Emoji" style="padding-left:10px;" data-toggle="modal" data-target="#emojis">
			<img class="icono" src="../img/emoji.png">
		</a>

		<a title="Limpiar Comentario" style="padding-left:10px;padding-right:10px;" onclick="limpiar_emoji(\'mensaje\')" >
			<img class="icono" src="../img/clean.png">
		</a>
		
			<span>'.ver_dato('msg', $GLOBALS['idioma']).'</span>

			<textarea name="mensaje" id="mensaje" style="margin-top:20px;height:200px;font-size:25px;color:#8105F1;"></textarea>
		</p>
	
		<input class="negrita" style="margin-top:-10px;margin-bottom:10px;" name="enviar_correo" value="'.ver_dato('submit', $GLOBALS['idioma']).'" type="submit"/>
		
	</form>
	
</div>

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

			</div> ';

restablecer_pass('../');

footer('../');

?>
