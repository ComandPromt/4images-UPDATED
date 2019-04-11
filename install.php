<?php
error_reporting(0);
include_once('includes/funciones.php');
crear_carpetas();

if ($_GET['install_lang'] == '' && !isset($_POST['submit'])) {
    header('Location:install.php?install_lang=spanish');
}

if (function_exists('set_magic_quotes_runtime')) {
    @set_magic_quotes_runtime(0);
}

if (!function_exists('date_default_timezone_set')) {
    function date_default_timezone_set($timezone)
    {
        return true;
    }
}

define('ROOT_PATH', './');

function addslashes_array($array){

    foreach ($array as $key => $val) {
        $array[$key] = (is_array($val)) ? addslashes_array($val) : addslashes($val);
    }

    return $array;
}

function get_timezone_by_offset($offset){
    $timezones = array(
        '-12' => 'Pacific/Kwajalein',
        '-11' => 'Pacific/Samoa',
        '-10' => 'Pacific/Honolulu',
        '-9.5' => 'Pacific/Marquesas',
        '-9' => 'America/Juneau',
        '-8' => 'America/Los_Angeles',
        '-7' => 'America/Denver',
        '-6' => 'America/Mexico_City',
        '-5' => 'America/New_York',
        '-4.5' => 'America/Caracas',
        '-4' => 'America/Caracas',
        '-3.5' => 'America/St_Johns',
        '-3' => 'America/Argentina/Buenos_Aires',
        '-2' => 'Atlantic/South_Georgia',
        '-1' => 'Atlantic/Azores',
        '0' => 'Europe/London',
        '1' => 'Europe/Berlin',
        '2' => 'Europe/Helsinki',
        '3' => 'Europe/Moscow',
        '3.5' => 'Asia/Tehran',
        '4' => 'Asia/Baku',
        '4.5' => 'Asia/Kabul',
        '5' => 'Asia/Karachi',
        '5.5' => 'Asia/Calcutta',
        '5.75' => 'Asia/Kathmandu',
        '6' => 'Asia/Colombo',
        '6.5' => 'Indian/Cocos',
        '7' => 'Asia/Bangkok',
        '8' => 'Asia/Singapore',
        '8.75' => 'Australia/Eucla',
        '9' => 'Asia/Tokyo',
        '9.5' => 'Australia/Darwin',
        '10' => 'Pacific/Guam',
        '10.5' => 'Australia/Lord_Howe',
        '11' => 'Asia/Magadan',
        '11.5' => 'Pacific/Norfolk',
        '12' => 'Asia/Kamchatka',
        '12.75' => 'Pacific/Chatham',
        '13' => 'Pacific/Enderbury',
        '14' => 'Pacific/Kiritimati',
    );

    if (isset($timezones[$offset])) {
        return $timezones[$offset];
    }

    return $timezones['1'];
}

