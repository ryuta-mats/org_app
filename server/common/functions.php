<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// エスケープ処理を行う関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function user_login_validate($email, $password)
{
    $errors_email = [];
    $errors_password = [];

    if (empty($email)) {
        $errors_email[] = MSG_EMAIL_REQUIRED;
        $errors_email[] = 'test_err_msg';
    }

    if (empty($password)) {
        $errors_password[] = MSG_PASSWORD_REQUIRED;
    }

    return array($errors_email ,$errors_password) ;
}
