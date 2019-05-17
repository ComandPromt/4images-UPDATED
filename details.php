<?php

session_start();

$_SESSION['insert_pag']='details.php';



function truncateFloat($number, $digitos){
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos);
 
}

$_SESSION['insert_pag']='details.php';

$ultima_imagen=0;

if(isset($_GET['image_id']) &&  (int)$_GET['image_id']>0){
	$_SESSION['pagina']="details.php?image_id=".$_GET['image_id'];
	include('cabecera.php');
	include('config.php');
	
	 $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT image_id FROM ' .
        $GLOBALS['table_prefix'] . "images ORDER BY image_id DESC LIMIT 1");

    $fila = mysqli_fetch_row($consulta);
	
	$ultima_imagen=$fila[0];

	if($_GET['image_id']<=$ultima_imagen){
	
	poner_menu();
	
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");
	mysqli_set_charset($GLOBALS['conexion'],"utf8");
	$consulta = mysqli_query($GLOBALS['conexion'], '
		UPDATE 4images_images SET image_hits=image_hits+1 WHERE image_id='.$_GET['image_id']);
	
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
		print '<h3 style="font-size:20px;margin-top:10px;text-align:center;background-color:#008CBA;color:#ffffff;font-weight:bold;">'.$recuento[3].'</h3>';
	}
	

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
			<span id="descargas" style="font-size:14px;color:blue;">'.$fila[1].'</span>
</td>

</tr>
</table>';
print '';
	$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT user_invisible,user_name FROM '.$GLOBALS['table_prefix'].'users 
		WHERE user_id=(SELECT user_id FROM '.$GLOBALS['table_prefix'].'images WHERE image_id='.$_GET['image_id'].')');

	$fila = mysqli_fetch_row($consulta);
		
	if($fila[0]==0){
		print '<div style="float:left;padding-left:55px;"><img style="width:40px;height:40px;" src="img/user.png"/><span style="font-size:15px"> '.$fila[1].'</span></div>';
	}
	
	print '<div style="float:left;padding-bottom:40px;padding-left:10px;"><img style="width:40px;height:40px;" src="img/size.png"/><span style="font-size:15px;"> '.truncateFloat(truncateFloat(filesize ( 'data/media/'.$categoria.'/'.$imagen)/1024,2)/1024,2).'</span></div>';
print '';
	if($_GET['image_id']>1){

$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_media_file FROM '.$GLOBALS['table_prefix'].'images
		WHERE image_id='.$_GET['image_id'].'-1');
		
		$recuento = mysqli_fetch_row($consulta);
		
	print '<div style="float:left;padding-left:30px;">
			<a href="details.php?image_id='.(--$image_id).'" ><img style="height:40px;width:40px;" src="img/back.png"/></a>
			<img style="margin-left:10px;height:50px;width:50px;" src="data/media/'.$categoria.'/'.$recuento[0].'"/>
	</div>';
}	

$image_id++;

$icono="fav.ico";
	$like="";
	
	if(isset($_COOKIE['4images_userid'])){
	
    $consulta = mysqli_query($GLOBALS['conexion'], 'SELECT COUNT(lightbox_image_id) FROM ' .
        $GLOBALS['table_prefix'] . "lightboxes WHERE lightbox_image_id=".$image_id." AND user_id=" . $_COOKIE['4images_userid'] );

    $fila = mysqli_fetch_row($consulta);
	
	if($fila[0]==1){
		$icono="fav_2.ico";
	}
	
	$like='<div style="float:left;padding-left:40px;">
		<form id="frmajax" method="post">
			<a onclick="favorito('.$image_id.')"><img style="height:40px;width:40px;" src="img/'.$icono.'" id="Imagen '.$image_id.'"/></a>
		</form></div>
		';
	}

if($like!=""){
	print $like;
}

print '<div style="float:left;padding-left:40px;">';
print '
	<form id="frmdownload" method="post">
		<a onclick="descarga('.$image_id.')" href="data/media/'.$categoria.'/'.$imagen.'" download><img style="height:40px;width:40px;" src="img/download.png"/></a>
	</form>
</div>

</div>
';

if($_GET['image_id']<$ultima_imagen){
	
	$consulta = mysqli_query($GLOBALS['conexion'], '
		SELECT image_media_file FROM '.$GLOBALS['table_prefix'].'images
		WHERE image_id='.$_GET['image_id'].'+1');
		
		$recuento = mysqli_fetch_row($consulta);
	
	print '
	<div style="float:left;padding-left:40px;">
		<img style="height:50px;width:50px;" src="data/media/'.$categoria.'/'.$recuento[0].'"/>
	<a href="details.php?image_id='.(++$image_id).'" ><img style="margin-left:10px;height:40px;width:40px;" src="img/next.png"/></a></div>';
}



print'</div>';



print '	

	</div>
	';
	
mysqli_close($GLOBALS['conexion']);

mostrarfecha_y_hora();

	include('footer.html');
}
else{
	$_SESSION['pagina']="details.php?image_id=".$ultima_imagen;
	redireccionar('details.php?image_id='.$ultima_imagen);
}
}

?>