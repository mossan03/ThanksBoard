<?php
session_start();

unset($_SESSION['error']);

function h ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['user'])) {

    require 'pdo.php';

    // DBのuserからpassword取得
    $sql_select = $pdo->prepare('SELECT password FROM user WHERE id = ?');
    $sql_select->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
    $sql_select->execute();
    $result = $sql_select->fetch(PDO::FETCH_ASSOC);

    $pass = h($_POST['pass']);
    $new_pass = h($_POST['new_pass']);
    $check_pass = h($_POST['check_pass']);

    // バリデーションチェック
    if (!password_verify($pass, $result['password'])) {
        $_SESSION['error'] = '※パスワードが違います';
        header('Location: pw-change.php');
        exit;
    } else
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $new_pass)) {
        $_SESSION['error'] = '※パスワードは半角英数字8文字以上で、英大文字、英子文字、数字を最低1個以上含む必要があります';
        header('Location: pw-change.php');
        exit;
    } else
    if ($new_pass !== $check_pass) {
        $_SESSION['error'] = '※確認用パスワードが一致しません';
        header('Location: pw-change.php');
        exit;
    } else {
        $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT); 
        $sql_update = $pdo->prepare('UPDATE user SET password = ? WHERE id = ?');
        $sql_update->bindParam(1, $hash_pass, PDO::PARAM_STR);
        $sql_update->bindParam(2, $_SESSION['user'], PDO::PARAM_STR);
        $sql_update->execute();
        $_SESSION['msg'] = 'パスワードを変更しました。';
        header('Location: pw-comit.php');
    }

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}