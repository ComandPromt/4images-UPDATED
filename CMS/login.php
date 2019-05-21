<?php
session_start();

if(!isset($_SESSION['pagina'])||$_SESSION['pagina']==""){
	$_SESSION['pagina']='index.php';
}

include_once('config.php');

include_once('includes/funciones.php');

$_POST['user_name']=trim($_POST['user_name']);
$_POST['user_password']=trim($_POST['user_password']);

$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_password,user_id
FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$_POST['user_name']."'");

if(mysqli_affected_rows($GLOBALS['conexion'])==1){
	
$fila = mysqli_fetch_row($consulta);

if(compare_passwords($_POST['user_password'], $fila[0])){
	setcookie('4images_userid',$fila[1],time()+3600);
}
}

mysqli_close($GLOBALS['conexion']);	

echo '<script>location.href="'.$_SESSION['pagina'].'";</script>';

?>