<?if (!$auth) :?>

    <form method="post">
        <input type='text' name='login' placeholder='Логин'>
        <input type='password' name='pass' placeholder='Пароль'>
        <input type='submit' name='send'>
    </form>

<? else: ?>
    Добро пожаловать! <?=$user?> <a href="/?logout">Выход</a><br>
<? endif; ?>


<a href="/">Галерея</a>
<a href="/catalog.php">Каталог</a>
<a href="/basket.php">Корзина <?=$count?> </a>&nbsp;
<a href="/feedback.php">Отзывы</a>