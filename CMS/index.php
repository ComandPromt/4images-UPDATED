<?php

session_start();

include_once ('includes/funciones.php');

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
	
	if (file_exists('img/Install')) {
        rmDir_rf('img/Install');
    }
}

poner_menu();

if (isset($_COOKIE['4images_userid'])) {

    $_COOKIE['4images_userid'] = (int) $_COOKIE['4images_userid'];

    $GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);

}

print '<div id="menu_arriba">

<div class="flotar_izquierda">

	<a target="_blank" title="rss" href="'.$ruta.'rss.php">
			<img class="icono espacio_arriba_2 espacio_izquierda_2" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" />
    </a>
    
    <h1 id="fecha">' . date('d') . '/' . date('m') . '/' . date('Y') . '</h1>
    
    <h2 id="reloj"></h2>
    
</div>

<div id="menu_indice">';

if(!logueado()){

    print '<a title="' . ver_dato('register', $GLOBALS['idioma']) . '" href="register.php">
    
			<img alt="' . ver_dato('register', $GLOBALS['idioma']) . '" class="icono espacio_arriba_2" src="img/registrar.png"/>
        </a>
        
        <a href="register.php">

            <img alt="registrar"  class="icono2" src="img/reg-now.gif"/>

        </a>';
		
		
		// Si el comentario es publico mostrar icono
		
		
		/*print '		
				
		<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="comments.php">
			<img style="margin-top:20px;" alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/coment.png"/>
		</a>';*/
				
}

else{

	print '<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="comments.php">
			<img alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono espacio_arriba_2" src="img/coment.png"/>
		</a>
		
		<a title="' . ver_dato('search', $GLOBALS['idioma']) . '" href="search.php">
			<img alt="' . ver_dato('search', $GLOBALS['idioma']) . '" class="icono espacio_arriba_2" src="img/search.png"/>
        </a>';
        
}
    
if(file_exists('forum')){
			
    print '<a title="foro" target="_blank" href="forum">
			    <img class="icono espacio_arriba_2" src="'.$ruta.'img/forum.png" alt="Ir al foro" />
		    </a>';	
		
}
		
print '</div>';

if (file_exists('config.php') && logueado()) {

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],

    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'],'SELECT COUNT(image_id) FROM ' . $GLOBALS['table_prefix'].

    'images WHERE image_active=1 ORDER BY image_id DESC LIMIT 9');

    $fila = mysqli_fetch_array($consureg-a);

    if ($fila[0] > 0) {

        print '<div class="content-carrousel content transparente">';

        $consulta = mysqli_query($GLOBALS['conexion'],'SELECT cat_id,image_media_file,image_id,image_name FROM '.
        
        $GLOBALS['table_prefix'] . 'images WHERE image_active=1	ORDER BY image_iD DESC LIMIT 9');

        $num_lineas=mysqli_num_rows($consulta);

        if($num_lineas>=9){

            print '<div class="menu_figura flotar_derecha entire-content col-xs-4 transparente" >';

            while ($fila = mysqli_fetch_array($consulta)) {

                print '<figure id="figura" class="shadow">
                            <a title="' . $fila[3] . '" href="details.php?image_id=' . $fila[2] . '"> 
                                <img alt="' . $fila[2] . '" class="imagen_figura" src="data/media/' . $fila[0] . '/' . $fila[1] . '"/>
                            </a>
                        </figure>';
            }

        }

	    mysqli_close($GLOBALS['conexion']);
    
        if($num_lineas>=9){
		print '<h1 class="transparente">' . ver_dato('welcome', $GLOBALS['idioma']) . '</h1>';

		if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>0){
			$GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);
		}

        print '	<h2 class="transparente">' . ver_dato('new_img', $GLOBALS['idioma']) . '</h2>
        </div>'; 

        }
    }

}

print '</div>
	</div>';

restablecer_pass();

footer();

?>