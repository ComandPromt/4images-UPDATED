<?php

session_start();

include ('cabecera.php');

$_SESSION['pagina'] = 'register.php';

if (isset($_POST['restablecer_pass']) && !empty($_POST['correo_restablecimiento'])

    && !empty($_POST['nombre_usuario'])) {

    $numero_restablecimiento = mt_rand(0, 16585);

    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM ' .
        $GLOBALS['table_prefix'] . "users WHERE user_name='" . $_POST['nombre_usuario'] . "'
	AND  user_email='" . $_POST['correo_restablecimiento'] . "'");
    $comprobacion = mysqli_affected_rows($GLOBALS['conexion']);

    if ($comprobacion == 1) {

        $fila = mysqli_fetch_row($consulta);
        $_SESSION['correo_restablecimiento'] = $_POST['correo_restablecimiento'];
        $_SESSION['id_usuario'] = $fila[0];
        echo '<script>location.href="restablecer_pass.php";</script>';
    }

    mysqli_close($GLOBALS['conexion']);

}

$SESSION['error'] = false;

$terminado = false;

if (!isset($SESSION['licencia'])) {
    $SESSION['licencia'] = true;
}

if (isset($_POST['submit'])) {
    $_POST['user_name'] = eliminar_espacios($_POST['user_name']);
    $_POST['email'] = eliminar_espacios($_POST['email']);
    $_POST['user_password'] = eliminar_espacios($_POST['user_password']);
    $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

    if (isset($_SESSION['captcha'])) {
        if ($_SESSION['captcha'] && $_REQUEST['captcha'] != $_SESSION['captcha']) {
            mensaje(ver_dato('error_captcha', $GLOBALS['idioma']));
            $SESSION['error'] = true;
        } else {

            $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM ' .
                $GLOBALS['table_prefix'] . "users WHERE user_name='" . $_POST['user_name'] .
                "'");
            $comprobacion = mysqli_affected_rows($GLOBALS['conexion']);

            if ($comprobacion == 0 && !empty($_POST['user_name'])
                && !empty($_POST['email']) && !empty($_POST['user_password'])
                && !$SESSION['error']) {
                $user_password_hashed = salted_hash($_POST['user_password']);
                $GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'],
                    $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name'])
                or die("No se pudo conectar a la base de datos");

                mysqli_query($GLOBALS['conexion'], 'INSERT INTO ' .
                    $GLOBALS['table_prefix'] . 'users (user_level,user_name,user_password,
				user_email,user_allowemails,user_invisible,user_joindate,user_lastaction,user_location,user_lastvisit,
				user_comments,user_homepage,user_icq,nacionalidad)
				VALUES(2,' . "'" . $_POST['user_name'] . "'" . ',' . "'" . $user_password_hashed .
                    "'" . ",'" . $_POST['email'] . "'" . ',1,0,' . time() . ',0,' . "''" . ',0,0,default,default,' . "'" . $_POST['pais'] . "')");

                $mensaje = ver_dato('mensaje_activacion', $GLOBALS['idioma']);
                $mensaje = str_replace('usuario', $_POST['user_name'], $mensaje);
                $mensaje = str_replace('sitio', $_POST['site_name'], $mensaje);
                $mensaje = str_replace('url', 'http://' . obtener_direccion() .
                    'register.php?action=activate&activationkey=' . $activacion, $mensaje);

                echo '<br/><h1 class="titulo">' . ver_dato('registro_exitoso',
                    $GLOBALS['idioma']) . '</h1>';

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

    echo '<h1 style="padding-left:60px;" class="titulo"><br/>' . ver_dato('register_msg',
        $GLOBALS['idioma']) . '</h1><br/>
	<form  style="padding-left:60px;" method="post" action="' . $_SERVER['PHP_SELF'] . '">

					<div class="row1 texto"><img alt="usuario para registrar"
					class="icono2" src="img/user.png"/>

					    <input required title="user name" type="text" id="user_name"
						name="user_name" size="30" placeholder="' . ver_dato('user_name',
        $GLOBALS['idioma']) . '" class="input" />
                        <br/>
					</div>

					<div class="row2 texto"><img alt="user password" class="icono2"
					src="img/key.png"/>

					    <input required  title="user password" type="password"
						class="input" id="user_password"  name="user_password" size="30"
						placeholder="' . ver_dato('password', $GLOBALS['idioma']) . '"  />
                        <br/>
				    </div>

					<div class="row1 texto">

<hr/>

<input name="pais" value="spanish" type="radio" checked="checked" ><img src="images/icons/1.png"/>
<input name="pais" value="aleman" type="radio"><img src="images/icons/2.png"/>
<input name="pais" value="ingles" type="radio"><img src="images/icons/3.png"/>
<input name="pais" value="frances" type="radio"><img src="images/icons/4.png"/>
<input name="pais" value="ruso" type="radio"><img src="images/icons/5.png"/>
<input name="pais" value="italiano" type="radio"><img src="images/icons/6.png"/><br/><br/>
<input name="pais" value="portuges" type="radio"><img src="images/icons/7.png"/>
<input name="pais" value="chino" type="radio"><img src="images/icons/8.png"/>
<input name="pais" value="hindu" type="radio"><img src="images/icons/9.png"/>
<input name="pais" value="japones" type="radio"><img src="images/icons/10.png"/>
<input name="pais" value="catalan" type="radio"><img src="images/icons/11.png"/>
<input name="pais" value="bengali" type="radio"><img src="images/icons/12.png"/><br/><br/>
<input name="pais" value="arabe" type="radio"><img src="images/icons/13.png"/>
<input name="pais" value="euskera" type="radio"><img src="images/icons/14.png"/><br/>
			 <hr/><br/>
 			<img  alt="user_email" class="icono2" src="img/email.png"/>
					<span id="palabra2" onmouseover="mostrarTooltip(this,\'' .
    ver_dato('nota_email', $GLOBALS['idioma']) . '\');"/>*</span>
					    <input type="email" title="user email" id="email" name="email"
						value="' . $SESSION['email'] . '
	                    " required pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" name="user_email" size="30" class="input"
						placeholder="' . ver_dato('email', $GLOBALS['idioma']) . '" />
                        <br/>
				    </div>

					<div class="row1 texto">
						<img alt="captcha" id="captcha" src="captcha/captcha.php"/>';?>
						<a  class="texto nota" href="#" onclick="
			            document.getElementById('captcha').src='captcha/captcha.php?'+
						Math.random();
			            document.getElementById('captcha-form').focus();"
			            id="change-image"><img alt="reload captcha" class="icono2"
						src="img/reload.png"/></a><br/><br/>
<?php
echo '<input type="text" title="captcha" required  id="validcaptcha"
			name="captcha" size="30" value="" class="input" id="captcha_input"
			placeholder="' . ver_dato('captcha', $GLOBALS['idioma']) . '"/>
						<br/>
						</div>

				<input title="register" type="hidden" name="action" value="register" />

				<input title="submit" name="submit" type="submit" value="' .
    ver_dato('submit', $GLOBALS['idioma']) . '"/>
				<br/><br/>
				<input title="reset" type="reset" value="' . ver_dato('reset',
        $GLOBALS['idioma']) . '"/>
	        </form>';
}

