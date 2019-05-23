<?php

session_start();

$_SESSION['pagina']="index.php";

include ('cabecera.php');
include_once ('includes/funciones.php');

$tablas = array();

if (file_exists('config.php')) {
    
    if (file_exists('install.php')) {
        unlink('install.php');
		
    }
	
    if (file_exists('includes/constants.php')) {
        unlink('includes/constants.php');
		
    }
	
	if (file_exists('includes/db_mysqli.php')) {
        unlink('includes/db_mysqli.php');
		
    }
	
	if (file_exists('includes/db_utils.php')) {
        unlink('includes/db_utils.php');
		
    }
	
    include ('config.php');
    $conexion = mysqli_connect($db_host, $db_user, $db_password, 'mysql');
    mysqli_set_charset($conexion, "utf8");
    $consulta = mysqli_query($conexion, "SHOW DATABASES");

    while ($fila = mysqli_fetch_row($consulta)) {
        $tablas[] = $fila[0];
    }

}

if (!in_array($db_name, $tablas)) {
	
    if (file_exists('config.php')) {
        unlink('config.php');
    }
	
    unset($tablas);
	
    if (file_exists('install.php')) {
       redireccionar('install.php');
    } else {
        'Debes tener el archivo install.php';
    }

} else {
    if (file_exists('install.php')) {
        unlink('install.php');
    }

    if (file_exists('lang')) {
        rmDir_rf('lang');
    }
} 

poner_menu();

print '<div style="padding-top:80px;font-size:30px;position:fixed;">
<p style="padding-left:40px">'.date('d').'/'.date('m').'/'.date('y').'</p>
<p style="padding-left:40px;margin-top:-60px;" id="reloj"></p>

<div style="margin:auto;height:100px;margin-top:-20px;padding-left:40px;">
    <a href="top.php"><img alt="top images" class="icono" src="img/top.png"/></a>
    <a href="todos.php"><img alt="all images" class="icono" src="img/view.png"/></a>
	<a href="search.php"><img alt="all images" class="icono" src="img/search.png"/></a>
</div>
<div><br/>
';

if(file_exists('config.php')){
	
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	
$consulta = mysqli_query($GLOBALS['conexion'],
'SELECT COUNT(image_id) FROM '.$GLOBALS['table_prefix'].'images
  ORDER BY image_id DESC LIMIT 9');
  $fila = mysqli_fetch_array($consulta);

  if($fila[0]>1){

    print '
    <div style="float:right;padding-left:350px;" class="entire-content">
      <div style="margin-top:-40px;width:10px;"class="content-carrousel">';
      $consulta = mysqli_query($GLOBALS['conexion'],
      'SELECT cat_id,image_media_file,image_id FROM '.$GLOBALS['table_prefix'].'images
      ORDER BY image_iD DESC LIMIT 9');
      
      while ($fila = mysqli_fetch_array($consulta)){
    
          print '<figure style="width:120px;height:120px;"
          class="shadow"><a href="details.php?image_id='.$fila[2].'"> <img style="width:120px;height:120px;" 
          src="data/media/'.$fila[0].'/'.$fila[1].'"/></a></figure>';
      }
    
       print '  </div>
    </div>';
  }
  mysqli_close($GLOBALS['conexion']);
} 
  print'
</div>

</div>';

restablecer_pass();

footer();

?>