<?php

session_start();

$_SESSION['pagina']="messages/inbox.php";

if(!file_exists ("avatars")) {
		mkdir("avatars");
}

$_SESSION['track'] = true;

include ('config.php');

include ('includes/funciones.php');


cabecera();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
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
	
    if (isset($_SESSION['captcha'])) {
		
        if ($_POST['captcha'] != $_SESSION['captcha']) {
			
            mensaje(ver_dato('error_captcha', $GLOBALS['idioma']));
			
            $SESSION['error'] = true;
        } 
		
		else {
			
				$avatar=$_FILES['avatar']['name'];
	
				if(!empty($avatar)){

					$extension= substr($_FILES['avatar']['name'], -4);
		
			
						if($extension=='jpeg' || $extension=='JPEG' || $extension=='.JPG'){
							$extension='.jpg';
						}
						
						$ext_validas = array(".jpg",".png", ".PNG", ".gif", ".GIF");
						
						if(!in_array($extension, $ext_validas)){
							$avatar='nofoto.jpg';
						}
						
						if($avatar!="nofoto.jpg"){
							
							$nombre = date('Y').'_'.date('m').'_'.date('j').'_'.date('G').'-'.date('i').'-'.date('s');
							
							$extension=strtolower($extension);
							
							$avatar=$nombre.$extension; 
						}
			
						$target_path = "avatars/" . basename($avatar);
			
						if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)){
							$avatar='nofoto.jpg';
						}
			
				}
	
				else{
					$avatar='nofoto.jpg';
				}
						
				include('config.php');
				
				$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
				$GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");
			
				$consulta = mysqli_query($GLOBALS['conexion'], 'SELECT user_id FROM ' .
					$GLOBALS['table_prefix'] . "users WHERE user_name='" . $_POST['user_name'] .
					"'");
					
				$comprobacion = mysqli_affected_rows($GLOBALS['conexion']);
	
				if ($comprobacion == 0 && !empty($_POST['user_name']) && !empty($_POST['email']) && !empty($_POST['user_password'])
					&& !$SESSION['error']) {
						
					$user_password_hashed = salted_hash($_POST['user_password']);
					
					mysqli_query($GLOBALS['conexion'], 'INSERT INTO ' .
						$GLOBALS['table_prefix'] . "users (user_level,user_name,user_password,
					user_email,user_allowemails,user_invisible,user_comments,nacionalidad,avatar)
					VALUES('2','".$_POST['user_name'] . "','".$user_password_hashed .
						"','" .$_POST['email'] ."','1','0','0','".$_POST['pais'] . "','$avatar')");
				
					$consulta=mysqli_query($GLOBALS['conexion'], 'SELECT user_id  FROM ' .
					$GLOBALS['table_prefix'] . "users WHERE user_name='".$_POST['user_name'] . "'");
						
					$fila = mysqli_fetch_row($consulta);
				
					mysqli_query($GLOBALS['conexion'], "INSERT INTO mensajes (remitente,destinatario,asunto,mensaje,leido) 	   
					VALUES('1','". $fila[0]. "','".ver_dato('welcome', $GLOBALS['idioma'])."','".
					ver_dato('msg_welcome', $GLOBALS['idioma']) . "','0')");
				
					mysqli_close($GLOBALS['conexion']); 
				
					$terminado = true;
					
					redireccionar('login.php?user_name='.$_POST['user_name'].'&user_password='.$user_password_hashed);
				
				} 
				
				else {
					echo mensaje(ver_dato('error', $GLOBALS['idioma']));
				}
			}
		}
	}

