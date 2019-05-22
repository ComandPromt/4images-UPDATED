<?php

include('cabecera.php');

if(!isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']<=0){
	redireccionar('../index.php');
}

poner_menu('../');

session_start();

$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);

print '

<div style="margin:auto;padding-left:80px;padding-top:100px;">
	<form action="input.php" method="post">
		<p><label><img  style="margin-right:20px;" class="icono" src="../img/add_tag.png"/>'.ver_dato('nombre_subida_multiple', $GLOBALS['idioma']).'</label>
		<input required  type="text" style="font-size:20px;text-align:center;" name="nombre"  />
		</p>
		
		<p>
		<label><img style="margin-right:20px;" class="icono" src="../img/tag.png"/>'.
		ver_dato('insertar_categoria', $GLOBALS['idioma']).'</label>
		<select style="font-size:20px;" name="categoria">';


include('../config.php');

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name FROM ' .
        $GLOBALS['table_prefix'] .'categories ORDER BY cat_id');
	
	$numero_categorias=0;
	
	if(mysqli_affected_rows($GLOBALS['conexion'])>0){
		$numero_categorias=1;
		$x=1;
		
		while($fila = mysqli_fetch_row($consulta)){
			print '<option value="'.$x.'">'.$fila[0].'</option>';
			$x++;
		}
	}
	
mysqli_close($GLOBALS['conexion']);

$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);

if($numero_categorias==0){
	redireccionar('../index.php');
}

print '			
		</select>
		</p>
		<input value="'.ver_dato('submit', $GLOBALS['idioma']).'"  id="enviar" name="admin_upload" type="submit"/>
	</form>

	</div>';

footer('../');
?>