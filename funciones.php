<?php


function poner_menu(){
	include('config.php');
	$id_categorias=array();
	  $consulta = mysqli_query($conexion, 'SELECT DISTINCT(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id 
IN(SELECT  distinct(cat_parent_id) FROM '.$table_prefix.'categories WHERE cat_parent_id>0)
;');
	  while ($recuento = mysqli_fetch_array($consulta)){
			$id_categorias[]=$recuento[0];
		}

		for($x=0;$x<count($id_categorias);$x++){
			$consulta = mysqli_query($conexion, 'SELECT cat_name FROM '.$table_prefix.'categories WHERE cat_id='.$id_categorias[$x]);
			$nombre = mysqli_fetch_array($consulta);
			print '<li style="color:#1842EC;padding-left:30px;margin-top:-20px;">
			<a style="font-size:30px;" href="#resume"><img alt="'.$nombre[0].'" style="width:100px;height:100px;" src="img/Categories/'.$nombre[0].'.png"/>
			</a>
			<br/><br/>
			<ul style="width:10em;" class="menu">';
			$consulta = mysqli_query($conexion, 'SELECT cat_id,cat_name FROM '.$table_prefix.'categories WHERE cat_parent_id='.$id_categorias[$x]);
			while ($subcategorias = mysqli_fetch_array($consulta)){
				print '<li style="height:10em;" ><a href="categories.php?cat_id='.$subcategorias[0].'">
				<img alt="'.$subcategorias[1].'" src="img/Categories/Subcategories/'.$subcategorias[1].'.png" style="width:100px;height:100px;"/></a></li>';
			}
	
			print '</ul>
			</li>';	
					
		}
}





?>