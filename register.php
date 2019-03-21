<?php

session_start();

include_once ('config.php');
include ('lang/'.$idioma.'/main.php');
include ('cabecera.php');

$SESSION['error'] = false;

$terminado=false;

function mensaje($mensaje){
    echo '<script>alert("'.$mensaje.'");</script>';
}

if (!isset($SESSION['licencia'])) {
    $SESSION['licencia'] = true;
}

if (isset($_GET['activationkey'])) {
    $_GET['activationkey'] = eliminar_espacios($_GET['activationkey']);

    if (isset($_GET['action']) && $_GET['action'] == 'activate' && $_GET['activationkey'] != '') {
        mysqli_query($conexion, 'UPDATE '.$table_prefix."users SET user_level=2 WHERE user_activationkey='".$_GET['activationkey']."'");
		mensaje(ver_dato('activacion_exitosa',$GLOBALS['idioma']));
		print '<script>location.href="index.php";</script>';
		
    }
}

if (isset($_POST['submit'])) {
    $_POST['user_name'] = eliminar_espacios($_POST['user_name']);
    $_POST['email'] = eliminar_espacios($_POST['email']);
    $_POST['user_password'] = eliminar_espacios($_POST['user_password']);

    if (isset($_SESSION['captcha']) && $_REQUEST['captcha'] != $_SESSION['captcha']) {
        mensaje(ver_dato('captcha',$GLOBALS['idioma']));
		$SESSION['error'] = true;
    }
	
			  $consulta = mysqli_query($conexion, 'SELECT user_id FROM '.$table_prefix."users WHERE user_name='".$_POST['user_name']."'"); 
			  $comprobacion1=mysqli_affected_rows($conexion);
			  $consulta = mysqli_query($conexion, 'SELECT user_id FROM '.$table_prefix."users WHERE user_email='".$_POST['email']."'"); 
			  $comprobacion2=mysqli_affected_rows($conexion);
			  
if($comprobacion1==0 && $comprobacion2==0 && !empty($_POST['user_name']) && !empty($_POST['email']) && !empty($_POST['user_password']) && !$SESSION['error']){
	  include ('includes/functions.php');
	  
$activacion = md5(uniqid(microtime())); 
 
$mensaje=ver_dato('email',$GLOBALS['idioma']);
$mensaje=str_replace("usuario",$_POST['user_name'],$mensaje);
$mensaje=str_replace("sitio",$site_name,$mensaje);
$mensaje=str_replace("url",'http://comandpromt.dscloud.biz/hoopfetish/register.php?action=activate&activationkey='.$activacion,$mensaje);
      
	 $user_password_hashed = salted_hash($_POST['user_password']);

  print 'INSERT INTO '.$table_prefix.'users (user_level,user_name,user_password,user_email,user_showemail,user_allowemails,user_invisible,user_joindate,user_activationkey,user_lastaction,user_location,user_lastvisit,user_comments,user_homepage,permitir_mensajes,user_icq)
		VALUES(1,'."'".$_POST['user_name']."'".','."'".$user_password_hashed."'".",'".$_POST['email']."'".',0,1,0,'.time().','."'".$activacion."'".',0,'."''".',0,0,0,0,0)';

      

        mysqli_query($conexion, 'INSERT INTO '.$table_prefix.'users (user_level,user_name,user_password,user_email,user_showemail,user_allowemails,user_invisible,user_joindate,user_activationkey,user_lastaction,user_location,user_lastvisit,user_comments,user_homepage,permitir_mensajes,user_icq)
		VALUES(1,'."'".$_POST['user_name']."'".','."'".$user_password_hashed."'".",'".$_POST['email']."'".',0,1,0,'.time().','."'".$activacion."'".',0,'."''".',0,0,0,0,0)');

        enviar($_POST['email'], $site_name,$mensaje, '', $admin_email, 'gmail');

        echo '<h1>Gracias por registrarse</h1>
<h2>Recibira un correo para activar su cuenta</h2>';
$terminado=true;
}

else{
	print mensaje(ver_dato('error',$GLOBALS['idioma']));
}

        session_unset();
	  
}

if (!$terminado && (isset($_POST['envio']))) {
    $SESSION['licencia'] = false;
 

    echo '<h1 class="titulo">'.$lang['register_msg'].'</h1><br/><br/>
	<form  method="POST" action="'.$_SERVER['PHP_SELF'].'">

					<div class="row1 texto"><img class="icono2" src="img/user.png"/>

					<input type="text" id="user_name" require name="user_name" size="30" placeholder="'.$lang['user_name'].'" class="input" />

					</div>

					<div class="row2 texto"><img class="icono2" src="img/key.png"/>

					<input type="password" id="user_password" require name="user_password" size="30" placeholder="'.$lang['password'].'" class="input" />

				</div>

					<div class="row1 texto"><img class="icono2" src="img/email.png"/>

					<input type="email" id="email" name="email" value="'.$SESSION['email'].'
	" required pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" name="user_email" size="30" class="input" placeholder="'.$lang['email'].'" />
					</div>

					<div class="row1">'.$lang['lang_captcha'].'
			<br/>
						<img alt="captcha" id="captcha" src="captcha/captcha.php"/>'; ?>
							<a  class="texto nota" href="#" onclick="
			document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
			document.getElementById('captcha-form').focus();"
			id="change-image"><img class="icono2" src="img/reload.png"/></a><br/><br/>
			<?php
    echo '		<input type="text" required  id="validcaptcha" name="captcha" size="30" value="" class="input" id="captcha_input" placeholder="Captcha"/>
						</div>
						<div style="width:210px;">
									'.$lang['lang_captcha_desc'].'
							<br/><br/>
							</div>
				<input type="hidden" name="action" value="register" />
			<p>
				<input name="submit" type="submit" value="'.$lang['submit'].'"/>
				<br/><br/>
				<input type="reset" value="'.$lang['reset'].'"/>
			</p>

	</form>';
}

if (!$terminado && $SESSION['licencia']) {
    $SESSION['licencia'] = false;
    echo '<h1 class="titulo">'.$lang['agreement'].'</h1>'.'<br/>'.$lang['agreement_terms'];
    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
    echo '<br/><br/><input name="envio" value="OK" type="submit"/>';
    echo '</form>';
}

echo '</div>';
include ('footer.html');

?>