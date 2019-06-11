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

$nombres=array("Russia",
    "USA",
	"Francia",
	"Alemania",
	"Brasil",
	"Italia");
	
$hits_rusia=ver_hits('rusia');

$hits_usa=ver_hits('us');

$hits_francia=ver_hits('fr');

$hits_alemania=ver_hits('de');

$hits_brasil=ver_hits('brasil');

$hits_italia=ver_hits('italia');

//$hits_india=ver_hits('india');

/*
$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
		or die("No se pudo conectar a la base de datos");
	
	mysqli_set_charset($GLOBALS['conexion'],"utf8");

	$consulta=mysqli_query($GLOBALS['conexion'],"SELECT count(id_tracking) FROM tbl_tracking 
	
	where pais!='rusia' AND pais!='us'  AND pais!='fr'  AND pais!='de'  AND pais!='brasil'
	 AND pais!='italia'  AND pais!='india'
	");
    
	$fila = mysqli_fetch_row($consulta);
	
$hits_otros=$fila[0];
*/

$datos=array($hits_rusia, $hits_usa,$hits_francia,
 $hits_alemania, $hits_brasil,$hits_italia);

?>
<div class="content" style="margin-left:-75px;" >
<div style="height:440px;width:370px;padding-top:80px;">
<canvas  style="width:100%;height:100%;" id="oilChart"></canvas>
</div>
<br/><br/>
<div id="chartContainer" style="margin:auto;height:500px;width:100%;"></div>
<br/><br/>
<div id="chartContainer2" style="margin:auto;height:500px;width:100%;"></div>
<br/><br/>
<div style="margin:auto;height:440px;width:370px;">
<canvas  style="width:100%;height:100%;" id="oilChart2"></canvas>
</div>

    <!-- javascript -->
	<script src="../../js/canvasjs.min.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/Chart.min.js"></script>
 <script>
 var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Arial";
Chart.defaults.global.defaultFontSize = 30;

var oilData = {
    labels:<?php echo json_encode($nombres, JSON_NUMERIC_CHECK)?>,

    datasets: [
        {
            data: <?php echo json_encode($datos, JSON_NUMERIC_CHECK)?>,
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#84FF63",
                "#8463FF",
                "#6384FF"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'doughnut',
  data: oilData
});


    </script>
	</div>
<?php

restablecer_pass('../../');

footer('../../');

?>