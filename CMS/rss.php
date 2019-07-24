<?php

session_start();

$_SESSION['track']=true;

$_SESSION['pagina'] = 'rss.php';

include('config.php');

include('includes/funciones.php');

track();

$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

$result = mysqli_query($GLOBALS['conexion'],'SELECT image_name,cat_id,image_media_file,image_id FROM
 '.$GLOBALS['table_prefix'].'images ORDER BY image_id desc LIMIT 10');

header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="iso-8859-1"?>';

echo '<rss version="2.0">';

echo "<channel>";
echo '<title>'.$GLOBALS['site_name'].'</title>';
echo '<description>'.$GLOBALS['site_name'].'</description>';

while ($registro = mysqli_fetch_array($result)){

   echo '<item>';
   
   echo '
   
   <title>'.$registro[0].'</title>
   
	<link>http://'.obtener_direccion().'/details.php?image_id='.$registro[3].'</link>

	<description>'.$registro[0].'</description>
  

   <enclosure url="http://'.obtener_direccion().'/data/media/'.$registro[1].'/'.$registro[2].'" length="48537" type="image/jpeg"/>
   <guid isPermaLink="false">http://'.obtener_direccion().'/details.php?image_id='.$registro[3].'</guid>
   </item>';
}

mysqli_close($GLOBALS['conexion']);

echo '</channel>
</rss>';

?>