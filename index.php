<?php
session_start();

require 'html/logout-header.html';
?>

    <form action="login-function.php" method="post" class="sub-wrapper">
      <p>
        <input type="text" name="id" placeholder="ユーザID" required>
      </p>
      <p>
        <input type="password" name="password" placeholder="パスワード" required>
      </p>
      <p>
        <input type="submit" value="ログイン" class="button">
      </p>
    </form>
    <div class="error subpage-error">
      <?= $_SESSION['error'] ?? ''; ?>
    </div>

<?php require 'html/logout-footer.html'; ?>