<?php
include('db.php');

$row = [];
$buttonText = "Отправить";
$action = "add";

if ($_GET['action'] == 'edit') {
    $id = (int)$_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM `feedback` WHERE id = {$id}");
    $row = mysqli_fetch_assoc($result);
    $buttonText = "Править";
    $action = "save";
}

if ($_GET['action'] == "save") {
    $id = (int)$_POST['id'];
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db,$_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db,$_POST['feedback'])));
    $sql = "UPDATE `feedback` SET `name` = '{$name}', `feedback` = '{$feedback}' WHERE `feedback`.`id` = {$id};";
    $result = mysqli_query($db, $sql);

    header("Location: ?message=edit");
die();
}

if ($_GET['action'] == 'add') {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
    $sql = "INSERT INTO `feedback` (`name`, `feedback`) VALUES ('{$name}', '{$feedback}');";
    $result = mysqli_query($db, $sql);
    header("Location: ?message=OK");
}

$message = [
        "OK" => "Сообщение добавлено.",
        "edit" => "Сообщение изменено."
];


$result = mysqli_query($db, "SELECT * FROM `feedback` ORDER BY id DESC ");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php include "menu.php"?>
<h2>Отзывы</h2>
<?=$message[$_GET['message']]?>
<form action="?action=<?=$action?>" method="post">
    <input hidden type="text" name="id" value="<?=$row['id']?>"><br>
    <input type="text" placeholder="Имя" name="name" value="<?=$row['name']?>"><br>
    <input type="text" placeholder="Отзыв" name="feedback" value="<?=$row['feedback']?>"><br>
    <input type="submit" name="ok" value=<?=$buttonText?>><br>
</form><br>
<? foreach ($result as $item):?>
<div>
    <strong><?=$item['name']?></strong>: <?=$item['feedback']?>
    <a href="?action=edit&id=<?=$item['id']?>">[править]</a>
</div>
<?endforeach;?>
</body>
</html>