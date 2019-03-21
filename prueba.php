<?php
include_once ('config.php');
include('includes/funciones.php');


	$consulta=mysqli_query($GLOBALS['conexion'],'SELECT user_name,user_password FROM '.$GLOBALS['table_prefix']."users WHERE user_name='ComandPromt'");
	$usuario = mysqli_fetch_row($consulta);
	
	if(gettype($usuario[0])=='string' && compare_passwords('ratonatqm71114',$usuario[1])){
	
		$login=true;
	
	}

	else{
		print "fallaste";
	}

/*
if(compare_passwords('admin','31d4c61be:ec7d98b9bac1213bb13dd3a14435161d')){
	print "OK";
}
else{
	print "fallaste";
}*/
 ?>