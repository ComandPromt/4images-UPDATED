<?php
include('cabecera.php');

poner_menu();

print '<div class="container" style="width:113%;margin-auto;padding-top:100px;"><form>
<p><label><img class="icono" src="img/emaill.png"/></label><select>';
	
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
$GLOBALS['db_password'], $GLOBALS['db_name'])
or die("No se pudo conectar a la base de datos");
$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id,user_name FROM '.$GLOBALS['table_prefix']."users WHERE user_id>0 and user_id!='".$_COOKIE['4images_userid']."' ");
	
while($fila = mysqli_fetch_row($consulta)){
		print '<option value="'.$fila[0].'">'.$fila[1].'</option>';
}
	
mysqli_close($GLOBALS['conexion']);

print '</option>
</select></p>
<p>
<p>Asunto:
<input type="text" />
</p>
<textarea style="height:200px;font-size:25px;color:#8105F1;"></textarea></p>
<input type="submit"/>
</form></div>';


restablecer_pass();

footer();

?>