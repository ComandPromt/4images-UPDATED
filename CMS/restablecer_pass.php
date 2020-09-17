<?php

session_start();

include('config.php');

include('includes/funciones.php');

cabecera();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		redireccionar($ruta.'index.php');
	}
			
}

if (isset($_POST['restablecer_pass']) && !empty($_POST['correo_restablecimiento'])

    && !empty($_POST['nombre_usuario'])) {

    $numero_restablecimiento = mt_rand(0, 16585);

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM ' .
        $GLOBALS['table_prefix'] . "users WHERE user_name='" . $_POST['nombre_usuario'] . "'
	AND  user_email='" . $_POST['correo_restablecimiento'] . "'");
    $comprobacion = mysqli_affected_rows($GLOBALS['conexion']);

    if ($comprobacion == 1) {

        $fila = mysqli_fetch_row($consulta);
        $_SESSION['correo_restablecimiento'] = $_POST['correo_restablecimiento'];
		$_SESSION['id_usuario'] = $fila[0];

    }

    mysqli_close($GLOBALS['conexion']);
	
	if ($comprobacion == 1) {
		redireccionar($ruta.'restablecer_pass.php');
	}
	
}

else{
	
	$usuario="";
	
	if(isset($_POST['cambiar_pass']) && !empty($_POST['nueva_pass'])){

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'SELECT nacionalidad'.$GLOBALS['table_prefix']."users WHERE user_id='".$_SESSION['id_usuario']."'");

		$idioma = mysqli_fetch_row($consulta);
		
		$nacionalidad=$idioma[0];
		
		$GLOBALS['idioma']=$nacionalidad;
		
		$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."users SET user_password='".salted_hash($_POST['nueva_pass'])."' WHERE user_id=".$_SESSION['id_usuario']);
				
		mensaje(ver_dato('cambio_pass_exitoso', $GLOBALS['idioma']));
		
		mysqli_close($GLOBALS['conexion']);
		
		redireccionar($_SESSION['pagina']);
		
	}
	
	else{
		
		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'SELECT user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id='".$_SESSION['id_usuario']."'");

		$resultado = mysqli_fetch_row($consulta);
		
		$usuario=$resultado[0];
						
		mysqli_close($GLOBALS['conexion']);
		
		}

	print '<div style="padding-left:15%;" class="modal-body">


			<div class="flotar_izquierda">
			<img class="icono" src="img/user.png"/>
			</div>
			
			<div style="padding-top:80px;" class="flotar_izquierda">
				<span style="margin-left:-80px;" id="estilo_usuario">'.$usuario.'</span>
			</div>
			
			<div style="clear:both;padding-top:20px;width:200px;margin-left:-40px;" class="flotar_izquierda">
				
				<form method="post" action="'.$_SERVER['PHP_SELF'].'">
			
				<div class="form-group">
				
					<img class="icono" src="img/change_key.png"/>
					
					<label for="recipient-name" class="col-form-label"><h3>'.
						ver_dato('nueva_pass', $GLOBALS['idioma']).'</h3></label>
						
					<input name="nueva_pass" type="password" class="form-control" id="recipient-name"/>
					
				</div>
							
				<input  style="margin-left:-40px;margin-top:10px;" name="cambiar_pass" type="submit" value="'.ver_dato('cambiar_pass', $GLOBALS['idioma']).'" />
				
			</form>
				
				</div>		
			
			
	</div>';
	
}

footer();

?>
