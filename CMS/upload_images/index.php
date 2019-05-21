<?php

include('cabecera.php');

if(!isset($_COOKIE['4images_userid']) || $_COOKIE['4images_userid']<=0){
	redireccionar('../index.php');
}

poner_menu('../');
session_start();

?>

<div style="margin:auto;padding-left:80px;padding-top:100px;">
	<form action="input.php" method="post">
		<p><label><img class="icono" src="../img/add_tag.png"/></label>
		<input required  type="text" id="usuario" style="font-size:20px;text-align:center;" name="nombre"  />
		</p>
		
		<p>
		<label><img class="icono" src="../img/tag.png"/></label>
		<select style="font-size:20px;" name="categoria">
<?php

include('../config.php');


	
    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT cat_name FROM ' .
        $GLOBALS['table_prefix'] .'categories ORDER BY cat_id');

	$x=1;
    while($fila = mysqli_fetch_row($consulta)){
		print '<option value="'.$x.'">'.$fila[0].'</option>';
		$x++;
	}
	
mysqli_close($GLOBALS['conexion']);

?>			
		</select>
		</p>
		<input id="enviar" name="admin_upload" type="submit"/>
	</form>
	</div>
<?php
mostrarfecha_y_hora();
include('footer.html');
?>