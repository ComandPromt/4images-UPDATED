<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

poner_menu();

print '<div style="margin-top:40px;text-align:center;float:right;">
<form action="'.$_SERVER['PHP_SELF'].'" method="post">
	<img alt="'.ver_dato('search', $GLOBALS['idioma']).'" style="margin-bottom:20px;" class="icono" src="img/search.png"/>
	<input name="filtro" style="margin-bottom:20px;height:40px;font-size;25px;" type="text"/>
	<input name="busqueda" type="submit"/>
</form></div>';

if(isset($_POST['busqueda']) ||isset($_GET['filtro']) && $_GET['filtro']!=""){
	
	if($_GET['filtro']!=""){
		$filtro=$_POST['filtro'];
	}
	
	else{
		$filtro=$_POST['filtro'];
	}
		
	print '<div style="float:left;width:115%;">
					<hr/>
					</div>';
					
	ver_categoria('*',"WHERE image_name LIKE '%".$filtro."%'");
}

restablecer_pass();

footer();

?>