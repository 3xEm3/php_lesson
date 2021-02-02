<html>
<head>
<title>Галерея</title>
</head>
    <body>
<!--
1. Создать галерею фотографий. Она должна состоять всего из одной странички, на которой пользователь видит все картинки в уменьшенном виде и форму для загрузки нового изображения. При клике на фотографию она должна открыться в браузере в новой вкладке. Размер картинок можно ограничивать с помощью свойства width. При загрузке изображения необходимо делать проверку на тип и размер файла.
-->
    <style>
        .gul-img img {
            margin: 5px;
        }
        
        .upload {
            margin-top: 10px;
            padding-top: 5px;
            border-top: 1px solid #ccc;
        }
        input {
            margin:5px;
        }
        .message {
			text-align: center;
			border: 1px solid #bdb700;
		}
        .message p{
			font-size: 16px;
			color: red;
		}
    </style>
    
    <div class="gallery">
        <?php include('gallery.php') ?>
    
    <div>
    
    
    
    <div class="upload">
		<?php
			if($_GET && isset($_GET['m'])){ 
				echo '<div class="message"><p>Поздравялем! Картинка успешно загружена!</p></div>';
			}
		?>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image"><br>
            <input type="submit" value="Загрузить">
        </form>
    </div>
    
    
    </body>
</html>
