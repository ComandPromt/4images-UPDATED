<?php

session_start();

include('../config.php');

include('../includes/funciones.php');

cabecera('../');

zona_privada('../');

$_SESSION['track']=false;

$_SESSION['pagina']='admin/imagenes_repetidas.php';

comprobar_cookie('../');

poner_menu('../');

poner_menu_geo('../');

print '<div class="flotar_derecha">
		<a onclick="descargar();"><img class="icono" src="../img/download.png" /></a>
		</div>';

ver_categoria('*',"GROUP BY sha256 HAVING COUNT(*) > 1",false,false,false,"../");

restablecer_pass('../');

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
footer('../');

?>