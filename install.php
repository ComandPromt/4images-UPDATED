<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

function get_timezone_by_offset($offset)
{
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
        $HTTP_POST_VARS = $_POST;
        $HTTP_COOKIE_VARS = $_COOKIE;
        $HTTP_POST_FILES = $_FILES;
        $HTTP_SERVER_VARS = $_SERVER;
        $HTTP_ENV_VARS = $_ENV;
    }

    if (get_magic_quotes_gpc() == 0) {
        $HTTP_GET_VARS = addslashes_array($HTTP_GET_VARS);
        $HTTP_POST_VARS = addslashes_array($HTTP_POST_VARS);
        $HTTP_COOKIE_VARS = addslashes_array($HTTP_COOKIE_VARS);
    }

    if (@file_exists(ROOT_PATH.'config.php')) {
        include ROOT_PATH.'config.php';
    } else {
        date_default_timezone_set('CET');
    }

    if (defined('4IMAGES_ACTIVE')) {
        header('Location: index.php');
        exit;
    }

    if (isset($HTTP_GET_VARS['action']) || isset($HTTP_POST_VARS['action'])) {
        $action = (isset($HTTP_GET_VARS['action'])) ? stripslashes(trim($HTTP_GET_VARS['action'])) : stripslashes(trim($HTTP_POST_VARS['action']));
    } else {
        $action = '';
    }

    if ($action == '') {
        $action = 'intro';
    }

    $lang_select = '';
    $folderlist = array();
    $handle = opendir(ROOT_PATH.'lang');

    while ($folder = @readdir($handle)) {
        if (@is_dir(ROOT_PATH."lang/$folder") && $folder != '.' && $folder != '..') {
            $folderlist[] = $folder;
        }
    }

    sort($folderlist);

    for ($i = 0; $i < sizeof($folderlist); ++$i) {
        $lang_select .= '<a href="install.php?install_lang='.$folderlist[$i].'"><img alt="'.$folderlist[$i].'" style="height:100px;width:100px;" src="img/Install/'.$folderlist[$i].'.png"/></a>';
    }

    closedir($handle);

    if (isset($HTTP_GET_VARS['install_lang']) || isset($HTTP_POST_VARS['install_lang'])) {
        $install_lang = (isset($HTTP_GET_VARS['install_lang'])) ? trim($HTTP_GET_VARS['install_lang']) : trim($HTTP_POST_VARS['install_lang']);
    }

    if (isset($_POST['submit'])) {
        $install_lang = $_POST['idioma'];
    }

    $lang = array();
    include ROOT_PATH.'lang/'.$install_lang.'/install.php';

    $db_servertype = (isset($HTTP_POST_VARS['db_servertype'])) ? trim($HTTP_POST_VARS['db_servertype']) : 'mysqli';
    $db_host = (isset($HTTP_POST_VARS['db_host'])) ? trim($HTTP_POST_VARS['db_host']) : '';
    $db_name = (isset($HTTP_POST_VARS['db_name'])) ? trim($HTTP_POST_VARS['db_name']) : '';
    $db_user = (isset($HTTP_POST_VARS['db_user'])) ? trim($HTTP_POST_VARS['db_user']) : '';
    $db_password = (isset($HTTP_POST_VARS['db_password'])) ? trim($HTTP_POST_VARS['db_password']) : '';
    $table_prefix = (isset($HTTP_POST_VARS['table_prefix'])) ? trim($HTTP_POST_VARS['table_prefix']) : '4images_';
    $admin_user = (isset($HTTP_POST_VARS['admin_user'])) ? trim($HTTP_POST_VARS['admin_user']) : '';
    $admin_password = (isset($HTTP_POST_VARS['admin_password'])) ? trim($HTTP_POST_VARS['admin_password']) : '';
    $admin_password2 = (isset($HTTP_POST_VARS['admin_password2'])) ? trim($HTTP_POST_VARS['admin_password2']) : '';
    $selected_timezone = (isset($HTTP_POST_VARS['timezone_select'])) ? trim($HTTP_POST_VARS['timezone_select']) : '1';
    $selected_timezone = get_timezone_by_offset($selected_timezone);

    include ROOT_PATH.'includes/constants.php';

    if ($action == 'downloadconfig') {
        header('Content-Type: text/x-delimtext; name="config.php"');
        header('Content-disposition: attachment; filename=config.php');
        $config_file = stripslashes(trim($HTTP_POST_VARS['config_file']));
        echo $config_file;
        exit;
    }

    echo '
