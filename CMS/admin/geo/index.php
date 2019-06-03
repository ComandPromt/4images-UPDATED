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

print '<table style="margin:auto;text-align:center;">

		<tr>
			<th style="font-size:25px;"><img alt="pagina" class="icono" src="../../img/page.png"/></th>
			<th style="font-size:25px;"><img alt="localizacion" class="icono" src="../../img/loc.png"/></th>
			<th style="font-size:25px;"><img alt="pagina" class="icono" src="../../img/city.png"/></th>
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
	
	$consulta=mysqli_query ($GLOBALS['conexion'], "SELECT distinct(tx_ipRemota),tx_pagina FROM tbl_tracking WHERE dt_fechaVisita=DATE(NOW()) LIMIT 100");
	
	$x=1;
	
	while($fila = mysqli_fetch_row($consulta)){

		if( !is_private_ip($fila[0])){

			$geo = json_decode(file_get_contents('http://extreme-ip-lookup.com/json/'.$fila[0]));
			
			$region=$geo->region;
			
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
				$country ="uk";
				break;
			}
			
		switch(substr($fila[1],strrpos($fila[1], "/")+1,strlen($fila[1]))){
			
			case 'index.php':
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
		
	
			print '<a target="_blank" href="'.$fila[1].'"/>
			<img class="icono" src="../../img/'.$procedencia.'.png"/></td>';
			
			if($country!='local'){
				print '<td><img src="../../img/countries/'.$country.'.png"/></td>';
			}
			
			else{
				print '<td><span>'.$country.'</span></td>';
			}
			
			if($region==""){
				$region=$fila[0];
			}
			
			print '<td style="font-size:20px;">'.$region.'</td></tr>';
				
			$x++;	
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