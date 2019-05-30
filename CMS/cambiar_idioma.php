<?php

session_start();

$_SESSION['pagina']="member.php";

include('cabecera.php');

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

comprobar_cookie();

poner_menu();

poner_menu_conf();

if(isset($_POST['cambiar_idioma'])){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
		$consulta = mysqli_query($GLOBALS['conexion'],'UPDATE '.$GLOBALS['table_prefix']."users SET nacionalidad='".$_POST['pais']."' WHERE user_id=".$_COOKIE['4images_userid']);

		mysqli_close($GLOBALS['conexion']);
		redireccionar($_SESSION['pagina']);
}

print '
<form method="post" action="'.$_SERVER['PHP_SELF'].'">

<p>

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

	
	

</p>
<p style="padding-top:20px;"><input name="cambiar_idioma" style="font-size:20px;" type="submit" value="'.ver_dato('submit', $GLOBALS['idioma']).'"/></p>
</form>';

print '</div>';

restablecer_pass();

footer();
 
?>