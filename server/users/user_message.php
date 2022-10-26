<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '松本竜太';

$company_name = 'ニセコ株式会社';

$messages = array(
    0 => array(
        'body' => 'この度は弊社求人へのご応募誠にありがとうございます。是非面接させていただきたいのですが、平日はお時間はありますか？オンラインでも可能です。ニセコ株式会社人事部松本',
        'datetime' => '2022.9.21 13:00',
        'class' => 0,
        'name' => $company_name,
    ),
    1 => array(
        'body' => 'こんにちは。連絡してくれてめっちゃ嬉しいです。まじ感謝です。平日は仕事なんで無理っす。土日でお願いできますか？よろしくっす。',
        'datetime' => '2022.9.22 23:00',
        'class' => 1,
        'name' => $login_user,
    ),
    2 => array(
        'body' => 'ご返信ありがとうございます。ご都合がつかないようですので、今回は結構です。ありがとうございました。ニセコ株式会社人事部松本',
        'datetime' => '2022.9.23 9:00',
        'class' => 0,
        'name' => $company_name,
    ),
);
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>message</span><?= $company_name ?>さんとのメッセージ</h1>
            </div>
            <div class="msg_wrap">
                <?php foreach ($messages as $message) : ?>
                    <div class="message <?php echo $message['class'] == 0 ? 'opposite_message' : 'my_message'; ?>">
                        <div class="message_body <?php echo $message['class'] == 0 ? 'opposite_message_body' : 'my_message_body'; ?>">
                            <p><?= h($message['body']) ?></p>
                        </div>
                        <p class="message_datetime"><?= $message['datetime'] ?> <?= $message['name'] ?></p>
                    </div>
                <?php endforeach; ?>
                <form class="message my_message" action="" method="POST">
                    <textarea name="send_message_body" id="send_message_body" cols="50" rows="10" placeholder="メッセージを入力して下さい。"></textarea>
                    <input class="bg_btn user_btn message_send_btn" type="submit">
                </form>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
