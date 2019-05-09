<?php
session_start();
date_default_timezone_set('Europe/Madrid');

$_SESSION['pagina']="todos/index.php";

if(file_exists('../config.php')){
	include('../config.php');
}

include_once('../includes/funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="revisit-after" content="10 days">
	<script src="../js/funciones.js"></script>
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.scrollbar.css" />
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../css/css.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/scroll.css" />
    <link rel="stylesheet" href="../css/prettify.css" />
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="stylesheet" type="text/css" href="../css/component.css" />
	<link rel="stylesheet" type="text/css" href="../css/scrollbar.css" />
	<link rel="icon" type="image/ico" href="../img/favicon.ico">
 
	<title>Web</title>
	
	<style>
		label{
			font-size:30px;
		}
		
		option{
			font-size:20px;
		}

.content-select{
	font-size:20px;
color:blue;
margin-right:50px;
}

	</style>
	
	<script>
		//Especificar a que elementos afectará, añadiendo o quitando de la lista:
		var tgs = new Array( 'div','td','tr');
		
		//Indicar el nombre de los diferentes tamaños de fuente:
		var szs = new Array( 'xx-small','x-small','small','medium','large','x-large','xx-large' );
		var startSz = 2;
		
		function ts( trgt,inc ) {
			if (!document.getElementById) return
			
			var d = document,cEl = null,sz = startSz,i,j,cTags;
			
			sz += inc;
			
			if ( sz < 0 ) sz = 0;
			if ( sz > 6 ) sz = 6;
			
			startSz = sz;
			
			if ( !( cEl = d.getElementById( trgt ) ) ) cEl = d.getElementsByTagName( trgt )[ 0 ];
			
			cEl.style.fontSize = szs[ sz ];
			
			for ( i = 0 ; i < tgs.length ; i++ ) {
				cTags = cEl.getElementsByTagName( tgs[ i ] );
				for ( j = 0 ; j < cTags.length ; j++ ) cTags[ j ].style.fontSize = szs[ sz ];
			}
		}
		
		var captcha_reload_count = 0;
		var captcha_image_url = "./captcha.php";
		
		function new_captcha_image() {
			if (captcha_image_url.indexOf('?') == -1) {
				document.getElementById('captcha_image').src= captcha_image_url+'?c='+captcha_reload_count;
				} else {
				document.getElementById('captcha_image').src= captcha_image_url+'&c='+captcha_reload_count;
				}
		
			document.getElementById('captcha_input').value="";
			document.getElementById('captcha_input').focus();
			captcha_reload_count++;
		}
				
		if (document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = right;
		}
		else if (document.all && !document.getElementById){
			document.onmousedown = right;
		}
		
		var txt = "<?php echo $site_name;?>";
			document.oncontextmenu = new Function("alert('© Copyright by "+txt+"');return false");
			txt=txt.toUpperCase();
			txt=" "+txt+"  ";
			var espera=600;
			var refresco=null;
		
			function rotulo_title() {
				document.title=txt;
				txt=txt.substring(1,txt.length)+txt.charAt(0);
				refresco=setTimeout("rotulo_title()",espera);
			}
			
			rotulo_title();
	
	</script>
	
	<link rel="alternate" type="application/rss+xml" title="<?php print 'RSS Feed: '.$GLOBALS['site_name']." (Nuevas imágenes)";?>" href="rss.php?action=images">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	
</head>

<body>

<?php

menu_categorias();

menu_lateral('../');

print '</div</div>';

restablecer_pass('../');

?>
	 
</div>

<div  style="margin: auto; width: 50%;padding-left:10%;width:80%;margin-top:30px;"> 

<div class="texto">

<div style="height:70%;width:50%,margin:auto;padding-left:100px;">

	<table class="table display AllDataTables">
	
		<thead>
			<tr>
			<th><img class="icono" src="../img/picture.png">
				<th><img class="icono" src="../img/download.png">
				<th><img class="icono" src="../img/view.png"></th>
			</tr>
		</thead>
		
		<tbody>
		
		<?php
		
		include('../config.php');
		
		$consulta = mysqli_query($conexion,
		'SELECT image_id,image_name,image_media_file,cat_id FROM '.$table_prefix.'images WHERE cat_id=2 ORDER BY image_id DESC');
  
		while($fila = mysqli_fetch_array($consulta)){
			print '<tr>
				<td>'.$fila[1].' <img style="height:200px;width:200px;" src="data/media/'.$fila[3].'/'.$fila[2].'"/></td>
				<td>Prueba</td>
				<td>Prueba</td>
			</tr>';
		}	

		?>
			
		</tbody>
	</table>
</div>

				<script src="js/jquery-3.2.1.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script src="js/jquery.dataTables.min.js"></script>
				<script src="js/dataTables.bootstrap.min.js"></script>
				
				<script>
					$(document).ready( function () {
						$('.AllDataTables').DataTable({
							language: {
								"sProcessing":     "Procesando...",
								"sLengthMenu":     "<img style='height:40px;width:40px;' src='../img/view.png'/>_MENU_",
								"sZeroRecords":    "No se encontraron resultados",
								"sEmptyTable":     "Ningún dato disponible en esta tabla",
								"sInfoFiltered":   "",
								"sInfoPostFix":    "",
								"sSearch":         " <img style='height:40px;width:40px;' src='../img/search.png'/>&nbsp;",
								"sUrl":            "",
								"sInfoThousands":  ",",
								"sLoadingRecords": "Cargando...",
								"oPaginate": {
									"sFirst":    "Primero",
									"sLast":     "Último",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								},
								"oAria": {
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
								}
							}
						});
					} );
				</script>
			</div>
		</div>
	</body>
</html>