if (!$terminado && (isset($_POST['envio']))) {

    $SESSION['licencia'] = false;

    echo '<h1 style="padding-left:60px;" class="titulo"><br/>' . ver_dato('register_msg',
        $GLOBALS['idioma']) . '</h1>
				
	<form  enctype="multipart/form-data" style="padding-left:60px;" method="post" action="' . $_SERVER['PHP_SELF'] . '">

					<div class="row1 texto"><img alt="usuario para registrar"
					class="icono" src="img/user.png"/>

					    <input required title="user name" type="text" id="user_name"
						name="user_name" size="30" 
						placeholder="' . ver_dato('user_name',$GLOBALS['idioma']) . '" class="input" />
						
						
					</div>
					
  <div style="float:right;width:200px;margin-top:40px;" onLoad="mostrarInputFileModificado(1);">
       
            <div style="font-size:30px;" class="botonInputFileModificado">
			       <div class="boton">Seleccionar avatar</div>  
                <input style="width:150px;" name="avatar" type="file" />
           
            </div>        
             
        </div>
					<div style="margin-top:200px;" class="row2 texto">
					
						<img alt="user password" class="icono"	src="img/key.png"/>

					    <input required  title="user password" type="password"
						class="input" id="user_password"  name="user_password" size="30"
						placeholder="' . ver_dato('password', $GLOBALS['idioma']) . '"  />
						
    
						
				    </div>

					<div style="margin-top:40px;" class="row1 texto">
					
						<img alt="user password" class="icono"	src="img/idiomas.png"/>
						
						<select name="pais">
							<option name="spanish" value="spanish"  checked="checked"/>Espa&ntilde;ol</option>
							<option name="aleman" value="aleman" />Deutsch</option>
							<option name="ingles" value="ingles" />English</option>
							<option name="frances" value="frances" />Francais</option>
							<option name="ruso" value="ruso" />русский</option>
							<option name="italiano" value="" />Italiano</option>
							<option name="portuges" value="portuges" />Portugues</option>
							<option name="chino" value="chino" />中國</option>
							<option name="hindu" value="hindu" />हिन्दू</option>
							<option name="japones" value="japones" />日本人</option>
							<option name="catalan" value="catalan" />Catalá</option>
							<option name="bengali" value="bengali" />বাঙালি</option>
							<option name="arabe" value="arabe" />العربية</option>
							<option name="euskera" value="euskera" />Euskal</option>
							<option name="coreano" value="coreano" />한국인</option>
							<option name="vietnamita" value="vietnamita" />Việt nam</option>
							<option name="polaco" value="polaco" >Polski</option>
						</select>
	
			 
						<img style="margin-top:40px;" alt="user_email" class="icono" src="img/email.png"/>
			
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
			            id="change-image">
							<img alt="reload captcha" class="icono" src="img/reload.png"/>
						</a>

<?php

echo '<input style="margin-top:40px;" type="text" title="captcha" required  id="validcaptcha"
			name="captcha" size="30" value="" class="input" id="captcha_input"
			placeholder="' . ver_dato('captcha', $GLOBALS['idioma']) . '"/>
			
						</div>
    
				<input title="register" type="hidden" name="action" value="register" />

				<input style="margin-top:40px;"  title="submit" name="submit" type="submit" value="' .
				ver_dato('register', $GLOBALS['idioma']) . '"/>
				
		        </form>';
}

if (!$terminado && $SESSION['licencia']) {

    $SESSION['licencia'] = false;

    echo '<div  class="demo">
	
	<div class="titulo scrollbar-vista">
	
		<br/><h3 class="cabecera" style="margin:auto;height:50px;padding-left:30px;" >' .
	
		ver_dato('agreement', $GLOBALS['idioma']) . '</h3>
		
		<div style="height:350px;width:70%;">
			<hr/> <h2  style="text-align:center;padding-bottom:10px;height:100px;" class="texto">'
			. ver_dato('agreement_terms',$GLOBALS['idioma']) . '</h2>
			
		</div>
    </div>';

    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';

    echo '<input style="margin-top:25px;" title="submit" name="envio" value="'.
    ver_dato('ok', $GLOBALS['idioma']) . '" type="submit"/>';

    echo '</form>

	</div></div>';
}

restablecer_pass();

print '</div></div>';

footer();

?>