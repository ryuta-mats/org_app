<?php
// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=nisekowork_db;charset=utf8');
define('USER', 'nw_admin');
define('PASSWORD', '1234');

//エックスサーバー用
//define('DSN', 'mysql:host=localhost;dbname=xs618728_nisekowork;charset=utf8');
//define('USER', 'xs618728_nw');
//define('PASSWORD', 'matsu1987');

//test2

define('MAIL_PASSWORD', 'NMki5Ujax#6FUgP');
define('MAIL_ADDRESS', 'info@xs618728.xsrv.jp');
define('PRE_SIGN_UP_MAIL_SUBJECT', '仮登録のご連絡');
define('SIGN_UP_URL', 'http://localhost/users/user_signup.php?urltoken=');
//define('SIGN_UP_URL', 'https://xs618728.xsrv.jp/server/users/user_signup.php?urltoken=');
define('NOT_PRE_SIGNIN', 'このURLはご利用できません。有効期限が過ぎたかURLが間違えている可能性がございます。もう一度仮登録からやりなおして下さい。');


define('EXTENSION_IMAGE', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('EXTENSION_PDF', ['pdf']);

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

define('MSG_MOTIVATION_REQUIRED', '志望動機が未入力です');
define('MSG_MOTIVATION_SHORT', '志望動機が短すぎます。やる気が感じられません。');
define('MSG_NO_RESUME', '履歴書が未選択です。');

define('MSG_BODY_REQUIRED', 'メッセージが未入力です');

define('MSG_COMPANYNAME_REQUIRED', '会社名が未入力です');
define('MSG_PROFILE_REQUIRED', '会社概要が未入力です');
define('MSG_MANAGERNAME_REQUIRED', '担当者名が未入力です');

define('MSG_JOBNAME_REQUIRED', '仕事名が未入力です');
define('MSG_CATEGORY_REQUIRED', '給料カデコリが未選択です');
define('MSG_PRICE_REQUIRED', '給料金額が未入力です');
define('MSG_PRICE_NOT_NUMBER', '給料金額が数字ではありません');
define('MSG_PRICE_MINIMUM_RAGE', '最低賃金を下回っています');
define('MSG_AREA_REQUIRED', '勤務地が未入力です');
define('MSG_START_DATE_REQUIRED', '公開開始日が未入力です');
define('MSG_START_TIME_REQUIRED', '公開開始時間が未入力です');
define('MSG_END_DATE_REQUIRED', '公開終了日が未入力です');
define('MSG_END_TIME_REQUIRED', '公開終了時間が未入力です');
define('MSG_IMAGEUPLOAD_ERR', '画像アップロードのエラーです');
define('MSG_DB_ERR', 'DBへの登録時のエラーです');


define('MSG_EMAIL_DUPLICATE', 'そのメールアドレスは既に会員登録されています');
define('MSG_EMAIL_PASSWORD_NOT_MATCH', 'メールアドレスかパスワードが間違っています');

define('APPRY_STATUS_UNDER SELECTION', 1);//選考中
define('APPRY_STATUS_ADOPTED', 2);//採用
define('APPRY_STATUS_NOT_ADOPTED', 3);//不採用
define('APPRY_STATUS_DECLINE', 4);//辞退

