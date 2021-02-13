<?php
include "db.php";

//TODO получить id и один товар из БД

$goods = mysqli_query($db, "SELECT * FROM `goods`");


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<? include "menu.php"?><br>

вывести один товар по id

</body>
</html>