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

    include_once 'config.php';

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

print '<div style="padding-top:80px;font-size:2em;position:fixed;">
<h2 style="font-size:1em;padding-left:40px">' . date('d') . '/' . date('m') . '/' . date('y') . '</h2>
<h2 style="padding-top:40px;padding-bottom:40px;font-size:1em;padding-left:40px;margin-top:-60px;" id="reloj"></h2>

<div style="margin:auto;margin-top:-20px;padding-left:40px;">
    <a title="' . ver_dato('top', $GLOBALS['idioma']) . '" href="top.php"><img alt="' . ver_dato('top', $GLOBALS['idioma']) . '" class="icono" src="img/top.png"/></a>
    <a title="' . ver_dato('all', $GLOBALS['idioma']) . '" href="todos.php"><img alt="' . ver_dato('all', $GLOBALS['idioma']) . '" class="icono" src="img/view.png"/></a>
	<a title="' . ver_dato('search', $GLOBALS['idioma']) . '" href="search.php"><img alt="' . ver_dato('search', $GLOBALS['idioma']) . '" class="icono" src="img/search.png"/></a>
</div>

<div><br/>
';

if (file_exists('config.php')) {

    include 'config.php';
    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'],
        'SELECT COUNT(image_id) FROM ' . $GLOBALS['table_prefix'] . 'images
	ORDER BY image_id DESC LIMIT 9');
    $fila = mysqli_fetch_array($consulta);

    if ($fila[0] > 0) {

        print '
		<div style="float:right;padding-left:350px;background-color: rgba(255, 255, 255, 0);" class="entire-content">

		<div style="margin-top:-40px;background-color: rgba(255, 255, 255, 0);"class="content-carrousel">';

        $consulta = mysqli_query($GLOBALS['conexion'],
            'SELECT cat_id,image_media_file,image_id,image_name FROM ' . $GLOBALS['table_prefix'] . 'images
		ORDER BY image_iD DESC LIMIT 9');

        while ($fila = mysqli_fetch_array($consulta)) {

            print '<figure style="width:4em;height:4em;"
          class="shadow"><a title="' . $fila[3] . '" href="details.php?image_id=' . $fila[2] . '"> <img alt="' . $fila[2] . '" style="width:4em;height:4em;"
          src="data/media/' . $fila[0] . '/' . $fila[1] . '"/></a></figure>';
        }

 print '<h1 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('welcome', $GLOBALS['idioma']) . '</h1>';

		$GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);
		print '	<h2 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('new_img', $GLOBALS['idioma']) . '</h2>'; 
	
    }
   
	mysqli_close($GLOBALS['conexion']);
	
	print '</div></div>';
}

print '</div>

</div>';

restablecer_pass();

footer();

?>
