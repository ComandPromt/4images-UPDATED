<?php 
include_once("../config.php");
include_once("db_connect.php");
$sql = 'SELECT image_id, image_media_file FROM '.$prefix."images ORDER BY 1 DESC LIMIT 4";
$resultset = mysqli_query($conexion, $sql) or die("database error:". mysqli_error($conexion));
$image_count = 0;
$button_html = '';		
$slider_html = '';	
$thumb_html = '<ul class="thumbnails-carousel clearfix">';
while( $rows = mysqli_fetch_assoc($resultset)){	
	$active_class = "";			
	if(!$image_count) {
		$active_class = 'active';					
		$image_count = 1;
	}	
	$image_count++;
	$thumb_image = "nature_thumb_".$rows['id'].".jpg";	
	// slider image html
	$slider_html.= "<div class='item ".$active_class."'>";
    $slider_html.= "<img src='images/".$rows['image']."' alt='1.jpg' class='img-responsive'>";
    $slider_html.= "<div class='carousel-caption'></div></div>";
	// Thumbnail html
	$thumb_html.= "<li><img src='images/".$thumb_image."' alt='$thumb_image'></li>";
	// Button html
	$button_html.= "<li data-target='#carousel-example-generic' data-slide-to='".$image_count."' class='".$active_class."'></li>";
}
?>