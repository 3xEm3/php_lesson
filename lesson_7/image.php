<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("IMG_BIG", ROOT . "/gallery_img/big/");
define("IMG_SMALL", ROOT . "/gallery_img/small/");


include('db.php');

$id = (int)$_GET['id'];




mysqli_query($db, "UPDATE `images` SET likes=likes + 1 WHERE id = {$id}");
$result = mysqli_query($db, "SELECT * FROM `images` WHERE id = {$id}");
$message = "";
if ($result->num_rows != 0) $filename = mysqli_fetch_assoc($result);
else $message = "Такого изображения нет в БД";





$row_feed = [];
$buttonText = "Отправить";
$action = "add";

if ($_GET['action'] == 'delete') {
    $id_feed = (int)$_GET['id_feed'];
    $result_feedback = mysqli_query($db, "DELETE FROM `feedback` WHERE id = {$id_feed}");
    header("Location: ?id={$id}&message=delete");
}

if ($_GET['action'] == 'edit') {
    $id_feed = (int)$_GET['id_feed'];
    $result_feedback = mysqli_query($db, "SELECT * FROM `feedback` WHERE id = {$id_feed}");
    $row_feed = mysqli_fetch_assoc($result_feedback);
    $id = $row_feed['id_image'];
    $buttonText = "Править";
    $action = "save";
}


if ($_GET['action'] == "save") {
    $id_image = (int)$_POST['id_image'];
    $id_feed = (int)$_POST['id_feedback'];
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db,$_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db,$_POST['feedback'])));
    $sql = "UPDATE `feedback` SET `name` = '{$name}', `feedback` = '{$feedback}' WHERE `feedback`.`id` = {$id_feed};";
    $result_feedback = mysqli_query($db, $sql);

    header("Location: ?id={$id_image}&message=edit");
    die();
}

if ($_GET['action'] == 'add') {
    $id = (int)$_POST['id_image'];
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
    $sql = "INSERT INTO `feedback` (`name`, `feedback`, `id_image`) VALUES ('{$name}', '{$feedback}', '{$id}');";
    mysqli_query($db, $sql);
    header("Location: ?id={$id}&message=OK");
}

$message_feed = [
    "OK" => "Сообщение добавлено.",
    "edit" => "Сообщение изменено.",
    "delete" => "Сообщение удалено."
];


$result_feedback = mysqli_query($db, "SELECT * FROM `feedback` WHERE id_image = {$id} ORDER BY id DESC ");
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
        <? if (empty($message)): ?>
        Просмотров:<?=$filename['likes']?><br>
            <img src="/gallery_img/big/<?= $filename['filename'] ?>" width="400">
        <? else: ?>
            <div style="color: #ff4e46"><?= $message ?></div>
        <? endif; ?>

    </div>


    <h2>Отзывы</h2>
    <?=$message_feed[$_GET['message']]?>
    <form action="?action=<?=$action?>" method="post">
        <input hidden type="text" name="id_image" value="<?=$id?>"><br>
        <input hidden type="text" name="id_feedback" value="<?=$row_feed['id']?>"><br>
        <input type="text" placeholder="Имя" name="name" value="<?=$row_feed['name']?>"><br>
        <input type="text" placeholder="Отзыв" name="feedback" value="<?=$row_feed['feedback']?>"><br>
        <input type="submit" name="ok" value=<?=$buttonText?>><br>
    </form><br>
    <? foreach ($result_feedback as $item):?>
        <div>
            <strong><?=$item['name']?></strong>: <?=$item['feedback']?>
            <a href="?id=<?=$id?>&action=edit&id_feed=<?=$item['id']?>">[править]</a>
            <a href="?id=<?=$id?>&action=delete&id_feed=<?=$item['id']?>">[X]</a>
        </div>
    <?endforeach;?>
</div>

</body>
</html>
