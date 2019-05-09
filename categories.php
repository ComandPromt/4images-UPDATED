<?php

session_start();

$_SESSION['pagina']="categories.php";

include('cabecera.php');

$_GET['cat_id']=trim($_GET['cat_id']);
	
$_GET['cat_id']=(int)$_GET['cat_id'];
	
	if(is_int($_GET['cat_id']) && $_GET['cat_id']>0){
		$_SESSION['categoria']=$_GET['cat_id'];
	}

	if($_GET['cat_id']>0 || $_SESSION['categoria']>0 && $_GET['cat_id']>0){
		
		if($_SESSION['categoria']>0){
			$categoria=$_SESSION['categoria'];
		}
		
		else{
			$categoria=$_GET['cat_id'];
		}
		
		poner_menu();
		
		print '<br/><br/>';
		
		ver_categoria($categoria);
		
		restablecer_pass();
	}
	else{
redireccionar('index.php');
	}

include('footer.html');
 
?>