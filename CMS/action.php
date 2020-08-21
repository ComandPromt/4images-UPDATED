<?php

include ('includes/funciones.php');

include ('config.php');

if(!isset($_GET['image_id'])){
	
	redireccionar('index.php');	

}

if(logueado()){
	
	if(isset($_GET['image_id']) && (int)$_GET['image_id']>0 && isset($_GET['del']) && $_GET['del']=="false"){
		
		unset($_SESSION['del_comment']);
		
	}
	
	if(isset($_GET['image_id']) && (int)$_GET['image_id']>0 && isset($_GET['del']) && $_GET['del']=="true"){
		
		unset($_SESSION['edit_comment']);
		
	}
	
	else{
		
		session_start();

		$_SESSION['edit_comment']=$_REQUEST['img_id'];

		echo $_REQUEST['img_id']; 
		
	}
	
	$_SESSION['contar']=false;

	$_GET['image_id']=str_replace("'","",$_GET['image_id']);

	$_GET['image_id']=(int)$_GET['image_id'];

	if($_GET['image_id']>0){
		
		redireccionar('details.php?image_id='.$_GET['image_id']);
	}
	
	else{
	
		redireccionar('index.php');	
		
	}
	
}

else{
	redireccionar('index.php');	
	
}

?> 
