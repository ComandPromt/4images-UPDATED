<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exif Api</title>
    </head>

    <body>

		<?php
		
		$_SESSION['imagen']=array("null");

		$_SESSION['tipo']=array("null");
		
		function png_a_jpg($imagen) {
		
			if(substr($imagen, -3)=="png" && file_exists($imagen)){
				$jpg = substr($imagen, 0, -3) . "jpg";
				$image = imagecreatefrompng($imagen);
				imagejpeg($image, $jpg, 100);
				unlink($imagen);
			}
		}
		
		session_start();
	
		if(isset($_POST['subir'])){
	
			$uploadedfile_size=$_FILES['uploadedfile'][size];
		
			$file_name=$_FILES[uploadedfile][name];
		
			$add="uploads/$file_name";
		
			if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
				
				$extension=substr($file_name,-3);
	
				rename($add,'uploads/test.'.$extension);
	
				chmod('uploads/test.'.$extension,0777);
			
				switch($extension){
				
					case "png":
	
						png_a_jpg('uploads/test.png');
						
						unlink('uploads/test.png');
	
					break;
					
					case "jpg":
					break;
					
					default:
						unlink('uploads/test.'.$extension);
					break;
				}
	
				$url='uploads/test.jpg';
			
				if(file_exists($url)){
	
					$v_exif = exif_read_data($url, 0, true);
	
					if(!empty($v_exif['IFD0']['Model'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Model'];
						$_SESSION['tipo'][]='Model';
					}
	
					if(!empty($v_exif['IFD0']['DateTime'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['DateTime'];
						$_SESSION['tipo'][]='DateTime';
					}
	
					if(!empty($v_exif['IFD0']['Make'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Make'];
						$_SESSION['tipo'][]='Make';
					}
	
					if(!empty($v_exif['IFD0']['Artist'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Artist'];
						$_SESSION['tipo'][]='Artist';
					}
	
					if(!empty($v_exif['IFD0']['Copyright'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Copyright'];
						$_SESSION['tipo'][]='Copyright';
					}
	
					if(!empty($v_exif['IFD0']['Comments'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Comments'];
						$_SESSION['tipo'][]='Comments';
					}
	
					if(!empty($v_exif['COMMENT'][0])){
						$v_exif['COMMENT'][0]=str_replace("\n","",$v_exif['COMMENT'][0]);
						$_SESSION['imagen'][]=$v_exif['COMMENT'][0];
						$_SESSION['tipo'][]='Comments';
					}
	
					if(!empty($v_exif['IFD0']['Title'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Title'];
						$_SESSION['tipo'][]='Title';
					}
	
					if(!empty($v_exif['IFD0']['Autor'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Autor'];
						$_SESSION['tipo'][]='Autor';
					}
	
					if(!empty($v_exif['IFD0']['Keywords'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Keywords'];
						$_SESSION['tipo'][]='Keywords';
					}
	
					if(!empty($v_exif['IFD0']['Subject'])){
						$_SESSION['imagen'][]=$v_exif['IFD0']['Subject'];
						$_SESSION['tipo'][]='Subject';
					}
					
					unlink($url);

					echo '<script>location.href="resultado.php?respuesta=ok";</script>';
						
				}
		
				else{
					echo '<script>location.href="resultado.php";</script>';
				}
				
			}
		
			else{
				echo '<script>location.href="resultado.php";</script>';
			}
	
		}
		
		print '<div style="margin:auto;text-align:center;">
			
				<form enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'" method="post">
					
					<p>
						<input name="uploadedfile" type="file" />
					</p>
					
					<p>
						<input name="subir" type="submit" value="upload"/>
					</p>
				
				</form>
			
			</div>';
		
			
		?>
		
    </body>
</html>
