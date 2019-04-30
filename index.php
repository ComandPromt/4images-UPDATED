<?php

include ('cabecera.php');
include_once ('includes/funciones.php');

$tablas = array();

if (file_exists('config.php')) {

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
        header('Location:install.php');
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

print '<div style="float:right;"><p style="background-color:#f3f9ff;margin-top:10px;margin-left:-70px;position:fixed" id="reloj"></p></div>
<div style="padding-top:80px;font-size:30px;position:fixed;">
<div style="height:40px;"><img style="margin-left:50px;" class="icono" src="img/rss.png"/>&nbsp;<img class="icono" src="img/top.png"/>&nbsp;<img class="icono" src="img/new.png"/>&nbsp;&nbsp;<img class="icono" src="img/view.png"/>
</div>
<div><br/>
TEXT HERE
</div>

</div>

<div style="float:left;">
		
		</div>

';
  include('footer.html');
?>