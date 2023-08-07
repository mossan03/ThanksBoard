<?php
session_start();

// 既存セッション削除
unset($_SESSION['user']);
unset($_SESSION['error']);

function h ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$id = h($_POST['id']);
$pass = h($_POST['password']);

require 'pdo.php';

if ($id !== null){

    $sql = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $sql->bindValue(1, $id, PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetch();

    if (password_verify($pass, $result['password'])) {
        $_SESSION['user'] = h($result['id']);
        header('Location: home.php');
    } else {
        $_SESSION['error'] = 'ユーザIDまたはパスワードが違います';
        header('Location: index.php');
        exit;
    }

} else {
    $_SESSION['error'] = 'ユーザIDまたはパスワードが違います';
    header('Location: index.php');
    exit;
}
