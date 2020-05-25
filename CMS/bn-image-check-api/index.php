<?php

session_start();

include('funciones.php');

if(!isset($_SESSION['respuesta'])){

	if(!file_exists ("uploads")) {
		mkdir("uploads");
	}
	
	if(isset($_POST['subir'])){

		$uploadedfile_size=$_FILES['uploadedfile'][size];
	
		$file_name=$_FILES[uploadedfile][name];
	
		$add="uploads/$file_name";
	
		if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
			
			$extension=substr($file_name,-3);

			rename($add,'uploads/test.'.$extension);
		
		switch($extension){
			
			case "png":
			
				png_a_jpg('test.png');
				
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
			
				if(count(getColorPallet($url))==0){
					
					$_SESSION['respuesta']=true;
				}
		
				else{
					
					$_SESSION['respuesta']=false;
						
				}
				
				unlink($url);
						
				echo '<script>location.href="resultado.php?respuesta='.$_SESSION['respuesta'].'";</script>';
				
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
	
}

?>