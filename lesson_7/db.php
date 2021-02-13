<?php
session_start();
$db = @mysqli_connect('localhost', 'root', '', 'shop2') or Die(mysqli_connect_error());

$session = session_id();
$result = mysqli_query($db, "SELECT COUNT(id) as count FROM `basket` WHERE `session_id`='{$session}'");
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

$auth = false;

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

if (is_auth()) {
    $auth = true;
    $user = get_user();
}

function is_auth()
{
    return isset($_SESSION['login']);
}

function get_user()
{
    return $_SESSION['login'];
}


if (isset($_POST['send'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (!auth($login, $pass)) {
        Die('Не верный логин пароль');
    } else {
        $auth = true;
        $user = get_user();
    }
}

function auth($login, $pass)
{
    global $db;
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login)));
    $result = mysqli_query($db, "SELECT * FROM users WHERE login = '{$login}'");
    $row = mysqli_fetch_assoc($result);

    if (password_verify($pass, $row['pass'])) {
        $_SESSION['login'] = $login;
        return true;
    }
    return false;

}