<?php

session_start();

$_SESSION['track']=false;

include_once('../../config.php');

include_once('../../includes/funciones.php');

cabecera('../../');

if(isset($_COOKIE['4images_userid'])){
	
	$_COOKIE['4images_userid']=(int)$_COOKIE['4images_userid'];
	
	if($_COOKIE['4images_userid']>0){
		$GLOBALS['idioma']=saber_idioma($_COOKIE['4images_userid']);	
	}
}

comprobar_cookie('../../');

poner_menu('../../');

poner_menu_geo('../../');

/*
  NUMERO DE IPS CONECTADOS SELECT COUNT( DISTINCT (tx_ipRemota) ) AS i_total
    FROM tbl_tracking where date='hoy'
 */
 
/* numero de navegadores
SELECT COUNT(distinct(tx_navegador)) as i_total
    FROM tbl_tracking
*/

/*Total de páginas

SELECT tx_pagina, COUNT( tx_pagina )  AS i_total
    FROM tbl_tracking
    group by tx_pagina
    order by i_total DESC
*/ 

print '</div>';

print '<div style="margin:auto;"  class="table-responsive-xs">
<table class="table" style="text-align:center;margin:auto;margin-left:-40px;">

		<tr>
			<th style="font-size:20px;text-align:center;">'. ver_dato('page', $GLOBALS['idioma']).'</th>
			<th style="font-size:20px;text-align:center;">'. ver_dato('pais', $GLOBALS['idioma']).'</th>
			<th style="font-size:20px;text-align:center;">'. ver_dato('city', $GLOBALS['idioma']).'</th>
		</tr>';
		
	$fila[1]="";

	$region="";
		
	$procedencia="";
		
	$local=ver_dato('local', $GLOBALS['idioma']);
		
	$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
    $GLOBALS['db_password'], $GLOBALS['db_name']) or die("No se pudo conectar a la base de datos");

	$tx_pagina              = $_SERVER['PHP_SELF']; 
	$tx_paginaOrigen        = $_SERVER['HTTP_REFERER'];
	$tx_paginaActual        =   $_SERVER['PHP_SELF']; 
	$i_direccionIp      = $_SERVER['REMOTE_ADDR'];   
	$tx_navegador       =   $_SERVER['HTTP_USER_AGENT']; 
	
	$ips=array();
	
	$consulta=mysqli_query ($GLOBALS['conexion'], "SELECT distinct(tx_ipRemota) 
	FROM tbl_tracking WHERE dt_fechaVisita=CURDATE()ORDER BY id_tracking DESC LIMIT 50");
	
	while($fila = mysqli_fetch_row($consulta)){
		$ips[]=$fila[0];
	}
	
	for($x=0;$x<count($ips);$x++){

		if( !is_private_ip($ips[$x])){
			
			$geo = json_decode(file_get_contents('http://extreme-ip-lookup.com/json/'.$ips[$x]));
			
			$region=$geo->city;	
			$consulta=mysqli_query ($GLOBALS['conexion'], "SELECT tx_pagina,pais FROM tbl_tracking
			WHERE tx_ipRemota='".$ips[$x]."' ORDER BY id_tracking DESC");
			
			$fila = mysqli_fetch_row($consulta);
			
			$pagina=substr($fila[0],strrpos($fila[0], "/")+1,strlen($fila[0]));
			
			if(strrpos($pagina, "?")>0){
				$pagina=substr($pagina,0,strrpos($pagina, "?"));
			}
			
			switch($pagina){
				
				case 'index.php':
				case '':
				$procedencia='home';
				break;
				
				case 'favoritos.php':
				$procedencia='fav';
				break;
				
				case 'categories.php':
				$procedencia='tag_2';
				break;
				
				case 'search.php':
				$procedencia='search';
				break;
				
				case 'top.php':
				$procedencia='top';
				break;
				
				case 'register.php':
				$procedencia='registrar';
				break;
				
				case 'inbox.php':
				case 'outbox.php':
				$procedencia='email';
				break;
				
				default:
				$procedencia='view';
				break;
			}
	
			print '<tr><td>';
			
			print '<a title="'.$procedencia.'" target="_blank" href="'.$fila[0].'">
			<img alt="'.$procedencia.'" class="icono" src="../../img/'.$procedencia.'.png"/></a></td>';
				
			if($fila[1]!='local'){
				print '<td>
					<img alt="'.$procedencia.'" class="icono" src="../../img/countries/'.$fila[1].'.png"/>
				</td>';
			}
				
			else{
				print '<td><span style="text-align:center;font-size:25px;">'.$fila[1].'</span></td>';
			}
			
			if($region=="" || $fila[1] =="unknow"){
				if($fila[1] =="unknow"){
					$region=$ips[$x];
				}
				else{
					$region=$fila[1];
				}
			}
				
			print '<td style="font-size:25px;text-align:center;">'.$region.'</td>
			</tr>';
		
		}
		
	}
	
	print '</table></div>';
	
	mysqli_close($GLOBALS['conexion']);

	restablecer_pass('../../');

	footer('../../');

?>