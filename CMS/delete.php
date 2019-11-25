<?php

session_start();

$_SESSION['track']=false;

include_once('config.php');

include('includes/funciones.php');

comprobar_cookie();

if( isset($_GET['cat_id']) && (int)$_GET['cat_id']>0 && isset($_GET['file']) && !empty($_GET['file'])){

	cabecera();
	
	$permitir_borrar=false;

	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta=mysqli_query($GLOBALS['conexion'],
	'SELECT user_id FROM '.$GLOBALS['table_prefix']."images WHERE cat_id='".$_GET['cat_id']."' AND image_media_file='".$_GET['file']."' AND user_id='".$_COOKIE['4images_userid']."'");
		
	$fila = mysqli_fetch_row($consulta);
	
	$dato=(int)$fila[0];
	
	if((int)$fila[0]==(int)$_COOKIE['4images_userid']){
		$permitir_borrar=true;
	}
	
	mysqli_close($GLOBALS['conexion']);

	if($permitir_borrar){

	if(isset($_POST['eliminar_img']) && $_POST['eleccion']=='Si'){

		$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

		$consulta=mysqli_query($GLOBALS['conexion'],
		"DELETE FROM descargas WHERE imagen='".$_GET['image_id']."'");

		$consulta=mysqli_query($GLOBALS['conexion'],
		'DELETE FROM '.$GLOBALS['table_prefix']."images WHERE image_id='".$_GET['image_id']."' AND
		user_id='".$_COOKIE['4images_userid']."'");
	
		mysqli_close($GLOBALS['conexion']);	
		
		if(isset($_GET['cat_id']) && (int)$_GET['cat_id']>0 && isset($_GET['file']) && !empty($_GET['file'])){
			
			unlink('data/media/'.$_GET['cat_id'].'/'.$_GET['file']);
		}
		
		if(isset($_GET['pag']) && (int)$_GET['pag']>0){
			
			if($_SESSION['pagina']=="my_uploads.php"){
				redireccionar('my_uploads.php?pag='.$_GET['pag']);
			}
			
			else{
				redireccionar('admin/imagenes_repetidas.php');
			}	
		}
		
		else{
			redireccionar('index.php');
		}
	}

	if(substr($_SESSION['pagina'],0,11)=='details.php' && isset($_POST['eliminar_img']) && $_POST['eleccion']=='No'){
	
		redireccionar($_SESSION['pagina']);
	}
	
	if(isset($_GET['pag']) && isset($_POST['eliminar_img']) && $_POST['eleccion']=='No'){
		redireccionar('my_uploads.php?pag='.$_GET['pag']);	
	}
	
	else{
		
	print '<div style="float:left;padding-top:80px;margin-left:10%;" >
	<a alt="go back" href="details.php?image_id='.$_GET['image_id'].'">
						<img alt="go back" style="width:3em;height:3em;" src="img/back_2.png"/>
					</a>
					<a alt="ver imagen" href="details.php?image_id='.$_GET['image_id'].'">
	<img style="height:200px;width:200px;" alt="Imagen a borrar" src="data/media/'.$_GET['cat_id'].'/'.$_GET['file'].'"/>
	</a>
	<hr/>

	<form method="post" action="'.$_SERVER['PHP_SELF']."?image_id=".$_GET['image_id']."&cat_id=".$_GET['cat_id']."&file=".$_GET['file']."&pag=".$_GET['pag'].'">

	<legend style="margin-left:-20px;">'.ver_dato('del_sure', $GLOBALS['idioma']).'</legend>

	<div  style="margin-left:5px;padding-bottom:10px;padding-top:20px;" class="custom-control custom-radio">
	<input type="radio" class="custom-control-input" id="defaultGroupExample1" value="Si" name="eleccion"  />
	<label style="font-size:3em;" class="custom-control-label" for="defaultGroupExample1">SI</label>
	<img class="icono" src="img/check.png"/>
  
	</div>

	<div style="margin-left:20px;padding-top:80px;" class="custom-control custom-radio">
	<input type="radio" class="custom-control-input" id="defaultGroupExample2" value="No" name="eleccion" checked/>
	<label style="font-size:3em;" class="custom-control-label" for="defaultGroupExample2">No</label>
	<img class="icono" src="img/error.png"/>
	</div>

	<input name="eliminar_img" style="margin-top:50px;" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>

	</form>
';

}

print '</div>';	

restablecer_pass();
		
footer();

}

}

else{
	redireccionar('index.php');
}
 
?>