if (file_exists('config.php')) {
    unlink('config.php');
    header('Location:install.php');
} else {
    if (!isset($HTTP_GET_VARS)) {
        $HTTP_GET_VARS = $_GET;
        $_POST = $_POST;
        $HTTP_COOKIE_VARS = $_COOKIE;
        $HTTP_POST_FILES = $_FILES;
        $HTTP_SERVER_VARS = $_SERVER;
        $HTTP_ENV_VARS = $_ENV;
    }

    if (get_magic_quotes_gpc() == 0) {
        $HTTP_GET_VARS = addslashes_array($HTTP_GET_VARS);
        $_POST = addslashes_array($_POST);
        $HTTP_COOKIE_VARS = addslashes_array($HTTP_COOKIE_VARS);
    }

    if (@file_exists(ROOT_PATH . 'config.php')) {
        include ROOT_PATH . 'config.php';
    } else {
        date_default_timezone_set('CET');
    }

    if (defined('4IMAGES_ACTIVE')) {
        header('Location: index.php');
        exit;
    }

    if (isset($HTTP_GET_VARS['action']) || isset($_POST['action'])) {
        $action = (isset($HTTP_GET_VARS['action'])) ? stripslashes(trim($HTTP_GET_VARS['action'])) : stripslashes(trim($_POST['action']));
    } else {
        $action = '';
    }

    if ($action == '') {
        $action = 'intro';
    }

    $lang_select = '';
    $folderlist = array();
    $handle = opendir(ROOT_PATH . 'lang');

    while ($folder = @readdir($handle)) {
        if (@is_dir(ROOT_PATH . "lang/$folder") && $folder != '.' && $folder != '..') {
            $folderlist[] = $folder;
        }
    }

    sort($folderlist);

    for ($i = 0; $i < sizeof($folderlist); ++$i) {
        $lang_select .= '<a href="install.php?install_lang=' . $folderlist[$i] . '"><img alt="' . $folderlist[$i] . '" style="height:100px;width:100px;" src="img/Install/' . $folderlist[$i] . '.png"/></a>';
    }

    closedir($handle);

    if (isset($HTTP_GET_VARS['install_lang']) || isset($_POST['install_lang'])) {
        $install_lang = (isset($HTTP_GET_VARS['install_lang'])) ? trim($HTTP_GET_VARS['install_lang']) : trim($_POST['install_lang']);
    }

    if (isset($_POST['submit'])) {
        $install_lang = $_POST['idioma'];
    }

    $lang = array();
    include ROOT_PATH . 'lang/' . $install_lang . '/install.php';

    $db_servertype = (isset($_POST['db_servertype'])) ? trim($_POST['db_servertype']) : 'mysqli';
    $db_host = (isset($_POST['db_host'])) ? trim($_POST['db_host']) : '';
    $db_name = (isset($_POST['db_name'])) ? trim($_POST['db_name']) : '';
    $db_user = (isset($_POST['db_user'])) ? trim($_POST['db_user']) : '';
    $db_password = (isset($_POST['db_password'])) ? trim($_POST['db_password']) : '';
    $table_prefix = (isset($_POST['table_prefix'])) ? trim($_POST['table_prefix']) : '4images_';
    $admin_user = (isset($_POST['admin_user'])) ? trim($_POST['admin_user']) : '';
    $admin_password = (isset($_POST['admin_password'])) ? trim($_POST['admin_password']) : '';
    $admin_password2 = (isset($_POST['admin_password2'])) ? trim($_POST['admin_password2']) : '';
    $selected_timezone = (isset($_POST['timezone_select'])) ? trim($_POST['timezone_select']) : '1';
    $selected_timezone = get_timezone_by_offset($selected_timezone);

    include ROOT_PATH . 'includes/constants.php';

    if ($action == 'downloadconfig') {
        header('Content-Type: text/x-delimtext; name="config.php"');
        header('Content-disposition: attachment; filename=config.php');
        $config_file = stripslashes(trim($_POST['config_file']));
        echo $config_file;
        exit;
    }

    echo '

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?php print $db_name;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="revisit-after" content="10 days">
	<script src="js/funciones.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/estilos.css">
	
        <link rel="stylesheet" href="css/scroll.css" />
        <link rel="stylesheet" href="css/prettify.css" />
        <link rel="stylesheet" href="css/jquery.scrollbar.css" />

		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="icon" type="image/ico" href="img/favicon.ico">
				<link rel="stylesheet" type="text/css" href="tooltip/css/estilo.css">
			       
	<title>Web</title>
	          <style>
			  .imagen{
				  height:60px;
				  width:60px;
			  }
			  *{
				  background-color:#ffffff;
				  margin:auto;
				  text-align:center;
				  font-size:20px;
			  }
                            /******************* WINDOWS VISTA SCROLLBAR *******************/

                            .scrollbar-vista > .scroll-content.scroll-scrolly_visible { left: -17px; margin-left: 17px; }
                            .scrollbar-vista > .scroll-content.scroll-scrollx_visible { top:  -17px; margin-top:  17px; }


                            .scrollbar-vista > .scroll-element {
                                background-color: #fcfdff;
                            }

                            .scrollbar-vista > .scroll-element,
                            .scrollbar-vista > .scroll-element *
                            {
                                border: none;
                                margin: 0;
                                overflow: hidden;
                                padding: 0;
                                position: absolute;
                                z-index: 10;
                            }

                            .scrollbar-vista > .scroll-element .scroll-element_outer,
                            .scrollbar-vista > .scroll-element .scroll-element_size,
                            .scrollbar-vista > .scroll-element .scroll-element_inner-wrapper,
                            .scrollbar-vista > .scroll-element .scroll-element_inner,
                            .scrollbar-vista > .scroll-element .scroll-bar,
                            .scrollbar-vista > .scroll-element .scroll-bar div
                            {
                                height: 100%;
                                left: 0;
                                top: 0;
                                width: 100%;
                            }

                            .scrollbar-vista > .scroll-element .scroll-element_outer,
                            .scrollbar-vista > .scroll-element .scroll-element_size,
                            .scrollbar-vista > .scroll-element .scroll-element_inner-wrapper,
                            .scrollbar-vista > .scroll-element .scroll-bar_body
                            {
                                background: none !important;
                            }


                            .scrollbar-vista > .scroll-element.scroll-x {
                                border-top: solid 1px #fcfdff;
                                bottom: 0;
                                height: 16px;
                                left: 0;
                                min-width: 100%;
                                width: 100%;
                            }

                            .scrollbar-vista > .scroll-element.scroll-y {
                                border-left: solid 1px #fcfdff;
                                height: 100%;
                                min-height: 100%;
                                right: 0;
                                top: 0;
                                width: 16px;
                            }

                           

                            .scrollbar-vista > .scroll-element.scroll-y div {
                                background-image: url("skins/vista-y.png");
                                background-repeat: repeat-y;
                            }

                            .scrollbar-vista > .scroll-element.scroll-x .scroll-arrow {}

                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar { min-width: 16px; background-position: 0px -34px; background-repeat: no-repeat; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_body { left: 2px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_body-inner { left: -4px; background-position: 0px -17px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_center { left: 50%; margin-left: -6px; width: 12px; background-position: 24px -34px; }
                            .scrollbar-vista > .scroll-element.scroll-x .scroll-bar_bottom { left: auto; right: 0; width: 2px; background-position: 37px -34px; }


                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar { min-height: 16px; background-position: -34px 0px; background-repeat: no-repeat; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_body { top: 2px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_body-inner { top: -4px; background-position: -17px 0px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_center { top: 50%; margin-top: -6px; height: 12px; background-position: -34px 24px; }
                            .scrollbar-vista > .scroll-element.scroll-y .scroll-bar_bottom { top: auto; bottom: 0; height: 2px; background-position: -34px 37px; }



                            /* SCROLL ARROWS */

                            .scrollbar-vista > .scroll-element .scroll-arrow { display: none; }
                            .scrollbar-vista > .scroll-element.scroll-element_arrows_visible .scroll-arrow { display: block; z-index: 12; }


                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-arrow_less { height: 100%; width: 17px; background-position: 0px -51px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-arrow_more { height: 100%; left: auto; right: 0; width: 17px; background-position: 17px -51px;}

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_outer { left: 17px; }
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_inner { left: -34px; }
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible .scroll-element_size { left: -34px; }


                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-arrow_less { width: 100%; height: 17px; background-position: -51px 0px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-arrow_more { width: 100%; top: auto; bottom: 0; height: 17px; background-position: -51px 17px;}

                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_outer { top: 17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_inner { top: -34px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible .scroll-element_size { top: -34px; }


                            /* PROCEED OFFSET IF ANOTHER SCROLL VISIBLE */

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size { left: -17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size { top: -17px; }

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_inner { left: -17px; }
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_inner { top: -17px; }


                            /* PROCEED OFFSET IF ARROWS & ANOTHER SCROLL */

                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-arrow_more { right: 17px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-element_inner { left: -51px;}
                            .scrollbar-vista > .scroll-element.scroll-x.scroll-element_arrows_visible.scroll-scrolly_visible .scroll-element_size { left: -51px;}


                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-arrow_more { bottom: 17px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-element_inner { top: -51px;}
                            .scrollbar-vista > .scroll-element.scroll-y.scroll-element_arrows_visible.scroll-scrollx_visible .scroll-element_size { top: -51px;}
                        </style>
	<style>
	@media only screen and (min-width: 900px) {
	#menu_usuario {
		opacity:0;
	}
}
	</style>
	<script>
		//Especificar a que elementos afectará, añadiendo o quitando de la lista:
		var tgs = new Array( "div","td","tr");
		
		//Indicar el nombre de los diferentes tamaños de fuente:
		var szs = new Array( "xx-small","x-small","small","medium","large","x-large","xx-large" );
		var startSz = 2;
		
		function ts( trgt,inc ) {
			if (!document.getElementById) return
			
			var d = document,cEl = null,sz = startSz,i,j,cTags;
			
			sz += inc;
			
			if ( sz < 0 ) sz = 0;
			if ( sz > 6 ) sz = 6;
			
			startSz = sz;
			
			if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];
			
			cEl.style.fontSize = szs[ sz ];
			
			for ( i = 0 ; i < tgs.length ; i++ ) {
				cTags = cEl.getElementsByTagName( tgs[ i ] );
				for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
			}
		}
		
		var captcha_reload_count = 0;
		var captcha_image_url = "./captcha.php";
		
		function new_captcha_image() {
			if (captcha_image_url.indexOf("?") == -1) {
				document.getElementById("captcha_image").src= captcha_image_url+"?c="+captcha_reload_count;
				} else {
				document.getElementById("captcha_image").src= captcha_image_url+"&c="+captcha_reload_count;
				}
		
			document.getElementById("captcha_input").value="";
			document.getElementById("captcha_input").focus();
			captcha_reload_count++;
		}
		
		
		if (document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = right;
		}
		else if (document.all && !document.getElementById){
			document.onmousedown = right;
		}
		var txt = "'.$GLOBALS['site_name'].'"
			document.oncontextmenu = new Function("alert(\'© Copyright by "+txt+"\');return false");
		
			txt=txt.toUpperCase();
			txt=" "+txt+"  ";
			var espera=600;
			var refresco=null;
		
			function rotulo_title() {
				document.title=txt;
				txt=txt.substring(1,txt.length)+txt.charAt(0);
				refresco=setTimeout("rotulo_title()",espera);
			}
			
			rotulo_title();
	
	</script>
	</head>
<body>
<div class="container">
	<nav >
		<ul>
			<li style="font-size:30px;"><a style="color:blue;" href="#home">Home</a></li>
			<li style="font-size:30px;"><a style="color:blue;" href="#site">Site</a></li>
			<li style="font-size:30px;"><a style="color:blue;" href="#zonahoraria">Time zone</a></li>
			<li style="font-size:30px;"><a style="color:blue;" href="#admin">Admin</a></li>
			<li style="font-size:30px;"><a style="color:blue;" href="#email">Email</a></li>
			<li style="font-size:30px;"><a style="color:blue;" href="#socials">Social</a></li>
		</ul>
	</nav>
<div>
	<form action="' . $_SERVER['PHP_SELF'] . '" name="form" method="post">
	<br/>';

    if (isset($_POST['submit'])) {

        $_POST['site'] = eliminar_espacios($_POST['site']);
        $_POST['timezone_select'] = eliminar_espacios($_POST['timezone_select']);
        $_POST['db_host'] = eliminar_espacios($_POST['db_host']);
        $_POST['db_name'] = eliminar_espacios($_POST['db_name']);
        $_POST['db_user'] = eliminar_espacios($_POST['db_user']);
        $_POST['db_password'] = eliminar_espacios($_POST['db_password']);
        $_POST['table_prefix'] = eliminar_espacios($_POST['table_prefix']);
        $_POST['admin_email'] = eliminar_espacios($_POST['admin_email']);
        $_POST['instagram'] = eliminar_espacios($_POST['instagram']);
        $_POST['facebook'] = eliminar_espacios($_POST['facebook']);
        $_POST['twitter'] = eliminar_espacios($_POST['twitter']);
        $_POST['youtube'] = eliminar_espacios($_POST['youtube']);
        $_POST['github'] = eliminar_espacios($_POST['github']);
        $_POST['debianart'] = eliminar_espacios($_POST['debianart']);
        $_POST['slideshare'] = eliminar_espacios($_POST['slideshare']);

        if ($_POST['timezone_select'] == '1.5') {
            $selected_timezone = 'Europe/Madrid';
        }

        if (file_exists('config.php')) {
            unlink('config.php');
        }

        $miArchivo = fopen('config.php', 'w') or die('No se puede abrir/crear el archivo!');

        $php = '<?php
	session_start();
	date_default_timezone_set("' . $selected_timezone . '");
	$site_name = "' . $_POST['site'] . '";
	$cms_host = "' . obtener_direccion() . '";
	$db_servertype = "' . $_POST['db_servertype'] . '";
	$db_host = "' . $_POST['db_host'] . '";
	$db_name = "' . $_POST['db_name'] . '";
	$db_user = "' . $_POST['db_user'] . '";
	$db_password = "' . $_POST['db_password'] . '";
	$table_prefix = "' . $_POST['table_prefix'] . '";
	$admin_email = "' . $_POST['admin_email'] . '";
	$protocolo = "' . $_POST['protocolo'] . '";
	$facebook="' . $_POST['facebook'] . '";
	$instagram="' . $_POST['instagram'] . '";
	$twitter="' . $_POST['twitter'] . '";
	$youtube="' . $_POST['youtube'] . '";
	$github="' . $_POST['github'] . '";
	$debianart="' . $_POST['debianart'] . '";
	$slideshare="' . $_POST['slideshare'] . '";
	define("4IMAGES_ACTIVE", 1);
	$conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("No se pudo conectar a la base de datos");
	$select_db = mysqli_select_db($conexion, $db_name);
	$idioma="' . $_POST['idioma'] . '";
	?>';

        fwrite($miArchivo, $php);
        fclose($miArchivo);
        chmod('config.php', 0777);

        $dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], 'mysql');
		
		if($dwes->set_charset('utf8')){
	$dwes->query('DROP DATABASE ' . $_POST['db_name']);
        $dwes->query('CREATE DATABASE ' . $_POST['db_name']);
		$dwes->query('use ' . $_POST['db_name']);
 }
        else{
		  $dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']);
		
		}
		
        $nombre = 'data/database/default/idiomas.sql';

        if (file_exists($nombre)) {
            $texto = file_get_contents($nombre);
            $sentencia = explode(";", $texto);

            for ($i = 0; $i < (count($sentencia) - 1); $i++) {
                $sentencia[$i] .= ";";
                $dwes->query($sentencia[$i]);

            }

        }

        $dwes->close();

    

        $current_time = time();
        $admin_pass_hashed = salted_hash($admin_password);

    }

    if ($action == 'startinstall') {
        $error = array();

        if ($db_servertype == '') {
            $error['db_servertype'] = 1;
        }

        if ($db_host == '') {
            $error['db_host'] = 1;
        }

        if ($db_name == '') {
            $error['db_name'] = 1;
        }

        if ($db_user == '') {
            $error['db_user'] = 1;
        }

        if ($admin_user == '') {
            $error['admin_user'] = 1;
        }

        if ($admin_password != $admin_password2 || $admin_password == '' || $admin_password2 == '') {
            $error['admin_password'] = 1;
            $error['admin_password2'] = 1;
        }

        if (!empty($error)) {
            foreach ($error as $key => $val) {
                $lang[$key] = sprintf('<span class="marktext">%s *</span>', $lang[$key]);
            }
            $action = 'intro';
        } else {
            $error_log = array();
            $error_msg = '';
            include ROOT_PATH . 'includes/db_' . strtolower($db_servertype) . '.php';
            $site_db = new Db($db_host, $db_user, $db_password, $db_name);

            if (!$site_db->connection) {
                $error_log[] = 'No connection to database!';
            }

            include ROOT_PATH . 'includes/db_utils.php';

            $db_file = ROOT_PATH . DATABASE_DIR . '/default/' . strtolower($db_servertype) . '_default.sql';
            $cont = @fread(@fopen($db_file, 'r'), @filesize($db_file));

            if (empty($cont)) {
                $error_log[] = 'Could not load: ' . $db_file;
            }

            if (empty($error_log)) {
                $cont = preg_replace('/4images_/', $table_prefix, $cont);
                $pieces = split_sql_dump($cont);
                for ($i = 0; $i < sizeof($pieces); ++$i) {
                    $sql = trim($pieces[$i]);
                    if (!empty($sql) and $sql[0] != '#') {
                        if (!$site_db->query($sql)) {
                            $error_log[] = $sql;
                        }
                    }
                }

            }

            if (empty($error_log)) {
                $dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']);
                $dwes->set_charset('utf8');
                $dwes->query(
                    "UPDATE users
              SET user_name = '$admin_user', user_password = '" . $admin_pass_hashed . "', user_joindate = $current_time, user_lastaction = $current_time, user_lastvisit = $current_time
              WHERE user_name = 'admin'");
			  
			  if($table_prefix!='4images_'){
				  $dwes->query('RENAME TABLE 4images_users TO '.$table_prefix . 'users');
				  $dwes->query('RENAME TABLE 4images_sessions TO '.$table_prefix . 'sessions');
				  $dwes->query('RENAME TABLE 4images_lightboxes TO '.$table_prefix . 'lightboxes');
				  $dwes->query('RENAME TABLE 4images_categories TO '.$table_prefix . 'categories');
				  $dwes->query('RENAME TABLE 4images_images TO '.$table_prefix . 'images');
				  $dwes->query('RENAME TABLE 4images_comments TO '.$table_prefix . 'comments');
				  $dwes->query('RENAME TABLE 4images_etiquetas TO '.$table_prefix . 'etiquetas');
				  $dwes->query('RENAME TABLE 4images_tags TO '.$table_prefix . 'tags');
				  $dwes->query('RENAME TABLE 4images_groups TO '.$table_prefix . 'groups');				  
			}
			  
               $dwes->close();
                echo '<script>location.href="index.php";</script>';

            } else {
                $msg = $lang['database_error'];
                $error_msg .= '<ol>';
                foreach ($error_log as $val) {
                    $error_msg .= sprintf('<li>%s</li>', $val);
                }
                $error_msg .= '</ol>';
            }
            echo '<p>' . $msg . $error_msg . '</p>';

            if (isset($cant_write_config)) {
                echo '<input title="enviar" type="submit" value="' . $lang['config_download'] . '" class="button" name="submit">
		   <hr/>';
            }
        }
    }

    if ($action == 'intro') {
        $db_servertype_select = '<select title="db_servertype" style="font-weight:bold;width:15%;margin:auto;" name="db_servertype">';
        $db_types = array();
        $handle = opendir(ROOT_PATH . 'includes');

        while ($file = @readdir($handle)) {
            if (preg_match("/db_(.*)\.php/", $file, $regs)) {
                if (file_exists(ROOT_PATH . 'data/database/default/' . $regs[1] . '_default.sql') && function_exists($regs[1] . '_connect')) {
                    $db_types[] = $regs[1];
                }
            }
        }

        foreach ($db_types as $db_type) {
            $db_servertype_select .= '<option value="' . $db_type . '"' . (($db_servertype == $db_type) ? ' selected="selected"' : '') . '>' . $db_type . '</option>';
        }

        $db_servertype_select .= '</select>';

        if (!empty($error)) {
            $lang['start_install_desc'] = $lang['start_install_desc'] . sprintf('<br /><br /><span class="marktext">%s *</span>', $lang['lostfield_error']);
        }

        echo $lang_select . '<h2 id="home">' . $lang['db_servertype'] . '</h2>

              <p>' . $db_servertype_select . '</p>

				<select name="protocolo">
				<option>http</option>
				<option>https</option>
				</select>

              <h2>' . $lang['db_host'] . '</h2>

              <p>
                <input title="db_host" type="text" name="db_host" value="localhost" required/>
              </p>

              <h2>' . $lang['db_name'] . '</h2>

              <p>
                <input title="db_name" type="text"  name="db_name" required/>
              </p>

              <h2>' . $lang['db_user'] . '</h2>

              <p>
                <input title="db_user"  type="text"  name="db_user" required/>
              </p>

              <h2>' . $lang['db_password'] . '</h2>

              <p>
                <input title="db_password" type="password"  name="db_password" required/>
              </p>

              <h2>' . $lang['table_prefix'] . '</h2>
			  <p>
                <input title="table_prefix" type="text" value="4images_" name="table_prefix" required/>
              </p>
			  <br/>
           <hr/>
		   <br/>
		   <h2 id="site">' . $lang['site'] . '</h2>
<p>
		   <input title="site" type="text"  name="site" required/>
</p>
			  <br/>
			  <hr/>

             <h2 id="zonahoraria">' . $lang['timezone_select'] . '</h2>

              <p>
                <select title="timezone_select" name="timezone_select">
                    <option value="-12">Baker Island Time (UTC-12)</option>
                    <option value="-11">Niue Time, Samoa Standard Time (UTC-11)</option>
                    <option value="-10">Hawaii-Aleutian Standard Time, Cook Island Time (UTC-10)</option>
                    <option value="-9.5">Marquesas Islands Time (UTC-9:30)</option>
                    <option value="-9">Alaska Standard Time, Gambier Island Time (UTC-9)</option>
                    <option value="-8">Pacific Standard Time (UTC-8)</option>
                    <option value="-7">Mountain Standard Time (UTC-7)</option>
                    <option value="-6">Central Standard Time (UTC-6)</option>
                    <option value="-5">Eastern Standard Time (UTC-5)</option>
                    <option value="-4.5">Venezuelan Standard Time (UTC-4:30)</option>
                    <option value="-4">Atlantic Standard Time (UTC-4)</option>
                    <option value="-3.5">Newfoundland Standard Time (UTC-3:30)</option>
                    <option value="-3">Amazon Standard Time, Central Greenland Time (UTC-3)</option>
                    <option value="-2">Fernando de Noronha Time, South Georgia &amp; the South Sandwich Islands Time (UTC-2)</option>
                    <option value="-1">Azores Standard Time, Cape Verde Time, Eastern Greenland Time (UTC-1)</option>
                    <option value="0">Western European Time, Greenwich Mean Time (UTC)</option>
                    <option value="1">Central European Time, West African Time (UTC+1)</option>
					<option value="1.5" selected="selected">Spain (Madrid)</option>
                    <option value="2">Eastern European Time, Central African Time (UTC+2)</option>
                    <option value="3">Moscow Standard Time, Eastern African Time (UTC+3)</option>
                    <option value="3.5">Iran Standard Time (UTC+3:30)</option>
                    <option value="4">Gulf Standard Time, Samara Standard Time (UTC+4)</option>
                    <option value="4.5">Afghanistan Time (UTC+4:30)</option>
                    <option value="5">Pakistan Standard Time, Yekaterinburg Standard Time (UTC+5)</option>
                    <option value="5.5">Indian Standard Time, Sri Lanka Time (UTC+5:30)</option>
                    <option value="5.75">Nepal Time (UTC+5:45)</option>
                    <option value="6">Bangladesh Time, Bhutan Time, Novosibirsk Standard Time (UTC+6)</option>
                    <option value="6.5">Cocos Islands Time, Myanmar Time (UTC+6:30)</option>
                    <option value="7">Indochina Time, Krasnoyarsk Standard Time (UTC+7)</option>
                    <option value="8">Chinese Standard Time, Australian Western Standard Time, Irkutsk Standard Time (UTC+8)</option>
                    <option value="8.75">Southeastern Western Australia Standard Time (UTC+8:45)</option>
                    <option value="9">Japan Standard Time, Korea Standard Time, Chita Standard Time (UTC+9)</option>
                    <option value="9.5"> Australian Central Standard Time (UTC+9:30)</option>
                    <option value="10">Australian Eastern Standard Time, Vladivostok Standard Time (UTC+10)</option>
                    <option value="10.5">Lord Howe Standard Time (UTC+10:30)</option>
                    <option value="11">Solomon Island Time, Magadan Standard Time (UTC+11)</option>
                    <option value="11.5">Norfolk Island Time (UTC+11:30)</option>
                    <option value="12">New Zealand Time, Fiji Time, Kamchatka Standard Time (UTC+12)</option>
                    <option value="12.75">Chatham Islands Time (UTC+12:45)</option>
                    <option value="13">Tonga Time, Phoenix Islands Time (UTC+13)</option>
                    <option value="14">Line Island Time (UTC+14)</option>
                </select>
				</p>
				<br/>
				<hr/>

				<h2 id="admin">' . $lang['admin_user'] . '</h2>

				<p><img class="imagen" alt="admin" class="imagen" src="img/director.png"/><br/><br/>
					<input title="admin_user" type="text"  placeholder="admin" name="admin_user" required/>
				</p>
				<br/>
				<h2>' . $lang['admin_password'] . '</h2>

				<p><img class="imagen" alt="pass admin" class="imagen" src="img/user_pass.png"/><br/><br/>
					<input title="admin_password" type="password" placeholder="password" name="admin_password" required/>
				</p>

				<h2>' . $lang['admin_password2'] . '</h2>

				<p>
					<input title="admin_password2" type="password"  name="admin_password2" required/>
        </p>

        <br/>

				<hr/>
              <h2 id="email">' . $lang['des_email'] . '
        </h2>

					<img class="imagen" alt="email admin" class="install" src="img/emaill.png"/> <br/><br/><input title="email" type="email" name="admin_email" placeholder="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"/>
				
				<br/>
				<hr/>
			  <h2 id="socials" stlye="font-size:20px;">' . $lang['nota'] . '</h2>

				<p>
					<img class="imagen" alt="facebook" class="install" src="img/Social/facebook.png"/> <br/> <br/> <input title="facebook" type="text" placeholder="facebook" name="facebook">
        </p>

				<p>
					<img class="imagen" alt="instagram" class="install" src="img/Social/instagram.png"/> <br/><br/>  <input title="instagram" type="text" placeholder="instagram" name="instagram" >
        </p>

				<p>
					<img class="imagen" alt="twitter" class="install" src="img/Social/twitter.png"/><br/><br/>   <input title="twitter" type="text" placeholder="twitter" name="twitter" >
        </p>

				<p>
					<img class="imagen" alt="youtube" class="install" src="img/Social/youtube.png"/><br/><br/>  <input title="youtube" type="text" placeholder="youtube" name="youtube" >
        </p>

				<p>
					<img class="imagen" alt="github" class="install" src="img/Social/github.png"/><br/><br/>   <input title="github" type="text" placeholder="github" name="github" >
        </p>

				<p>
					<img class="imagen" alt="debianart" class="install" src="img/Social/debianart.png"/> <br/><br/>  <input title="debianart" type="text" placeholder="debianart" name="debianart" >
        </p>

				<p>
					<img class="imagen" alt="slideshare" class="install" src="img/Social/slideshare.png"/><br/><br/>   <input title="slideshare" type="text" placeholder="slideshare" name="slideshare" >
        </p>

				<input title="startinstall" type="hidden" name="action" value="startinstall"/>
        <input title="install_lang" type="hidden" name="install_lang" value="<?php echo $install_lang; ?>"/>

        <br/>

				<input name="idioma" value="' . $_GET['install_lang'] . '" type="hidden"></input>
        <input title="enviar" type="submit" value="' . $lang['start_install'] . '" class="button" name="submit"/>

				<br/><br/></form>
		</div>';
    }
}
?>
</div>
	</body>
</html>