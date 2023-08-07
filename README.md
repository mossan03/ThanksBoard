# ThanksBoard

## 概要
メンバー間で感謝のメッセージを送りあう投稿アプリです。
実際にメンバーに利用してもらい、運営しております。（8/2リリース）
[ThanksBorad](https://lbsfe.mossan03.com/)

## 開発意図
職業訓練校の修了日まで残りわずかとなりました。
これまで助け合い励ましあいながら一緒に学んできたメンバーへ
たくさんの感謝を気軽に伝えられるツールがあるといいなと思い制作しました。

## 制作期間
20日間

## 使用した言語・ライブラリ
* HTML
* CSS
* JavasScript
* jQuery
* PHP

## 仕様
利用者は職業訓練校の同期メンバーのみのため、また、ポートフォリオの作品として企業様へ提出するため、アプリ内で個人情報は保持しないような仕様にしております。

* サイト管理者にて以下を行う。
    * DBにてユーザの新規登録
    * 投稿削除依頼のメール通知が来た場合、該当メッセージをDBから削除

* ユーザは、以下機能を利用可能。
    * ログイン、ログアウト
    * 宛先（Dear）を選択し、メッセージ投稿
    * メッセージの閲覧（新しい順・古い順・自分宛のみ・投稿済み一覧）
    * ログインパスワードの変更
    * 会員の退会
    * お問い合わせフォームより、サイト管理者へ投稿削除の依頼

## こだわった点
職業訓練校のPHPの講義では、セキュリティ面のことはあまり深く学びませんでした。しかし、フレームワークを使用せずPHPを記述していること、実際にメンバーに利用してもらうことから、自分なりに調べセキュリティ面にこだわりました。
　
## 難しかった点
* CSSでコンポーネントを意識しコーディングすることを初めて行いました。使いまわせる部分に後から後から気づき、修正に時間がかかりました。

* 当初1週間で完成させる予定でしたが、実装したい機能が増えていき、見切りをつけることが大変でした。Ajaxで入力内容を保持させたりなど、まだやりたいことはありましたが、今後少しずつ追加していこうと思います。