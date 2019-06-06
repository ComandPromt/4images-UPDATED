<?php

session_start();

$_SESSION['track']=true;

include_once('config.php');

include('includes/funciones.php');

cabecera();

poner_menu();

print '<br/><br/><div style="margin-left:60px;padding-bottom:30px;" class="table-responsive-xs">';

ver_tabla('SELECT image_media_file,I.cat_id,cat_name,image_rating FROM ' .
      $GLOBALS['table_prefix'] .'images I JOIN '.$GLOBALS['table_prefix'].'categories C ON I.cat_id=C.cat_id ORDER BY image_rating DESC LIMIT 10','top');

print '<hr style="margin-left:-50px;width:100%;"/>';

ver_tabla('SELECT image_media_file,I.cat_id,cat_name,image_hits FROM ' .
      $GLOBALS['table_prefix'] .'images I JOIN '.$GLOBALS['table_prefix'].'categories C ON I.cat_id=C.cat_id ORDER BY image_hits DESC LIMIT 10','view');

print '<hr style="margin-left:-50px;width:100%;"/>';

ver_tabla('SELECT image_media_file,I.cat_id,cat_name,image_downloads FROM ' .
      $GLOBALS['table_prefix'] .'images I JOIN '.$GLOBALS['table_prefix'].'categories C ON I.cat_id=C.cat_id ORDER BY image_downloads DESC LIMIT 10','download');

print '</div>';

restablecer_pass();

footer();
 
?>