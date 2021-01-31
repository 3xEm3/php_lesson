<?php

$type = $_FILES['image']['type'];
$tmp_name = $_FILES['image']['tmp_name'];
$path = 'img/' . $_FILES['image']['name'];

$size = 1024 * 1024 * 5; // 5Mbyte
$types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg');

if($_FILES['image']['size'] > $size ){
    die ('Очень большой файл');
}

if(!in_array($type, $types)){
    die ('Формат картинки не поддерживается!');
}

if(copy($tmp_name,$path)) {
    //echo 'Изображение успешно загружено';
    header("Location: /lesson_4/task_1/index.php?m=1");
}



