<?php

session_start();

?>

<div style="margin:auto;text-align:center;">
	<form action="input.php" method="post">
		<p><label><img style="height:40px;width:40px;" src="../img/user.png"/></label>
		<input style="font-size:20px;text-align:center;" name="usuario"  type="text" />
		</p>
		<p><label><img style="height:40px;width:40px;" src="../img/user_pass.png"/></label>
		
		<input style="font-size:20px;text-align:center;" name="password" type="password"/> 
		</p>
		<p>
		<label><img style="height:40px;width:40px;" src="../img/tag.png"/>
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
		<input type="submit"/>
	</form>
	</div>
</body>