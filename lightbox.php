<?php

$_GET['image_id']=(int)$_GET['image_id'];

if(isset($_GET['action']) && $_GET['image_id']>0 && ($_GET['action']=='guardar' || $_GET['action']=='eliminar') ){
	
	$conexion= mysqli_connect('192.168.1.100','ComandPromt','ratonatqm71114','cms');

	if($_GET['action']=='eliminar'){
		$sql="DELETE FROM 4images_lightboxes WHERE lightbox_image_id=".$_GET['image_id']." and user_id=".$_COOKIE['4images_userid'];

	}
	else{
		$sql="INSERT into 4images_lightboxes values (1,".$_GET['image_id'].")";

	}
			
	echo mysqli_query($conexion,$sql);
}

 ?>