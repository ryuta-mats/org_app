<?php
// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=nisekowork_db;charset=utf8');
define('USER', 'nw_admin');
define('PASSWORD', '1234');
define('EXTENTION', ['jpg', 'jpeg', 'png', 'PNG', 'gif', 'webp']);

define('MSG_EMAIL_REQUIRED', 'メールアドレスが未入力です');
define('MSG_PASSWORD_NOT_MATCH', 'パスワードが間違っています');
define('MSG_TEL_REQUIRED', '電話番号が未入力です');
define('MSG_NAME_REQUIRED', 'ユーザー名が未入力です');
define('MSG_PASSWORD_REQUIRED', 'パスワードが未入力です');
define('MSG_POSTCODE_REQUIRED', '郵便番号が未入力です');
define('MSG_ADDRESS_REQUIRED', '住所が未入力です');
define('MSG_AGE_REQUIRED', '年齢が未入力です');
define('MSG_SEX_REQUIRED', '性別が未選択です');
define('MSG_NO_IMAGE', '画像が未選択です');
define('MSG_NOT_ABLE_EXT', '選択したファイルの拡張子が有効ではありません');

define('MSG_EMAIL_DUPLICATE', 'そのメールアドレスは既に会員登録されています');
define('MSG_EMAIL_PASSWORD_NOT_MATCH', 'メールアドレスかパスワードが間違っています');
