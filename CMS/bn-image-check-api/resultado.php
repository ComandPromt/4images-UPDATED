<?php

session_start();

include('funciones.php');

header('Content-Type:application/json');

if(isset($_GET['respuesta'])){
	
	if($_GET['respuesta']){
		deliver_response(200, true);
	}

	else{
		deliver_response(200, false);
	}
	
}

else{
	deliver_response(400, true);
}

session_unset();

?>