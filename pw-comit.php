<?php
session_start();

unset($_SESSION['error']);

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require 'html/login-header.html';
?>

    <div class="sub-wrapper">
      <p>
        <?= $_SESSION['msg']; ?>
      </p>
      <p>
        <button onclick="location.href='mypage.php'" class="button">マイページへ</button>
      </p>
    </div>

<?php require 'html/login-footer.html'; ?>