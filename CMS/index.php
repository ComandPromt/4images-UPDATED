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

	$mysqli = new mysqli($db_host, $db_user, $db_password, 'mysql');
	
	$mysqli->set_charset("utf8");

    $consulta = $mysqli->query( "SHOW DATABASES");

    while ($fila = $consulta->fetch_row()) {
        $tablas[] = $fila[0];
    }
	
	$mysqli->close();

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

print '<div style="margin-left:-75px;padding-top:50px;font-size:2em;">


<div style="float:left;">
	<a target="_blank" title="rss" href="'.$ruta.'rss.php">
			<img style="margin-top:20px;margin-left:40px;" class="icono" src="'.$ruta.'img/rss.png" alt="RSS Feed: '.$GLOBALS['site_name'].'" />
		</a>
	<h1 style="font-size:0.8em;color:#0F4B90;padding-left:20px;">' . date('d') . '/' . date('m') . '/' . date('Y') . '</h1>
	<h2 style="padding-top:50px;font-size:0.8em;margin-top:-60px;padding-left:20px;" id="reloj"></h2>
</div>

<div style="margin:auto;padding-left:20px;float:left;padding-right:20px;">';

categoria_link();

if(!logueado()){

	print '<a title="' . ver_dato('register', $GLOBALS['idioma']) . '" href="register.php">
			<img style="margin-top:20px;" alt="' . ver_dato('register', $GLOBALS['idioma']) . '" class="icono" src="img/registrar.png"/>
		</a>';
		
		
		// Si el comentario es publico mostrar icono
		
		
		/*print '		
		<a title="' . ver_dato('upload', $GLOBALS['idioma']) . '" href="comments.php">
					
		<img style="margin-top:20px;" alt="' . ver_dato('upload', $GLOBALS['idioma']) . '" class="icono" src="img/coment.png"/>
		</a>';*/
		
		
		// Si existe categoria Links mostrar
	
}
		
		if(file_exists('forum')){
			
		print '<a title="foro" target="_blank" href="forum">
			<img style="margin-top:20px;" class="icono" src="'.$ruta.'img/forum.png" alt="Ir al foro" />
		</a>';	
		
		}
		
?>

	</div>	

<div>

<div style="float:right;padding-left:260px;margin-top:240px;padding-top:100px;
		"
        class="entire-content col-xs-4 transparente" >

<?php

if (file_exists('config.php') && logueado()) {

	$mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);


	$consulta = $mysqli->query('SELECT COUNT(image_id) FROM ' . $GLOBALS['table_prefix'].

    'images WHERE image_active=1 ORDER BY image_id DESC LIMIT 9');

    $fila = $consulta->fetch_row();

    if ($fila[0] > 0) {

        print '

		<div style="background-color: rgba(255, 255, 255, 0);" class="content-carrousel content">';

        $consulta = $mysqli->query('SELECT cat_id,image_media_file,image_id,image_name FROM '.
        
        $GLOBALS['table_prefix'] . 'images WHERE image_active=1	ORDER BY image_iD DESC LIMIT 9');

        while ($fila = $consulta->fetch_row()) {

            print '<figure style="width:3em;height:3em;margin:auto;"
          class="shadow"><a title="' . $fila[3] . '" href="details.php?image_id=' . $fila[2] . '"> <img alt="' . $fila[2] . '" style="width:3em;height:3em;"
          src="data/media/' . $fila[0] . '/' . $fila[1] . '"/></a></figure>';
        }
		
	   $mysqli->close();
	
		print '<h1 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('welcome', $GLOBALS['idioma']) . '</h1>';

		if(isset($_COOKIE['4images_userid']) && $_COOKIE['4images_userid']>0){
			$GLOBALS['idioma'] = saber_idioma($_COOKIE['4images_userid']);
		}

		print '	<h2 style="background-color: rgba(255, 255, 255, 0);">' . ver_dato('new_img', $GLOBALS['idioma']) . '</h2>'; 
	
    }
	
  print '</div>';
	
}

else{
		registrar();
}

print '</div></div>
	
</div>';

restablecer_pass();


footer();

?>