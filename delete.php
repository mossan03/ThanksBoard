<?php
session_start();

unset($_SESSION['error']);

if (isset($_SESSION['user'])) {

    require 'pdo.php';

    // DBのuserから一致するidを削除し、セッション削除
    $sql = $pdo->prepare('DELETE FROM user WHERE id = ?');
    $sql->bindValue(1, $_SESSION['user'], PDO::PARAM_STR);
    $sql->execute();
    session_destroy();

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require 'html/logout-header.html';
?>

    <div class="sub-wrapper">
      <p>ご利用ありがとうございました！</p>
      <p>
        <button onclick="location.href='index.php'" class="button">ログイン画面へ</button>
      </p>
    </div>

<?php require 'html/logout-footer.html'; ?>