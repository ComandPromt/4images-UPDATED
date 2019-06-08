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

print '<table class="table" style="margin:auto;text-align:center;">

		<tr>
			<th style="font-size:25px;">'. ver_dato('page', $GLOBALS['idioma']).'</th>
			<th style="font-size:25px;">'. ver_dato('pais', $GLOBALS['idioma']).'</th>
			<th style="font-size:25px;">'. ver_dato('city', $GLOBALS['idioma']).'</th>
			<th style="font-size:25px;"><img class="icono" src="../../img/ip.png"/></th>
		</tr>';
		
	$country="";

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
	
	$consulta=mysqli_query ($GLOBALS['conexion'], "SELECT distinct(tx_ipRemota) FROM tbl_tracking ORDER BY id_tracking DESC LIMIT 100");
	
	while($fila = mysqli_fetch_row($consulta)){
		$ips[]=$fila[0];
	}
	
	$x=1;

	for($x=0;$x<count($ips);$x++){

		if( !is_private_ip($ips[$x])){

			$geo = json_decode(file_get_contents('http://extreme-ip-lookup.com/json/'.$ips[$x]));
			
			$region=$geo->city;
			
			switch($geo->country){
			
				case 'Spain':
				$country ="es";
				break;
			
				case 'France':
				$country ="fr";
				break;
				
				case 'Germany':
				$country ="de";
				break;
				
				case 'United States':
				$country ="us";
				break;
				
				case 'Norway':
				$country ="no";
				break;
				
				case 'Belgium':
				$country ="be";
				break;
				
				case 'Ukraine':
				$country ="ukr";
				break;
				
				case 'Canada':
				$country ="ca";
				break;
				
				case 'United Kingdom':
				$country ="uk";
				break;
				
				case 'India':
				$country ="india";
				break;
				
				case 'Chile':
				$country ="chile";
				break;
				
				case 'Brazil':
				$country ="brasil";
				break;
				
				case 'Thailand':
				$country ="tai";
				break;
				
				case 'Turkey':
				$country ="turkia";
				break;
				
				case 'Pakistan':
				$country ="pakistan";
				break;
				
				case 'Vietnam':
				$country ="vietnam";
				break;
				
				case 'Peru':
				$country ="peru";
				break;
				
				case 'Poland':
				$country ="polonia";
				break;
				
				case 'Indonesia':
				$country ="indonesia";
				break;
				
				case 'Ireland':
				$country ="ireland";
				break;
				
				case 'South Korea':
				$country ="corea";
				break;
				
				default:
				$country ="us";
				break;
			}
			
			if(empty($country)){
				$country="us";
			}
			
		$consulta=mysqli_query ($GLOBALS['conexion'], "SELECT tx_pagina FROM tbl_tracking
		WHERE tx_ipRemota='".$ips[$x]."' ORDER BY id_tracking DESC");
		
		$fila2 = mysqli_fetch_row($consulta);
		
		switch(substr($fila2[0],strrpos($fila2[0], "/")+1,strlen($fila2[0]))){
			
			case 'index.php':
			case '':
			$procedencia='home';
			break;
			
			case 'favoritos.php':
			$procedencia='fav';
			break;
			
			case 'cageories.php':
			$procedencia='tag';
			break;
	
			case 'inbox.php':
			case 'outbox.php':
			$procedencia='email';
			break;
			
			default:
				$procedencia='view';
			break;
		}

		print '<tr><td style="font-size:20px;">';
		
	
			print '<a target="_blank" href="'.$fila2[0].'"/>
			<img class="icono" src="../../img/'.$procedencia.'.png"/></td>';
			
			if($country!='local'){
				print '<td><img src="../../img/countries/'.$country.'.png"/></td>';
			}
			
			else{
				print '<td><span>'.$country.'</span></td>';
			}
			
			if($region==""){
				$region=$ips[$x];
			}
			
			print '<td style="font-size:25px;">'.$region.'</td>
			<td style="font-size:25px;">'.$ips[$x].'</td>
			</tr>';
		
		}
		
	}
	
	print '</table>';
	
	mysqli_close($GLOBALS['conexion']);

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

restablecer_pass('../../');

footer('../../');

?>