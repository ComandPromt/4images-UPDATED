<?php

include('../upload_images/cabecera.php');

comprobar_cookie('../');

if(isset($_POST['enviar'])){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
	SELECT COUNT(cat_id) FROM '.$GLOBALS['table_prefix']."categories
	WHERE cat_name='".$_POST['nombre']."'");
	
	$recuento = mysqli_fetch_row($consulta);
	
	if($recuento[0]==0){
		mysqli_query($GLOBALS['conexion'], '
		INSERT INTO '.$GLOBALS['table_prefix']."categories (cat_name,cat_description,cat_parent_id,cat_hits,auth_viewcat,auth_viewimage,auth_download,auth_upload,auth_vote,auth_sendpostcard,auth_readcomment,auth_postcomment)
		VALUES ('".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['categoria']."','0','0','0','0','0','0','0','0','0')");
	
	}
	
	mysqli_close($GLOBALS['conexion']);
}

poner_menu('../');

print '<div class="container" style="width:113%;margin-auto;padding-top:100px;">';

print '<nav>
    <ul>
            <li style="padding-top:20px;"><a href="categories.php"><img class="icono" src="../img/tag.png"/></a></li>
        <li style="padding-top:20px;"><a href="geo.php"><img class="icono" src="../img/geo.png"/></a></li>

		<br clear="all" />
    </ul>

</nav>';

print '
<form method="post" action="'.$_SERVER['PHP_SELF'].'">
<p><input type="text" name="nombre" placeholder="'. ver_dato('name', $GLOBALS['idioma']).'"/></p>
<p><input type="text" name="descripcion" placeholder="'. ver_dato('desc', $GLOBALS['idioma']).'"/></p>
<p>'. ver_dato('tipe', $GLOBALS['idioma']).'<select name="categoria">';

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
 
print '</select></p>
	<p style="padding-top:20px;"><input name="enviar" style="font-size:20px;" type="submit"/></p>
</form>';

print '</div>';

restablecer_pass('../');

footer('../');

?>