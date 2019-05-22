<?php

session_start();
include('cabecera.php');
?>

<div style="margin-left:40px;" class="container">
	<form action="input.php" method="post">
	
		<p><label><img alt="usuario" class="icono" src="../img/user.png"/></label>
		<input id="usuario" style="font-size:20px;text-align:center;" name="usuario"  type="text" />
		</p>
		
		<p><label><img alt="password" class="icono" src="../img/user_pass.png"/></label>
		
		<input id="pass" style="font-size:20px;text-align:center;" name="password" type="password"/> 
		</p>
		
		<p><label><img alt="nombre" class="icono" src="../img/add_tag.png"/></label>

		<input id="nombre" style="font-size:20px;text-align:center;" name="nombre" type="password"/> 
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
		<input id="enviar" type="submit"/>
	</form>
	</div>
</body>