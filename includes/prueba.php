<?php
include('config.php');
include_once('funciones.php');

if($_GET['l']=="yes" && isset($_SESSION['login']) && $_SESSION['login']){
	session_unset();
}
else{
	session_start();
}
?>
<html dir="ltr">
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?php print $db_name;?>">
	<meta name="keywords" content="">
	<meta name="robots" content="index,follow">
	<meta name="revisit-after" content="10 days">
	<meta http-equiv="imagetoolbar" content="no">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/css.css">
	
	<link rel="stylesheet" href="css/font.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	
	<link rel="icon" type="image/ico" href="img/favicon.ico">
	
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
		
			function opendetailwindow() { 
			window.open('','detailwindow','toolbar=no,scrollbars=yes,resizable=no,width=680,height=480');
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

	<link rel="alternate" type="application/rss+xml" title="<?php print 'RSS Feed: '.$site_name." (Nuevas imágenes)";?>" href="rss.php?action=images">
	</head>
<body>
<div id="navega"> 
<div id="menu"> 
<div id="fijo">
<?php
$consulta = mysqli_query($conexion, 'SELECT COUNT(distinct(cat_parent_id)) FROM 4images_categories WHERE cat_parent_id>0');
	 $recuento = mysqli_fetch_array($consulta);
			$recuento=$recuento[0];
			$recuento=($recuento*10)+30;
			if ($recuento>80){
				$recuento=80;
			}
		
print '<div class="nav" style="width:'.$recuento.'%;">';
?>

  <ul>
    <li>
      
       <a  href="index.php"><img style="width:140px;height:59px;margin-left:-6px;padding-bottom:12px;" src="img/logo.png"> </a>
      
    </li>
	<li>
	 <?php
poner_menu();
	?>
 	</li>

  
	
      </ul>
  </div>
</div><div id="fijo">
<?php
$consulta = mysqli_query($conexion, 'SELECT COUNT(distinct(cat_parent_id)) FROM 4images_categories WHERE cat_parent_id>0');
	 $recuento = mysqli_fetch_array($consulta);
			$recuento=$recuento[0];
			$recuento=($recuento*10)+30;
			if ($recuento>100){
				$recuento=100;
			}
		
print '<div class="nav" style="width:'.$recuento.'%;">';
?>

  <ul>
    <li>
      
       <a  href="index.php"><img style="width:140px;height:59px;margin-left:-6px;padding-bottom:12px;" src="img/logo.png"> </a>
      
    </li>
	<li>
	 <?php
poner_menu();
	?>
 	</li>

  
	
      </ul>
  </div>
</div>  
</div>  
</div>  

<div id="texto"> 

   

</div> 



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:210px">

  <!-- Header -->
  <header id="portfolio">

    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    </div>
  </header>
 
    <div class="w3-container">
    
    <div>
    <br>
	

  <script src="js/jquery.min.js"></script>

    <script src="js/index.js"></script>
    </div>
	
    </div>
	
	<?php
	if(strpos("index.php",$_SERVER['PHP_SELF'])>=0){
		print '<span class="title"><img style="padding-top:80px;" src="img/welcome_doll.gif" alt="" width="100%" height="340px"></span>';
	}
	?>
 	
   

   <a href="categories.php?cat_id=9"><img src="img/gif.png" width="100px" height="100px"></a>
    <a href="categories.php?cat_id=11"><img src="img/aretes.png" width="100px" height="100px" border="0"></a>
	<a href="categories.php?cat_id=7"><img src="img/dangles.png" width="100px" height="100px"></a>
	<a href="todos.php"><img src="img/search.png" width="100px" height="100px"></a>
        
  <a href="./search.php?search_new_images=1" onclick="w3_close()" class="w3-bar-item w3-button w3-padding">
 <img src="img/new.png" width="150px" height="150px">
 </a> 

     				<br>
				  
   <!--
AJAX
<h1 style="font-size:35px;font-weight:bold;">15331 <img style="height:40px;width:40px;" src="img/camara.png"></h1>-->
              
                  <br>
				  
				  <br />
                  
 
<!-- End page content -->
</div>


           </body></html>