<!DOCTYPE html>
<html lang="es">
  <head>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="admin/cpstyle.css">
  <link rel="icon" type="image/ico" href="img/favicon_2.ico">
  <title>4images Installer</title>
  <style>
  *{
	  text-align:center;
	  margin:auto;
  }
  </style>
</head>
<body>
	<nav>
		<ul>
			<li><a href="#home">Home</a></li>
			<li><a href="#site">Site</a></li>
			<li><a href="#zonahoraria">Time zone</a></li>
			<li><a href="#admin">Admin</a></li>
			<li><a href="#email">Email</a></li>
			<li><a href="#socials">Social</a></li>
		</ul>
	</nav>
<div>
	<form action="'.$_SERVER['PHP_SELF'].'" name="form" method="post">
	<br/>';

    if (isset($_POST['submit'])) {
        include 'includes/funciones.php';
        $_POST['site'] = eliminar_espacios($_POST['site']);
        $_POST['timezone_select'] = eliminar_espacios($_POST['timezone_select']);
        $_POST['db_host'] = eliminar_espacios($_POST['db_host']);
        $_POST['db_name'] = eliminar_espacios($_POST['db_name']);
        $_POST['db_user'] = eliminar_espacios($_POST['db_user']);
        $_POST['db_password'] = eliminar_espacios($_POST['db_password']);
        $_POST['table_prefix'] = eliminar_espacios($_POST['table_prefix']);
        $_POST['admin_email'] = eliminar_espacios($_POST['admin_email']);
        $_POST['admin_emailpass'] = eliminar_espacios($_POST['admin_emailpass']);
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

        $dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], 'mysql');
        $dwes->set_charset('utf8');
        $dwes->query('DROP DATABASE '.$_POST['db_name']);
        $dwes->query('CREATE DATABASE '.$_POST['db_name']);
        $dwes->query('DROP DATABASE usuarios');
        $dwes->query('CREATE DATABASE usuarios');
		$dwes->close();
		$dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], 'usuarios');
        $dwes->query('CREATE TABLE usuarios (
	id int(11) AUTO_INCREMENT PRIMARY KEY,
	Nombre varchar(50) NOT NULL UNIQUE,
	tipo varchar(50) NOT NULL,
	descripcion varchar(255) NOT NULL
	)');
	
	$dwes->query('DROP DATABASE '.$_POST['db_name'].'_idiomas');
    $dwes->query('CREATE DATABASE '.$_POST['db_name'].'_idiomas');
	$dwes->close();
	$dwes = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name'].'_idiomas');
	$nombre='data/database/default/idiomas.sql';
	
	if(file_exists($nombre)){
		$texto = file_get_contents($nombre);
		$sentencia = explode(";", $texto);
				
		for ($i = 0; $i < (count($sentencia) - 1); $i++) {
			$sentencia[$i] .= ";";
		$dwes->query($sentencia[$i]);
			
			}
		
	}
	
       $dwes->close();

        if (file_exists('config.php')) {
            unlink('config.php');
        }

        $miArchivo = fopen('config.php', 'w') or die('No se puede abrir/crear el archivo!');

        $php = '<?php
	session_start();
	date_default_timezone_set("'.$selected_timezone.'");
	$site_name = "'.$_POST['site'].'";
	$db_servertype = "'.$_POST['db_servertype'].'";
	$db_host = "'.$_POST['db_host'].'";
	$db_name = "'.$_POST['db_name'].'";
	$db_user = "'.$_POST['db_user'].'";
	$db_password = "'.$_POST['db_password'].'";
	$table_prefix = "'.$_POST['table_prefix'].'";
	$admin_email = "'.$_POST['admin_email'].'";
	$admin_emailpass = "'.$_POST['admin_emailpass'].'";
	$facebook="'.$_POST['facebook'].'";
	$instagram="'.$_POST['instagram'].'";
	$twitter="'.$_POST['twitter'].'";
	$youtube="'.$_POST['youtube'].'";
	$github="'.$_POST['github'].'";
	$debianart="'.$_POST['debianart'].'";
	$slideshare="'.$_POST['slideshare'].'";
	define("4IMAGES_ACTIVE", 1);
	$conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("No se pudo conectar a la base de datos");
	$select_db = mysqli_select_db($conexion, $db_name);
	$idioma="'.$_POST['idioma'].'";
	?>';

        fwrite($miArchivo, $php);
        fclose($miArchivo);
        chmod('config.php', 0777);
		
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
            include ROOT_PATH.'includes/db_'.strtolower($db_servertype).'.php';
            $site_db = new Db($db_host, $db_user, $db_password, $db_name);

            if (!$site_db->connection) {
                $error_log[] = 'No connection to database!';
            }

            include ROOT_PATH.'includes/db_utils.php';

            $db_file = ROOT_PATH.DATABASE_DIR.'/default/'.strtolower($db_servertype).'_default.sql';
            $cont = @fread(@fopen($db_file, 'r'), @filesize($db_file));

            if (empty($cont)) {
                $error_log[] = 'Could not load: '.$db_file;
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
		  'UPDATE '.$table_prefix."users
              SET user_name = '$admin_user', user_password = '".$admin_pass_hashed."', user_joindate = $current_time, user_lastaction = $current_time, user_lastvisit = $current_time
              WHERE user_name = 'admin'");
$dwes->query(
		  'UPDATE '.$table_prefix."users
              SET user_name = '$admin_user', user_password = '".$admin_pass_hashed."', user_joindate = $current_time, user_lastaction = $current_time, user_lastvisit = $current_time
              WHERE user_name = 'admin'");
	   $dwes->close();
	           header('Location:index.php');

            } else {
                $msg = $lang['database_error'];
                $error_msg .= '<ol>';
                foreach ($error_log as $val) {
                    $error_msg .= sprintf('<li>%s</li>', $val);
                }
                $error_msg .= '</ol>';
            }
            echo '<p>'.$msg.$error_msg.'</p>';

            if (isset($cant_write_config)) {
                echo '<input title="enviar" type="submit" value="'.$lang['config_download'].'" class="button" name="submit">
		   <hr/>';
            }
        }
    }

    if ($action == 'intro') {
        $db_servertype_select = '<select title="db_servertype" style="font-weight:bold;width:15%;" name="db_servertype">';
        $db_types = array();
        $handle = opendir(ROOT_PATH.'includes');

        while ($file = @readdir($handle)) {
            if (preg_match("/db_(.*)\.php/", $file, $regs)) {
                if (file_exists(ROOT_PATH.'data/database/default/'.$regs[1].'_default.sql') && function_exists($regs[1].'_connect')) {
                    $db_types[] = $regs[1];
                }
            }
        }

        foreach ($db_types as $db_type) {
            $db_servertype_select .= '<option value="'.$db_type.'"'.(($db_servertype == $db_type) ? ' selected="selected"' : '').'>'.$db_type.'</option>';
        }

        $db_servertype_select .= '</select>';

        if (!empty($error)) {
            $lang['start_install_desc'] = $lang['start_install_desc'].sprintf('<br /><br /><span class="marktext">%s *</span>', $lang['lostfield_error']);
        }

        echo $lang_select.'<h2 id="home">'.$lang['db_servertype'].'</h2>

              <p>'.$db_servertype_select.'</p>

              <h2>'.$lang['db_host'].'</h2>

              <p>
                <input title="db_host" type="text" name="db_host" value="localhost" required/>
              </p>

              <h2>'.$lang['db_name'].'</h2>

              <p>
                <input title="db_name" type="text"  name="db_name" required/>
              </p>

              <h2>'.$lang['db_user'].'</h2>

              <p>
                <input title="db_user"  type="text"  name="db_user" required/>
              </p>

              <h2>'.$lang['db_password'].'</h2>

              <p>
                <input title="db_password" type="password"  name="db_password" required/>
              </p>

              <h2>'.$lang['table_prefix'].'</h2>
			  <p>
                <input title="table_prefix" type="text" value="4images_" name="table_prefix" required/>
              </p>
			  <br/>
           <hr/>
		   <br/>
		   <h2 id="site">'.$lang['site'].' <input title="site" type="text"  name="site"/></h2>

			  <br/>
			  <hr/>

             <h2 id="zonahoraria">'.$lang['timezone_select'].'</h2>

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

				<h2 id="admin">'.$lang['admin_user'].'</h2>

				<p><img alt="admin" class="imagen" src="img/director.png"/>
					<input title="admin_user" type="text"  placeholder="admin" name="admin_user" required/>
				</p>
				<br/>
				<h2>'.$lang['admin_password'].'</h2>

				<p><img alt="pass admin" class="imagen" src="img/user_pass.png"/>
					<input title="admin_password" type="password" placeholder="password" name="admin_password" required/>
				</p>

				<h2>'.$lang['admin_password2'].'</h2>

				<p>
					<input title="admin_password2" type="password"  name="admin_password2" required/>
        </p>

        <br/>

				<hr/>
              <h2 id="email">'.$lang['des_email'].'
        </h2>

					<img alt="email admin" class="install" src="img/emaill.png"/> <input title="email" type="email" name="admin_email" placeholder="email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"/>
				<p>
					<img alt="pass email admin" class="install" src="img/key.png"/>  <input title="password" type="password" placeholder="password" name="admin_emailpass"/>
				</p>
				<br/>
				<hr/>
			  <p id="socials">'.$lang['nota'].'</p>

				<p>
					<img alt="facebook" class="install" src="img/Social/facebook.png"/>  <input title="facebook" type="text" placeholder="facebook" name="facebook">
        </p>

				<p>
					<img alt="instagram" class="install" src="img/Social/instagram.png"/>  <input title="instagram" type="text" placeholder="instagram" name="instagram" >
        </p>

				<p>
					<img alt="twitter" class="install" src="img/Social/twitter.png"/>  <input title="twitter" type="text" placeholder="twitter" name="twitter" >
        </p>

				<p>
					<img alt="youtube" class="install" src="img/Social/youtube.png"/>  <input title="youtube" type="text" placeholder="youtube" name="youtube" >
        </p>

				<p>
					<img alt="github" class="install" src="img/Social/github.png"/>  <input title="github" type="text" placeholder="github" name="github" >
        </p>

				<p>
					<img alt="debianart" class="install" src="img/Social/debianart.png"/>  <input title="debianart" type="text" placeholder="debianart" name="debianart" >
        </p>

				<p>
					<img alt="slideshare" class="install" src="img/Social/slideshare.png"/>  <input title="slideshare" type="text" placeholder="slideshare" name="slideshare" >
        </p>

				<input title="startinstall" type="hidden" name="action" value="startinstall"/>
        <input title="install_lang" type="hidden" name="install_lang" value="<?php echo $install_lang; ?>"/>

        <br/>

				<input name="idioma" value="'.$_GET['install_lang'].'" type="hidden"></input>
        <input title="enviar" type="submit" value="'.$lang['start_install'].'" class="button" name="submit"/>

				<br/><br/></form>
		</div>';
    }
}
?>
	</body>
</html>