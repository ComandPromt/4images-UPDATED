<?php

session_start();

$_SESSION['track']=false;

include_once('../config.php');

include('../includes/funciones.php');

cabecera('../');

zona_privada('../');

comprobar_cookie('../');

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

if(isset($_POST['enviar'])){
		
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
	SELECT COUNT(cat_id),cat_id FROM '.$GLOBALS['table_prefix']."categories
	WHERE cat_name='".$_POST['nombre']."' GROUP BY cat_id");
		
	if(!file_exists('../data/media/'.$recuento[1])){
		mkdir('../data/media/'.$recuento[1], 0777, true);
	}
	
	$recuento = mysqli_fetch_row($consulta);
	
	if($recuento[0]==0){
		mysqli_query($GLOBALS['conexion'], '
		INSERT INTO '.$GLOBALS['table_prefix']."categories (cat_name,cat_description,cat_parent_id,cat_hits,auth_viewimage,auth_download,auth_upload,auth_readcomment,auth_postcomment,visibilidad,permitir_gif)
		VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['categoria']."','0','0','0','0','0','0','0','0','0')");
	
	}
		
	mysqli_close($GLOBALS['conexion']);
	
	mensaje(ver_dato('cat_success', $GLOBALS['idioma']));
}

poner_menu('../');

poner_menu_geo('../');

print '
<div style="width:90%;" class="flotar_izquierda" >

	<form method="post" action="'.$_SERVER['PHP_SELF'].'">

		<p>
			<input type="text" name="nombre" placeholder="'. ver_dato('name', $GLOBALS['idioma']).'"/>
		</p>

		<p>
			<input type="text" name="descripcion" placeholder="'. ver_dato('desc', $GLOBALS['idioma']).'"/>
		</p>

		<p>
			<span>'. ver_dato('tipe', $GLOBALS['idioma']).'</span>
		
			<select style="margin-top:20px;" name="categoria">';

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    		$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
			$consulta = mysqli_query($GLOBALS['conexion'], '
			SELECT COUNT(cat_id) FROM '.$GLOBALS['table_prefix']."categories");
	
			$recuento = mysqli_fetch_row($consulta);
	
			if($recuento[0]==0){

				print '<option value="0">Categoria principal</option>';
	
			}
	
			else{
		
				print '<option value="0">Categoria principal</option>';
		
				$consulta = mysqli_query($GLOBALS['conexion'], '
				SELECT cat_id,cat_name FROM '.$GLOBALS['table_prefix']."categories");
	
				while($recuento = mysqli_fetch_row($consulta)){
					print '<option value="'.$recuento[0].'">'.$recuento[1].'</option>';
				}

			}
	
mysqli_close($GLOBALS['conexion']);
 
print '</select>

</p>

<div style="clear:both;">

	<h2>
		<span>'. ver_dato('visibilidad', $GLOBALS['idioma']).'</span>
	</h2>

	<div style="margin-left:30%;padding-right:20px;" class="flotar_izquierda" >

		<label>
			<input type="radio" id="aut_descarga" checked="selected" name="gender" value="male"> '.ver_dato('public', $GLOBALS['idioma']).'</input>
		</label>

	</div>

	<div class="flotar_izquierda" >

		<label>
			<input type="radio" id="aut_descarga" name="gender" value="female"> '.ver_dato('private', $GLOBALS['idioma']).'</input>
		</label>

	</div>

</div>

<div style="clear:both;">

		<input value="'.ver_dato('submit', $GLOBALS['idioma']).'" name="enviar" style="font-size:20px;" type="submit"/>

</div>

</form>

</div>';

print '</div>';

restablecer_pass('../');

footer('../');

?>
