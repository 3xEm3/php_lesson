<?php

include "db.php";

$session = session_id();

if ($_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];
    $result = mysqli_query($db,"SELECT `session_id` FROM `basket` WHERE `id`={$id}");
    $row = mysqli_fetch_assoc($result);
    if ($session == $row['session_id'])
        mysqli_query($db, "DELETE FROM `basket` WHERE `basket`.`id` = {$id}");
    header("Location: /basket.php");
}

$basket = mysqli_query($db, "SELECT basket.id basket_id, goods.image, goods.id good_id, goods.name, goods.description, goods.price FROM basket,goods WHERE basket.good_id=goods.id AND session_id = '{$session}'");

$result = mysqli_query($db, "SELECT SUM(goods.price) as summ  FROM basket,goods WHERE basket.good_id=goods.id AND  session_id = '{$session}'");
$row = mysqli_fetch_assoc($result);
$summ = $row['summ'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<? include "menu.php" ?>

<? foreach ($basket as $item): ?>
    <div>

            <h3><?= $item['name'] ?></h3>
            <img src="/img/<?= $item['image'] ?>" width="50" alt=""><br>
            Цена: <?= $item['price'] ?><br><br>
        </a>
        <a href="?action=delete&id=<?= $item['basket_id'] ?>">
            <button>Удалить</button>


    </div><hr>

<? endforeach; ?>
<br>
<strong>Итого: <?=$summ?></strong>
</body>
</html>