if (!$terminado && $SESSION['licencia']) {

    $SESSION['licencia'] = false;

    echo '<div  class="demo ">
	<div class="titulo scrollbar-vista">
	<br/><h3 class="cabecera" style="margin:auto;height:50px;padding-left:30px;" >' .
    ver_dato('agreement', $GLOBALS['idioma']) . '</h3>
	<div style="height:350px;width:70%;"><hr/>	<h2  style="text-align:center;
	padding-bottom:10px;" class="texto">' . ver_dato('agreement_terms',
        $GLOBALS['idioma']) . '</h2></div>
    </div>';

    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';

    echo '<input style="margin-top:25px;" title="submit" name="envio" value="' .
    ver_dato('ok', $GLOBALS['idioma']) . '" type="submit"/>';

    echo '</form></div></div>';
}

echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title titulo" id="exampleModalLabel">' . ver_dato('cambiar_pass', $GLOBALS['idioma']) . '</h3>
<button style="margin-left:20px;float:right;" type="button" class="close"
data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
          <form method="post" action="' . $_SERVER['PHP_SELF'] . '">
        <div class="form-group">
		<img alt="usuario para registrar" class="icono2" src="img/user.png"/>
		<input  name="nombre_usuario" placeholder="' . ver_dato('user_name',
    $GLOBALS['idioma']) . '" type="text" class="form-control" id="recipient-name"/>
<br/>
<img alt="usuario para registrar" class="icono2" src="img/email.png"/>
        <input  name="correo_restablecimiento" placeholder="' .
ver_dato('email', $GLOBALS['idioma']) . '"
		type="text" class="form-control" />
      <br/>
	  </div>
		<br/><br/>
           <input name="restablecer_pass" type="submit" value="' .
ver_dato('cambiar_pass', $GLOBALS['idioma']) . '" />
		 </form>
</div>
</div>
</div>
</div></div>';

include 'footer.html';
?>