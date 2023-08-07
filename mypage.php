<?php
session_start();

unset($_SESSION['error']);

$message_array = array();

function h ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function h_d ($string) {
  return htmlspecialchars_decode($string);
}

if (isset($_SESSION['user'])) {

    require 'pdo.php';

    // DBのthanksから取得(senderが一致)
    $message_array = $pdo->prepare('SELECT * FROM thanks WHERE sender = ?');
    $message_array->bindValue(1, $_SESSION['user'], PDO::PARAM_STR);
    $message_array->execute();

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require 'html/login-header.html';
?>

    <div class="accordion mypage-accordion">
      <h2><span class="material-symbols-outlined">filter_vintage</span>投稿済み一覧</h2>
      <div class="hidden">
        <div class="article-wrapper">
          <?php foreach($message_array as $row): ?>
          <article>
            <p class="message"><?= h_d($row['message']); ?></p>
            <time class="message-date"><?= h($row['postDate']); ?></time>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
      <hr>
    </div>
    <div class="accordion mypage-accordion">
      <h2><span class="material-symbols-outlined">filter_vintage</span>パスワード変更</h2>
      <div class="hidden">
        <div class="area">
          <p>パスワードの変更は下記ボタンからお手続きください。</p>
          <button onclick="location.href='pw-change.php'" class="button">パスワードを変更する</button>
        </div>
      </div>
      <hr>
    </div>
    <div class="accordion mypage-accordion">
      <h2><span class="material-symbols-outlined">filter_vintage</span>退会</h2>
      <div class="hidden">
        <div class="area">
          <p>退会は下記のボタンからお手続きください。</p>
          <p class="error">※退会されますと、再度会員登録することはできません。</p>
          <button id="deleteId" class="button">退会する</button>
        </div>
      </div>
      <hr>
    </div>
    <div class="accordion mypage-accordion">
      <h2><span class="material-symbols-outlined">filter_vintage</span>投稿削除</h2>
      <div class="hidden">
        <div class="area">
          <p>投稿削除は、下記フォームよりご依頼ください。内容を精査した上で削除いたします。</p>
          <form action="#">
            <p>
              投稿日時<input type="datetime-local" required>
            </p>
            <p>
              投稿内容<br>
              <textarea name="post-text" placeholder="該当の投稿内容をコピーペーストしてください" required></textarea>
            </p>
            <p>
              削除してほしい理由<br>
              <textarea name="contact-text" placeholder="例）送信先を間違えたため。誤字脱字があるため。" required></textarea>
            </p>
            <button class="button">確認画面へ</button>
          </form>
        </div>
      </div>
      <hr>
    </div>

<?php require 'html/login-footer.html'; ?>
