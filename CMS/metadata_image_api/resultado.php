<?php

session_start();

function deliver_response($status,$tipo,$valores){

	header('Content-Type:application/json');
    header("HTTP/1.1 $status $status_message");
	$response['respuesta'] = $status;
	$response['tipos'] = (array)$tipo;
    $response['valores'] = (array)$valores;
    $json_response = json_encode($response);
    echo $json_response;
}

function quitar_caracteres_raros($cadena){
	
	$caracteres = '                 d2 d3 d4 d5 d6 1 _ 1 /       ±   %? % d0  &(    ½% #) # (\' ØÜ ØÞ = Æ ß æ ð ¢ £ ¤ ¥ ¦ § ¨ © ¬ ® ¯ ± ¶ · ¼ ½ ¾ × ÷ " \' < >   ☺ ☻ ♥ ♦ ♣ ♠ • ◘ ○ ◙ ♂ ♀ ♪ ♫ ☼ ► ◄ ↕ ‼ ▬ ↨ ↑ ↓ → ← ∟ ↔ ▲ ▼ ⌂ $ ░ ▒ ▓ │ ┤ Â Á À ╣ ║ ╗ ╝ ┐ └ ┴ ┬ ├ ─ ┼ ╚ ╔ ╩ ╦ ╠ ═ ╬ ┘ ┌ █ ▄ ▀ ■ ( )';
   
	$caracteres = explode(' ',$caracteres);
   
	$nchar      = count($caracteres);
   
	$base       = 0;

	while($base<$nchar){
	 
		$cadena = str_replace($caracteres[$base],'',$cadena);

		$base++;
	}
   
	return $cadena;
}

function limpiar_array($datos){
	
	for($x=0;$x<count($datos);$x++){
		
		$datos[$x]=utf8_encode($datos[$x]);

		$datos[$x]=quitar_caracteres_raros($datos[$x]);

		$datos[$x]=str_replace('  ',' ',$datos[$x]);
		
		$datos[$x]=trim($datos[$x]);
	}
	
	return $datos;
}

if(isset($_GET['respuesta'])){

	if($_GET['respuesta']){
	
	$_SESSION['imagen']=limpiar_array($_SESSION['imagen']);

		
		if($_SESSION['tipo'][0]==null){
			$_SESSION['tipo'][0]="null";
		}

		if($_SESSION['imagen'][0]==null){
			$_SESSION['imagen'][0]="null";
		}

		deliver_response(200, $_SESSION['tipo'],$_SESSION['imagen']);
	}

	else{

		deliver_response(200, $_SESSION['tipo'],$_SESSION['imagen']);
	}
	
}

else{

	deliver_response(400, $_SESSION['tipo'],$_SESSION['imagen']);
}

session_unset();

?>