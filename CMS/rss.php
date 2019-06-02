<?php

include('config.php');
include('includes/funciones.php');

$GLOBALS['conexion'] = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'],
        $GLOBALS['db_password'], $GLOBALS['db_name'])
    or die("No se pudo conectar a la base de datos");

$result = mysqli_query($GLOBALS['conexion'],'select image_name,cat_id,image_media_file from '.$GLOBALS['table_prefix'].'images order by image_id desc limit 10');

header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="iso-8859-1"?>';

echo '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">';

echo "<channel>";
echo '<title>'.$GLOBALS['site_name'].'</title>';
echo "<language>es-es</language>";

while ($registro = mysqli_fetch_array($result)){

   echo '<item>';
   
   echo '
   
   <title>'.$registro[0].'</title>
   
	<link>http://'.obtener_direccion().'/data/media/'.$registro[1].'/'.$registro[2].'</link>
	
	<pubDate>'.$registro[1].'</pubDate>
   ';

   print '</item>';
}

mysqli_close($GLOBALS['conexion']);

echo '</channel>
</rss>';

?>