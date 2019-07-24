<?php

session_start();

include_once 'includes/funciones.php';

$_SESSION['pagina'] = "index.php";

$_SESSION['track'] = true;

$tablas = array();

if (file_exists('config.php')) {

    if (file_exists('install.php')) {
        unlink('install.php');

    }

    if (file_exists('data/database/default/sentencias.sql')) {
        unlink('data/database/default/sentencias.sql');
    }

    include('config.php');

    cabecera();

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

if (isset($_COOKIE['4images_userid'])) {

    $_COOKIE['4images_userid'] = (int) $_COOKIE['4images_userid'];

    $GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);

}

print '<div style="padding-top:60px;font-size:2em;">

<div style="float:right;padding-left:70%;padding-right:20px;padding-top:50px;">

<h2 style="padding-top:15px;padding-bottom:40px;font-size:0.8em;margin-top:-60px;" id="reloj"></h2>

</div>

<div style="float:left;margin-top:-40px;">
<h1 style="font-size:0.8em;color:#0F4B90;">' . date('d') . '/' . date('m') . '/' . date('Y') . '</h1>


</div>


<div style="margin:auto;margin-top:10px;padding-left:40px;float:left;padding-right:20px;">';

if(!logueado()){

	print '<div style="float:left;"><a title="' . ver_dato('register', $GLOBALS['idioma']) . '" href="register.php">
			<img alt="' . ver_dato('register', $GLOBALS['idioma']) . '" class="icono" src="img/registrar.png"/>
		</a></div>';
}

else{

	print '<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="upload_images/index.php">
			<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/upload.png"/>
		</a>
		
		<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="my_uploads.php">
			<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/my_uploads.ico"/>
		</a>
		
		<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="favoritos.php">
			<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/fav_2.ico"/>
		</a>
		
		<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="comments.php">
			<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/coment.png"/>
		</a>
		';
}

print '
		
		<a title="' . ver_dato('search', $GLOBALS['idioma']) . '" href="search.php">
			<img alt="' . ver_dato('search', $GLOBALS['idioma']) . '" class="icono" src="img/search.png"/>
		</a>
		
		<a title="rss" href="'.$ruta.'rss.php">
			<img class="icono" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" />
		</a>
	</div>	


<div><br/>
';

if (file_exists('config.php')) {

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],

    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'],'SELECT COUNT(image_id) FROM ' . $GLOBALS['table_prefix'].

    'images WHERE image_active=1 ORDER BY image_id DESC LIMIT 9');

    $fila = mysqli_fetch_array($consulta);

    if ($fila[0] > 0) {

        print '<div style="float:right;padding-left:250px;margin-top:200px;padding-top:60px;background-color: rgba(255, 255, 255, 0);"
        class="entire-content col-xs-4" >

		<div style="background-color: rgba(255, 255, 255, 0);" class="content-carrousel content">';

        $consulta = mysqli_query($GLOBALS['conexion'],'SELECT cat_id,image_media_file,image_id,image_name FROM '.
        
        $GLOBALS['table_prefix'] . 'images WHERE image_active=1	ORDER BY image_iD DESC LIMIT 9');

        while ($fila = mysqli_fetch_array($consulta)) {

            print '<figure style="width:3em;height:3em;margin:auto;"
          class="shadow"><a title="' . $fila[3] . '" href="details.php?image_id=' . $fila[2] . '"> <img alt="' . $fila[2] . '" style="width:3em;height:3em;"
          src="data/media/' . $fila[0] . '/' . $fila[1] . '"/></a></figure>';
        }
		
	    mysqli_close($GLOBALS['conexion']);
	
		print '<h1 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('welcome', $GLOBALS['idioma']) . '</h1>';

		if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>0){
			$GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);
		}

		print '	<h2 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('new_img', $GLOBALS['idioma']) . '</h2>'; 
	
    }
  
	print '</div></div>';
}

print '</div>

</div>';

restablecer_pass();


footer();

?>