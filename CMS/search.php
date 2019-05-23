<?php
include('cabecera.php');

poner_menu();

print '<div style="margin-top:40px;text-align:center;float:right;">
<form action="'.$_SERVER['PHP_SELF'].'" method="post">
	<img style="margin-bottom:20px;" class="icono" src="img/search.png"/>
	<input name="filtro" style="margin-bottom:20px;height:40px;font-size;25px;" type="text"/>
	<input name="busqueda" type="submit"/>
</form></div>';

if(isset($_POST['busqueda'])){
	print '<div style="float:left;width:115%;">
					<hr/>
					</div>';
	ver_categoria('*',"WHERE image_name LIKE '%".$_POST['filtro']."%'");
}


restablecer_pass();

footer();
?>