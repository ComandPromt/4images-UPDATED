<?php

function deliver_response($status, $valor){
	
    header("HTTP/1.1 $status $status_message");
    $response['respuesta'] = $status;
    $response['resultado'] = $valor;

    $json_response = json_encode($response);
    echo $json_response;
}

function getColorPallet($imageURL, $palletSize=[16,8]){ 

	$colores_bn=array('#000000','#151515','#1c1c1c','#2e2e2e','#424242','#585858','#6e6e6e','#848484',
	'#484848','#606060','#a8a8a8','#303030','#909090','#787878','#c0c0c0','#181818',
	'#f0f0f0','#d8d8d8','#a4a4a4','#bdbdbd','#e6e6e6','#f2f2f2','#fafafa',
	'#4f4e4e','#a09d9d','#ffffff','#fcfbff','#aeaeae','#f8f9fb','#5d5e62','#f3f2f7',
	'#fbfbfb','#444446','#fffeff','#212224','#f9f9f9','#f0eff4','#18191b','#fdfdfd',
	'#fefefe','#fcfcfc','#d3d3d3','#747474','#d1d1d1','#dddddd','#878787',
	'#141414','#1a1a1a','#ebebeb','#dfdfdf','#e4e4e4','#d4d4d4','#6b6b6b','#f4f4f4',
	'#dbdbdb','#cccccc','#b6b6b6','#d7d7d7','#c6c6c6','#c8c8c8','#353535','#5d5d5d',
	'#515151','#686868','#838383','#e0e0e0','#d6d6d6','#c4c4c4','#646464','#b8b8b8',
	'#3a3a3a','#343434','#252525','#c3c3c3','#999999','#9e9e9e','#cacaca','#949494',
	'#161616','#121212','#171717','#4a4a4a','#d2d2d2','#cdcdcd','#767676','#2a2a2a',
	'#2d2d2d','#3f3f3f','#b0b0b0','#f6f6f6','#bababa','#c2c2c2','#b7b7b7','#f7f7f7',
	'#242424','#acacac','#ababab','#aaaaaa','#b4b4b4','#b3b3b3','#c5c5c5','#494949',
	'#b9b9b9','#b2b2b2','#b5b5b5','#adadad','#a6a6a6','#afafaf','#bebebe','#c7c7c7',
	'#c1c1c1','#a3a3a3','#979797','#414141','#7e7e7e','#474747','#363636','#313131',
	'#444444','#555555','#676767','#f5f5f5','#272727','#3b3b3b','#282828','#202020',
	'#5b5b5b','#969696','#919191','#939393','#bcbcbc','#696969','#656565','#7a7a7a',
	'#545454','#404040','#454545','#535353','#4d4d4d','#5f5f5f','#9d9d9d','#989898',
	'#787878','#a5a5a5','#a0a0a0','#262626','#333333','#464646','#505050','#ffffff',
	'#9f9f9f','#a9a9a9','#cfcfcf','#4b4b4b','#3c3c3c','#1b1b1b','#757575','#6c6c6c',
	'#8f8f8f','#9b9b9b','#2f2f2f','#373737','#323232','#6d6d6d','#a1a1a1','#848484',
	'#4e4e4e','#4c4c4c','#9c9c9c','#d0d0d0','#9a9a9a','#bfbfbf','#292929',
	'#b1b1b1','#cecece','#dadada','#e2e2e2','#e1e1e1','#dedede','#e7e7e7','#8c8c8c',
	'#d9d9d9','#dcdcdc','#6a6a6a','#6f6f6f','#8d8d8d','#959595','#393939','#808080',
	'#797979','#434343','#3d3d3d','#707070','#8a8a8a','#909090','#737373','#2b2b2b',
	'#bdbdbd','#232323','#7c7c7c','#60606','#80808','#222222','#626262','#575757',
	'#30303','#b0b0b','#d0d0d','#191919','#40404','#717171','#727272','#50505',
	'#a0a0a','#e0e0e','#90909','#898989','#111111','#101010','#f0f0f','#c0c0c',
	'#7d7d7d','#20202','#212121','#70707','#7f7f7f','#8e8e8e','#888888','#525252',
	'#7b7b7b','#c9c9c9','#929292','#858585','#8b8b8b','#616161','#5a5a5a',
	'#595959','#1d1d1d','#565656','#2c2c2c','#f8f8f8','#818181','#777777','#5c5c5c',
	'#636363','#383838','#4f4f4f','#131313','#1f1f1f','#1e1e1e','#bbbbbb','#e9e9e9',
	'#e8e8e8','#5e5e5e','#e5e5e5','#e3e3e3','#a2a2a2','#3e3e3e','#cacaca','#cbcbcb',
	'#d5d5d5','#666666','#f1f1f1','#ededed','#eaeaea','#eeeeee','#efefef','#ececec',
	'#828282','#a7a7a7','#868686','#f3f3f3','#10101','#0f0f0f','#0C0C0C','#090909','#060606','#030303');

    if(!$imageURL) return false;

    $img = imagecreatefromjpeg($imageURL);

    $imgSizes=getimagesize($imageURL);

    $resizedImg=imagecreatetruecolor($palletSize[0],$palletSize[1]);

    imagecopyresized($resizedImg, $img , 0, 0 , 0, 0, $palletSize[0], $palletSize[1], $imgSizes[0], $imgSizes[1]);

    imagedestroy($img);

    $colors=[];

    for($i=0;$i<$palletSize[1];$i++){
		
        for($j=0;$j<$palletSize[0];$j++){
			
			$color='#'.dechex(imagecolorat($resizedImg,$j,$i));

			if(!in_array($color, $colores_bn)){
			            $colors[]=$color;	
			}

		}
	}
	
    imagedestroy($resizedImg);

    $colors=array_unique($colors);

    return $colors;

}

function png_a_jpg($imagen) {

	if(substr($imagen, -3)=="png" && file_exists($imagen)){
		$jpg = substr($imagen, 0, -3) . "jpg";
		$image = imagecreatefrompng($imagen);
		imagejpeg($image, $jpg, 100);
		unlink($imagen);
	}
}

?>