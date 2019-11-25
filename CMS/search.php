<?php

session_start();

$_SESSION['categoria']=$_GET['cat_id'];

$_SESSION['track']=false;

include_once('config.php');

include('includes/funciones.php');

if(!logueado()){
	redireccionar('register.php');
}

cabecera();

poner_menu();

if(isset($_POST['busqueda'])){
	$_SESSION['filtro']=$_POST['filtro'];
	redireccionar('search.php?filtro='.$_SESSION['filtro']);
}
		
if(isset($_GET['filtro']) && $_GET['filtro']!=""){
	$_SESSION['filtro']=$_GET['filtro'];
}

$_SESSION['track']=true;
	
print '<div style="float:left;padding-top:100px;">
			<h1 style="font-size:2em;padding-left:40px">' . date('d') . '/' . date('m') . '/' . date('y') . '</h1>
			<h2 style="padding-top:40px;padding-bottom:40px;font-size:2em;padding-left:40px;margin-top:-60px;" id="reloj"></h2>
		</div>';
		
print '<div style="margin-top:40px;text-align:center;float:right;">
		
	<form action="'.$_SERVER['PHP_SELF'].'" method="post">
		<label style="font-size:2em;" for="filtro">'.ver_dato('search', $GLOBALS['idioma']).'</label>
		<img alt="'.ver_dato('search', $GLOBALS['idioma']).'" style="margin-bottom:20px;" class="icono" src="img/search.png"/>
		<input id="filtro" name="filtro" style="margin-bottom:20px;height:40px;font-size;25px;" type="text"/>
		<input name="busqueda" value="'.ver_dato('submit', $GLOBALS['idioma']).'" type="submit"/>
	</form>
	
</div>

<div style="float:left;width:100%;">
	<hr/>
</div>
';

	if( isset($_GET['cat_id']) && $_GET['cat_id']>0 && isset($_GET['pag']) && $_GET['pag']>0 || $_SESSION['categoria']>0){
		
		if($_SESSION['categoria']>0){
			$categoria=$_SESSION['categoria'];
		}
		
		else{
			$categoria=$_GET['cat_id'];
		}

		ver_categoria($categoria);
	}
	
	else{	
		ver_categoria('*',"WHERE image_name LIKE '%".$_SESSION['filtro']."%'");
	}	
		restablecer_pass();
	
footer();

?>