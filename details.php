<?php

session_start();

function truncateFloat($number, $digitos){
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 
}

$_SESSION['insert_pag']='details.php';

if(isset($_GET['image_id']) &&  (int)$_GET['image_id']>0){
	
	include('cabecera.php');
	include('config.php');
	
	poner_menu();
	
	print '<br/><br/>

	<div style="margin-left:10%;">';
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_name,cat_id,image_media_file,image_description,image_id FROM '.$GLOBALS['table_prefix'].'images
		WHERE image_id='.$_GET['image_id']);
		
		$recuento = mysqli_fetch_row($consulta);
		
		$categoria=$recuento[1];
		$imagen=$recuento[2];
		$image_id=$recuento[4];
		
		print '<h1>'.$recuento[0].'</h1>
	
		<div class="container">
		<img id='.$image_id.' alt="Imagen '.$image_id.'" src="data/media/'.$categoria.'/'.$imagen.'" class="image">
  <div class="overlay">';
   	
	if(!empty($recuento[3])){
		print '<p style="font-size:25px;background-color:#008CBA;color:#ffffff;font-weight:bold;">'.$recuento[3].'</p>';
	}
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT user_invisible,user_name FROM '.$GLOBALS['table_prefix'].'users 
		WHERE user_id=(SELECT user_id FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$_GET['image_id'].')');

	$fila = mysqli_fetch_row($consulta);
		
	if($fila[0]==0){
		print '<div style="float:left;ackground-color:#008CBA;margin-left:20px;"><img class="icono" src="img/user.png"/><span style="font-size:25px"> '.$fila[1].'</span></div>';
	}
	print '<div style="float:right;ackground-color:#008CBA;margin-right:20px;padding-right:10px;"><img class="icono" src="img/size.png"/><span style="font-size:25px;"> '.truncateFloat(truncateFloat(filesize ( 'data/media/'.$categoria.'/'.$imagen)/1024,2)/1024,2).'</span></div>';
	print '
  </div>
  
</div>';

$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_hits,image_downloads FROM '.$GLOBALS['table_prefix'].'images
		WHERE image_id='.$_GET['image_id']);

		$fila = mysqli_fetch_row($consulta);

	print '
<div style="margin-left:-20px;" class="table-responsive-xs">
  <table style="border:none;margin:auto;" class="table">
<tr style="border:none;">
<td style="border:none;">
<img style="height:30px;width:30px;"  src="img/view.png"/>
		
			<span style="font-size:14px;color:blue;">'.$fila[0].'</span>
		
</td>
<!--
<td style="border:none;">

<img style="height:30px;width:30px;"  src="img/top.png"/>
				<span style="font-size:14px;color:blue;">16000</span>
		
</td>
-->
<td style="border:none;">
<img style="height:30px;width:30px;"  src="img/download.png"/>
			<span style="font-size:14px;color:blue;">'.$fila[1].'</span>
</td>

</tr>
</table>';
		mysqli_close($GLOBALS['conexion']);
		
$icono="fav.ico";
	$like="";
	
	if(isset($_COOKIE['4images_userid'])){
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
        $GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=".$image_id." AND user_id=" . $_COOKIE['4images_userid'] );

    $fila = mysqli_fetch_row($consulta);
	
	if($fila[0]==1){
		$icono="fav_2.ico";
	}
	
	mysqli_close($GLOBALS['conexion']);
	
	$like='<div style="float:left;margin-left:40%;">
		<form id="frmajax" method="post">
			<a onclick="favorito('.$image_id.')"><img style="height:40px;width:40px;" src="img/'.$icono.'" id="Imagen '.$image_id.'"/></a>
		</form></div>
		';
	}

if($like!=""){
	print $like;
}

print '<div style="float:left;padding-left:40px;">';
print '<a onclick="location.href=\'insert_lightbox.php?image_id='.$image_id.'\';" href="data/media/'.$categoria.'/'.$imagen.'" download><img style="height:40px;width:40px;" src="img/download.png"</a></div>

</div>

	<br/><br/>

	</div>
	';
mostrarfecha_y_hora();
	include('footer.html');
}

?>