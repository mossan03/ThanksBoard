<?php
session_start();

unset($_SESSION['error']);

function h ($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['user'])) {

    // ワンタイムトークン判定
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // 一致しなかった場合
        $h2 = '<h2>送信失敗</h2>';
        $message = '<p>お問い合わせの送信に失敗しました</p>'; 

    } else {
        // 一致した場合、管理者にメール通知
        $name = $_SESSION['user'];
        $post_date = h($_POST['post_date']);
        $post_text = h($_POST['post_text']);
        $reason = h($_POST['reason']);

        mb_language('ja');
        mb_internal_encoding('UTF-8');
        $mail = '********@********';
        $subject = '[Thanks Board] 投稿削除の依頼';

        $body = <<< EOM
Thanks Boardにて削除依頼がありました。
===============================================
【依頼者】
    {$name}
【投稿日時】
    {$post_date}
【投稿内容】
    {$post_text}
【削除してほしい理由】
    {$reason}
===============================================
内容を精査し、処理を行ってください。
EOM;
        $header = 'From: ********@********';
        $send_mail = mb_send_mail($mail, $subject, $body, $header);

        if ($send_mail) {
            $h2 = '<h2>送信完了</h2>';
            $message = '<p>
                          内容を精査した上で削除いたします。<br>
                          処理完了までしばらくお待ちください。
                        </p>
                        <p>
                          なお、ご依頼内容によっては、<br>
                          削除できかねる場合もございます。<br>
                          あらかじめご了承ください。
                        </p>';
        } else {
            $h2 = '<h2>送信失敗</h2>';
            $message = '<p>
                          お問い合わせの送信に失敗しました。
                        </p>
                        <p>
                          マイページの投稿削除から<br>
                          もう一度やり直してください。
                        </p>'; 
        }
    }

} else {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: index.php');
    exit;
}

require_once 'html/login-header.html';
?>

    <div class="sub-wrapper">
      <?= $h2; ?>
      <?= $message; ?>
      <p>
        <button onclick="location.href='mypage.php'" class="button">マイページへ</button>
      </p>
    </div>

<?php
require_once 'html/logout-footer.html';
?>