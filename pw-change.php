<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require 'html/login_header.html';
?>

    <form action="pw-function.php" method="post" class="sub-wrapper">
      <p>
        <input type="password" name="pass" placeholder="現在のパスワード" required>
      </p>
      <p>
        <input type="password" name="new_pass" placeholder="新しいパスワード" required>
      </p>
      <p>
        <input type="password" name="check_pass" placeholder="新しいパスワード(確認用)" required>
      </p>
      <p>
        <input type="submit" name="submit" value="変更する" class="button">
      </p>
    </form>
    <div class="error subpage-error">
      <?= $_SESSION['error'] ?? ''; ?>
    </div>

<?php require 'html/login_footer.html'; ?>