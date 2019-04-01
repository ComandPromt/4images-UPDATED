<?php

session_start();

include_once ('config.php');

include ('cabecera.php');

function mensaje($mensaje){
	
	if(!empty($mensaje)){
		echo '<script>alert("'.$mensaje.'");</script>';
	}
}

/////////////////////////////

$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
   	$consulta = mysqli_query($GLOBALS['conexion'],'SELECT user_id FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$_POST['user_name']."'");
	$fila = mysqli_fetch_row($consulta);


	mysqli_close($GLOBALS['conexion']);
	setcookie("4images_userid",1);
	print 'tu cookie '.$_COOKIE["4images_userid"];
	
	//setcookie("4images_userid",jghj,time()+3600);

if(isset($_POST['cambiar_pass']) && !empty($_POST['nueva_pass']) && $_COOKIE["4images_userid"]!="-1" ){
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
   	$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."users SET user_password='".salted_hash($_POST['nueva_pass'])."' WHERE user_id=".$_COOKIE["4images_userid"]);
	mensaje(ver_dato('cambio_pass_exitoso', $GLOBALS['idioma']));
	mysqli_close($GLOBALS['conexion']);
}

$SESSION['error'] = false;

$terminado = false;

if (!isset($SESSION['licencia'])) {
    $SESSION['licencia'] = true;
}

if (isset($_GET['activationkey'])) {
	
    $_GET['activationkey'] = eliminar_espacios($_GET['activationkey']);

    if (isset($_GET['action']) && $_GET['action'] == 'activate' && $_GET['activationkey'] != '') {
        mysqli_query($GLOBALS['conexion'], 'UPDATE '.$GLOBALS['table_prefix']."users SET user_level=2 WHERE user_activationkey='".$_GET['activationkey']."'");
        mysqli_close($GLOBALS['conexion']);
        mensaje(ver_dato('activacion_exitosa', $GLOBALS['idioma']));
        echo '<script>location.href="index.php";</script>';
    }
}

