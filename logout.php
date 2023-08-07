<?php
session_start();

unset($_SESSION['error']);

if (isset($_SESSION['user'])) {
    session_destroy();
    $msg = 'ログアウトしました';
} else {
    $msg = 'すでにログアウトしています';
}

require 'html/logout_header.html';
?>

    <div class="sub-wrapper">
      <p>
        <?= $msg ?>
      </p>
      <p>
        <button onclick="location.href='index.php'" class="button">ログイン画面へ</button>
      </p>
    </div>
    
<?php require 'html/logout_footer.html'; ?>