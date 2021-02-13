<?php
session_start();
include "db.php";

$goods = mysqli_query($db, "SELECT * FROM `goods`");

if ($_GET['action'] == 'add') {
    $id = (int)$_GET['id'];
    $session = session_id();
    mysqli_query($db, "INSERT INTO `basket`(`good_id`, `session_id`) VALUES ({$id},'{$session}')");
    header("Location: /catalog.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<? include "menu.php" ?>

<? foreach ($goods as $item): ?>
    <div>
        <a href="/item.php?id=<?= $item['id'] ?>">
            <h3><?= $item['name'] ?></h3>
            <img src="/img/<?= $item['image'] ?>" width="100" alt=""><br>
            Цена: <?= $item['price'] ?><br><br>
        </a>
        <a href="?action=add&id=<?= $item['id'] ?>">
            <button>Купить</button>
        </a>

        <hr>

    </div>

<? endforeach; ?>

</body>
</html>