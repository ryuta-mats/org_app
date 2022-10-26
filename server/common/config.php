<?php
// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=nisekowork_db;charset=utf8');
define('USER', 'nw_admin');
define('PASSWORD', '1234');

define('MSG_EMAIL_REQUIRED', 'メールアドレスが未入力です');
define('MSG_NAME_REQUIRED', 'ユーザー名が未入力です');
define('MSG_PASSWORD_REQUIRED', 'パスワードが未入力です');
define('MSG_EMAIL_DUPLICATE', 'そのメールアドレスは既に会員登録されています');
define('MSG_EMAIL_PASSWORD_NOT_MATCH', 'メールアドレスかパスワードが間違っています');
