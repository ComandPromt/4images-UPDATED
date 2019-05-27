<?php

session_start();

if(!isset($_SESSION['pagina'])||$_SESSION['pagina']==""){
	$_SESSION['pagina']='index.php';
}

include_once('config.php');

include_once('includes/funciones.php');

$usuario="";
$pass="";

if(isset($_GET['user_name']) && isset($_GET['user_password'])){
	
	$usuario=$_GET['user_name'];
	$pass=$_GET['user_password'];
}

else{
	$usuario=trim($_POST['user_name']);
	$pass=trim($_POST['user_password']);
}

$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_password,user_id
FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$usuario."'");

if(mysqli_affected_rows($GLOBALS['conexion'])==1){
	
	$fila = mysqli_fetch_row($consulta);

	if(compare_passwords($pass, $fila[0]) || $pass==$fila[0]){
		
		
			setcookie('4images_userid',$fila[1],time()+3600);
		
			setcookie('pass',$fila[0],time()+3600);
		

	}
}

mysqli_close($GLOBALS['conexion']);	

redireccionar($_SESSION['pagina']);

?>