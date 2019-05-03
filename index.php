<?php

include ('cabecera.php');
include_once ('includes/funciones.php');

$tablas = array();

if (file_exists('config.php')) {
    
    if (file_exists('install.php')) {
        unlink('install.php');
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

print '<div style="padding-top:80px;font-size:30px;position:fixed;">
<p style="margin-left:50%;background-color:#f3f9ff;">'.date('d').'/'.date('m').'/'.date('y').'</p>
<p style="margin-top:-60px;margin-left:50%;background-color:#f3f9ff;" id="reloj"></p>

<div style="height:40px;margin-top:-30px;">
    <img alt="RSS" style="margin-left:50px;" class="icono" src="img/rss.png"/>&nbsp;
    <img alt="top images" class="icono" src="img/top.png"/>&nbsp;
    <img alt="new images" class="icono" src="img/new.png"/>&nbsp;&nbsp;
    <img alt="all images" class="icono" src="img/view.png"/>
</div>
<div><br/>

<div style="margin-bottom:200%;"id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">	  
		<ol class="carousel-indicators">'.
		$button_html.'		
		</ol>	  
		<div class="carousel-inner">'.	  
			$slider_html.'
		</div>	 
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>	 
'.$thumb_html.'
		</ul>
	</div>	

</div>

</div>

<div style="float:left;">
		
        </div>

';
  include('footer.html');
?>