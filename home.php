<?php
session_start();

unset($_SESSION['error']);

date_default_timezone_set('Japan');
$postDate = date('Y/m/d H:i:s');
$message_array = array();
$user_array = array();
$error = null;

function h ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function h_d ($string) {
  return htmlspecialchars_decode($string);
}

if (isset($_SESSION['user'])) {

    require 'pdo.php';

    // DBのthanksから全取得(新着順・時間の降順)
    $message_array = $pdo->query('SELECT * FROM thanks ORDER BY postDate DESC');
    
    // メッセージの並び替え
    if (!empty($_POST['select'])) {
        switch ($_POST['select']) {
            case 'desc':
                $message_array = $pdo->query('SELECT * FROM thanks ORDER BY postDate DESC');
                break;
            case 'asc':
                $message_array = $pdo->query('SELECT * FROM thanks ORDER BY postDate ASC');
                break;
            case 'mine':
                $message_array = $pdo->prepare('SELECT * FROM thanks WHERE dear = ?');
                $message_array->bindParam(1, $_SESSION['user'], PDO::PARAM_STR);
                $message_array->execute();
                break;
        }  
    }

    // DBのuserからidのみ取得
    $user_array = $pdo->query('SELECT id FROM user');

    // 投稿
    if (!empty($_POST['post'])) {
        $dear = $_POST['dear'];
        $message = h($_POST['message']);
        if (empty($dear)) {
            $error = '※Dearを選択してください';
        } else
        if (empty($message)) {
            $error = '※Messageを入力してください';
        } else 
        if (mb_strlen($message) > 108) {
            $error = '※108文字以内で入力してください';
        } else {
            $sql = $pdo->prepare('INSERT INTO thanks VALUES (null, ?, ?, ?, ?)');
            $sql->bindParam(1, $dear, PDO::PARAM_STR);
            $sql->bindParam(2, $_SESSION['user'], PDO::PARAM_STR);
            $sql->bindParam(3, $message, PDO::PARAM_STR);
            $sql->bindParam(4, $postDate);
            $sql->execute();
            header('Location: home.php');
        }
    }

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit; 
}

require 'html/login-header.html';
?>

    <div class="home-top">
      <h2 class="user-wrapper">
        <?= 'clubID:'. h($_SESSION['user']); ?>
      </h2>
      <form action="#" class="select-wrapper" method="post">
        <p>並び替え：</p>
        <select name="select">
          <option value="desc">新しい順</option>
          <option value="asc">古い順</option>
          <option value="mine">自分宛のみ</option>
        </select>
        <input type="submit" value="確定" class="button">
      </form>
    </div>
    <div class="article-wrapper">
      <?php foreach($message_array as $row): ?>
      <article>
        <p class="message"><?= h_d($row['message']); ?></p>
        <time class="message-date"><?= h($row['postDate']); ?></time>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="post-wrapper accordion">
      <h2 class="pointer">
        <span class="material-symbols-outlined">edit</span>Post
      </h2>
      <div class="hidden">
        <form action="#" method="post">
          <div class="dear-area">
            <p>Dear</p>
            <select name="dear" id="dear">
              <option value="">
              <?php
              foreach($user_array as $row) {
                  echo '<option value="'. h($row['id']) . '">'. h($row['id']). '</option>';
                  echo "\n";
              }
              ?>
            </select>
          </div>
          <p>Message</p>
          <textarea name="message" placeholder="108文字以内" maxlength=108></textarea>
          <div class="post-submit-outer">
            <p><input type="submit" name="post" value="Post" class="button"></p>
            <p class="error"><?= $error ?></p>
          </div>
        </form>
      </div>
    </div>

<?php
require 'html/login-footer.html';
?>