if (isset($_POST['submit'])) {
    $_POST['user_name'] = eliminar_espacios($_POST['user_name']);
    $_POST['email'] = eliminar_espacios($_POST['email']);
    $_POST['user_password'] = eliminar_espacios($_POST['user_password']);
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
   
   if (isset($_SESSION['captcha'])) {
        if ($_SESSION['captcha'] && $_REQUEST['captcha'] != $_SESSION['captcha']) {
            mensaje(ver_dato('error_captcha', $GLOBALS['idioma']));
            $SESSION['error'] = true;
        } else {
			
            $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM '.$GLOBALS['table_prefix']."users WHERE user_name='".$_POST['user_name']."'");
            $comprobacion1 = mysqli_affected_rows($GLOBALS['conexion']);
            $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM '.$GLOBALS['table_prefix']."users WHERE user_email='".$_POST['email']."'");
            $comprobacion2 = mysqli_affected_rows($GLOBALS['conexion']);

            if ($comprobacion1 == 0 && $comprobacion2 == 0 && !empty($_POST['user_name']) && !empty($_POST['email']) && !empty($_POST['user_password']) && !$SESSION['error']) {
                $user_password_hashed = salted_hash($_POST['user_password']);
                $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
                $activacion = md5(uniqid(microtime()));

                mysqli_query($GLOBALS['conexion'], 'INSERT INTO '.$GLOBALS['table_prefix'].'users (user_level,user_name,user_password,user_email,user_showemail,user_allowemails,user_invisible,user_joindate,user_activationkey,user_lastaction,user_location,user_lastvisit,user_comments,user_homepage,permitir_mensajes,user_icq)
				VALUES(1,'."'".$_POST['user_name']."'".','."'".$user_password_hashed."'".",'".$_POST['email']."'".',0,1,0,'.time().','."'".$activacion."'".',0,'."''".',0,0,0,0,0)');

                //include 'includes/functions.php';

                $mensaje = ver_dato('mensaje_activacion', $GLOBALS['idioma']);
                $mensaje = str_replace('usuario', $_POST['user_name'], $mensaje);
                $mensaje = str_replace('sitio', $site_name, $mensaje);
                $mensaje = str_replace('url', 'http://'.obtener_direccion().'register.php?action=activate&activationkey='.$activacion, $mensaje);

                enviar($_POST['email'], $site_name, $mensaje, '', $admin_email, 'gmail');

                echo '<h1 class="titulo">'.ver_dato('registro_exitoso', $GLOBALS['idioma']).'</h1>';

                $terminado = true;
            } else {
                echo mensaje(ver_dato('error', $GLOBALS['idioma']));
            }
        }
    }
	    mysqli_close($GLOBALS['conexion']);
		session_unset();
}

if (!$terminado && (isset($_POST['envio']))) {
	
    $SESSION['licencia'] = false;

    echo '<h1 style="padding-left:60px;" class="titulo">'.ver_dato('register_msg', $GLOBALS['idioma']).'</h1><br/>
	<form  style="padding-left:60px;" method="post" action="'.$_SERVER['PHP_SELF'].'">

					<div class="row1 texto"><img alt="usuario para registrar" class="icono2" src="img/user.png"/>

					    <input required title="user name" type="text" id="user_name"  name="user_name" size="30" placeholder="'.ver_dato('user_name', $GLOBALS['idioma']).'" class="input" />
                        <br/>
					</div>

					<div class="row2 texto"><img alt="user password" class="icono2" src="img/key.png"/>

					    <input required  title="user password" type="password" class="input" id="user_password"  name="user_password" size="30" placeholder="'.ver_dato('password', $GLOBALS['idioma']).'"  />
                        <br/>
				    </div>

					<div class="row1 texto"><img alt="user_email" class="icono2" src="img/email.png"/>

					    <input type="email" title="user email" id="email" name="email" value="'.$SESSION['email'].'
	                    " required pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" name="user_email" size="30" class="input" placeholder="'.ver_dato('email', $GLOBALS['idioma']).'" />
                        <br/>
				    </div>

					<div class="row1 texto">
						<img alt="captcha" id="captcha" src="captcha/captcha.php"/>'; ?>
						<a  class="texto nota" href="#" onclick="
			            document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
			            document.getElementById('captcha-form').focus();"
			            id="change-image"><img alt="reload captcha" class="icono2" src="img/reload.png"/></a><br/><br/>
			<?php
			echo '<input type="text" title="captcha" required  id="validcaptcha" name="captcha" size="30" value="" class="input" id="captcha_input" placeholder="'.ver_dato('captcha', $GLOBALS['idioma']).'"/>
						<br/>
						</div>

				<input title="register" type="hidden" name="action" value="register" />

				<input title="submit" name="submit" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/>
				<br/><br/>
				<input title="reset" type="reset" value="'.ver_dato('reset', $GLOBALS['idioma']).'"/>
	        </form>';
}

if (!$terminado && $SESSION['licencia']) {
	
    $SESSION['licencia'] = false;
	
    echo '<div  class="demo ">
	<div   class="titulo scrollbar-vista">
	<h1 class="cabecera" style="margin:auto;height:60px;" >'.ver_dato('agreement', $GLOBALS['idioma']).'</h1>
	<div style="height:350px;width:70%;"><br/><hr/>	<h2  style="text-align:center;padding-bottom:10px;" class="texto">'.ver_dato('agreement_terms', $GLOBALS['idioma']).'</h2></div>
    </div>';
	
    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
	
    echo '<input style="margin-top:25px;" title="submit" name="envio" value="'.ver_dato('ok', $GLOBALS['idioma']).'" type="submit"/>';
   
   echo '</form></div></div>';
}

echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title titulo" id="exampleModalLabel">'.ver_dato('titulo_cambiar_pass', $GLOBALS['idioma']).'</h3>
<button style="margin-left:20px;float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
          <form method="post" action="'.$_SERVER['PHP_SELF'].'">
        <div class="form-group">
        <label for="recipient-name" class="col-form-label"><h3>'.
		ver_dato('nueva_pass', $GLOBALS['idioma']).'</h3></label>
        <input  name="nueva_pass" type="text" class="form-control" id="recipient-name"/>
        </div>
		<br/><br/>
           <input name="cambiar_pass" type="submit" value="'.ver_dato('cambiar_pass', $GLOBALS['idioma']).'" />
         </form>
</div>
</div>
</div>
</div></div>';

include ('footer.html');

?>