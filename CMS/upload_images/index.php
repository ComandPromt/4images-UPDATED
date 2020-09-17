<?php

session_start();

include_once('../config.php');

include('../includes/funciones.php');

$_SESSION['track']=false;

cabecera('../');

comprobar_cookie('../');

poner_menu('../');

$categoria="";

$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);

print '

<div style="margin:auto;padding-left:80px;padding-top:100px;">
	<form action="input.php" method="post">
		<p><label>'.ver_dato('nombre_subida_multiple', $GLOBALS['idioma']).'</label>
		<input required  type="text" style="font-size:20px;text-align:center;" name="nombre"  />
		</p>
		
		<p>
		<label>'.
		ver_dato('insertar_categoria', $GLOBALS['idioma']).'</label>
		
		<select style="font-size:20px;" name="categoria">';

	if(logueado && isset($_GET['cat']) && (int)$_GET['cat']>0){
		
		$categoria=saber_categoria($_GET['cat']);
		
		print '<option value="'.$_GET['cat'].'">'.$categoria.'</option>';
	}

include('../config.php');

			$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	
    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id>0 UNION 

	SELECT cat_name,cat_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id=0 AND cat_id NOT IN (SELECT DISTINCT cat_parent_id FROM '.$GLOBALS['table_prefix'].'categories WHERE cat_parent_id!=0) order by cat_name');
	
	$numero_categorias=0;
	
	if(mysqli_affected_rows($GLOBALS['conexion'])>0){
		
		$numero_categorias=1;

		while($fila = mysqli_fetch_row($consulta)){
			
			if(!file_exists('../data/media/'.$fila[1])){
				mkdir('../data/media/'.$fila[1], 0777, true);
			}
			
			if($categoria!=$fila[0]){
				print '<option value="'.$fila[1].'">'.$fila[0].'</option>';
			}
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
		<input value="'.ver_dato('submit', $GLOBALS['idioma']).'"  id="enviar" class="negrita" name="admin_upload" type="submit"/>
	</form>

	</div>';

footer('../');

?>