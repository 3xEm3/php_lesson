<?php

$name = md5($_FILES['image']['name']);
$type = $_FILES['image']['type'];
$tmp_name = $_FILES['image']['tmp_name'];

$size = 3145728;

if($_FILES['image']['size'] > $size){
    die ('Очень большая картинка');
}

switch($type){
	case 'image/png':
		$path = 'img/' . $name . '.png';
		break;
	
	case 'image/jpeg':
		$path = 'img/' . $name . '.jpeg';
		break;
	
	default: die ('Это не картинка!');
}

function thumbImg($path, $name, $type){
    $w_img = getimagesize($path)[0];
    $h_img = getimagesize($path)[1];
	
    $new_w_img = 400;
    $new_h_img = 250;
    
    switch($type){
		case 'image/png':
			$thumb = imagecreatetruecolor($new_w_img, $new_h_img);
			$source = imagecreatefrompng($path);
			
			$color = imagecolorallocatealpha($thumb,0,0,0,127); 
			imagesavealpha($thumb, true); 
			imagefill($thumb, 0, 0, $color); 
			
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_w_img, $new_h_img, $w_img, $h_img);
			imagepng($thumb, 'img/thumb/thumb_' . $name . '.png');
		break;
		
		case 'image/jpeg':
			$thumb = imagecreatetruecolor($new_w_img, $new_h_img);
			$source = imagecreatefromjpeg($path);
			
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_w_img, $new_h_img, $w_img, $h_img);
			imagejpeg($thumb, 'img/thumb/thumb_' . $name . '.jpeg');
		break;		
	}
}

if(move_uploaded_file($tmp_name, $path)) {
    //echo 'Изображение успешно загружено';
    thumbImg($path, $name, $type);
    header("Location: /lesson_4/task_2/index.php?m=1");
}




    
    
