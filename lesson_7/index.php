<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("IMG_BIG", ROOT . "/gallery_img/big/");
define("IMG_SMALL", ROOT . "/gallery_img/small/");

include('classSimpleImage.php');
include('db.php');


$result = mysqli_query($db, "SELECT * FROM `images` ORDER BY likes DESC ");


if (isset($_POST['load'])) {
    include "upload.php";
}


?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>

</head>

<body>
<div id="main">
    <?php include "menu.php"?>
    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <? if ($result): ?>
            <?php foreach ($result as $filename): ?>
                <a rel="gallery" class="photo" href="/image.php?id=<?= $filename['id'] ?>">
                    <img src="/gallery_img/small/<?= $filename['filename'] ?>" width="150">
                </a>
                <?= $filename['likes'] ?>
            <? endforeach; ?>
        <? else: ?>
            Галерея пуста.
        <? endif; ?>
    </div>
    Загрузить изображение:
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Загрузить" name="load">
    </form>
</div>

</body>
</html>
