<?php

// DB接続
try {
    $pdo = new PDO('mysql:host=********;dbname=********;charset=utf8',
                    '********',
                    '********');
} catch (PDOException $e) {
    echo 'データベース接続失敗'. $e->getMssage();
}