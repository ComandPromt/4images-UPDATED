<?php

session_start();

include('config.php');

include('includes/funciones.php');

cabecera();


if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
}
		
if(!isset($_SESSION['id_usuario']) || empty($_SESSION['pagina'])){
	redireccionar('index.php');
}

else{
	


	if(isset($_POST['cambiar_pass']) && !empty($_POST['nueva_pass'])){

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."users SET user_password='".salted_hash($_POST['nueva_pass'])."' WHERE user_id=".$_SESSION['id_usuario']);
		mensaje(ver_dato('cambio_pass_exitoso', $GLOBALS['idioma']));
		mysqli_close($GLOBALS['conexion']);
		unset($_SESSION['pagina']);
		
		session_destroy();
		
		redireccionar($_SESSION['pagina']);
	}

	print '<div class="modal-body">
			<form method="post" action="'.$_SERVER['PHP_SELF'].'">
			<div class="form-group">
			<label for="recipient-name" class="col-form-label"><h3>'.
			ver_dato('nueva_pass', $GLOBALS['idioma']).'</h3></label>
			<input  name="nueva_pass" type="password" class="form-control" id="recipient-name"/>
			</div>
			<br/><br/>
			<input name="cambiar_pass" type="submit" value="'.ver_dato('cambiar_pass', $GLOBALS['idioma']).'" />
			</form>
	</div>';
	
}

footer();

?>