<?php
session_start();

function h ($string) {
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['user'])) {

    // ワンタイムトークン生成
    $toke_byte = openssl_random_pseudo_bytes(16);
    $csrf_token = bin2hex($toke_byte);
    $_SESSION['csrf_token'] = $csrf_token;

    $name = $_SESSION['user'];
    $post_date = h($_POST['post_date']);
    $post_text = h($_POST['post_text']);
    $reason = h($_POST['reason']);

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require_once 'html/login-header.html';
?>

    <div class="sub-wrapper">
      <h2>確認画面</h2>
      <p>
        内容にお間違いなければ、<br>
        「送信」ボタンを押してください。
      </p>
      <form action="form-comit.php" method="post" class="confirm-area">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>" >
        <input type="hidden" name="name" value="<?= $name; ?>">
        <input type="hidden" name="post_date" value="<?= $post_date; ?>">
        <input type="hidden" name="post_text" value="<?= $post_text; ?>">
        <input type="hidden" name="reason" value="<?= $reason; ?>">

        <h3>投稿日時</h3>
        <p><?= $post_date; ?></p>
        <h3>投稿内容</h3>
        <p><?= $post_text; ?></p>
        <h3>削除してほしい理由</h3>
        <p><?= $reason; ?></p>
        <div class="button-area">
          <input type="submit" name="post" value="送信" class="button">
          <button type="button" onclick="location.href='mypage.php'" class="button">戻る</button>
        </div>
      </form>
    </div>

<?php
require_once 'html/login-footer.html';
?>