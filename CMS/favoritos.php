<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

comprobar_cookie();

poner_menu();

print '<div class="flotar_derecha">
		<a onclick="descargar();"><img class="icono" src="img/download.png" /></a>
		</div>

<div class="centrar" style="padding-top:100px;padding-left:40px;">
			<h1>'.ver_dato('img_fav', $GLOBALS['idioma']).'</h1>
		</div>';

ver_categoria('*','WHERE image_id IN ( SELECT lightbox_image_id FROM '.$GLOBALS['table_prefix'].'lightboxes WHERE user_id='.$_COOKIE['4images_userid'].' ORDER BY orden DESC)',true);

//print '<h1>Test</h1>'.var_dump($_SESSION['array_imagenes']);



?>

<script>

function descargar(){
	
	var zip = new JSZip();
	
	var img = zip.folder("favourites");
	
	<?php
	
	for($x=0;$x<count($_SESSION['array_imagenes']);$x++){

	$base64=base64_encode_image('data/media/'.$_SESSION['categorias'][$x].'/'.$_SESSION['array_imagenes'][$x]);
	
	print "img.file('".$_SESSION['array_imagenes'][$x]."',
	'".$base64."', {base64: true});";

	}
		
	?>
	
	zip.generateAsync({type:"blob"})
	.then(function(content) {
		saveAs(content, "example.zip");
	});

}

</script>

<?php

restablecer_pass();

footer();
 
?>