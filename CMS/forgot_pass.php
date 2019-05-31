<?php
include('cabecera.php');

if(isset($_COOKIE['4images_userid'])){
	
			$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
			if($_COOKIE['4images_userid']>0){
				$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
			}
		}
		
	echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title titulo" id="exampleModalLabel">' . ver_dato('cambiar_pass', $GLOBALS['idioma']) . '</h3>
<button style="margin-left:20px;float:right;z-index:2;" type="button" class="close"
data-dismiss="modal" >
<span>&times;</span>
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
</div>';
footer();
?>