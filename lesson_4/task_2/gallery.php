<?php

$dir = 'img/';
$dir_thumb = 'img/thumb/';
$images = scandir($dir);

foreach ($images as $image){

    if($image != '.' && $image != '..' && $image != 'thumb') {
		echo '<a class="gul-img" href="' . $dir . $image . '" target="_blank"><img src="' . $dir_thumb . 'thumb_' . $image . '"/></a>';
	}

}
