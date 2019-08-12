<?php

include ('includes/funciones.php');

if(logueado){
	
	if(isset($_GET['image_id']) && (int)$_GET['image_id']>0 && isset($_GET['del']) && $_GET['del']=="true"){
		unset($_SESSION['del_comment']);
		redireccionar('details.php?image_id='.$_GET['image_id']);	
	}
	
	else{
		session_start();

		$_SESSION['del_comment']=$_REQUEST['img_id'];

		echo $_REQUEST['img_id']; 
	}
	
	$_SESSION['contar']=false;
}

else{
	redireccionar('index.php');	
}

?> 