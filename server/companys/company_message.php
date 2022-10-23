<?php
include_once __DIR__ . '/../common/functions.php';
$user_name = '松本竜太';
$login_company ='株式会社ニセコリゾート観光協会';

$company_name = 'ニセコ株式会社';

$messages = array(
    0 => array(
        'body' => 'この度は弊社求人へのご応募誠にありがとうございます。是非面接させていただきたいのですが、平日はお時間はありますか？オンラインでも可能です。ニセコ株式会社人事部松本',
        'datetime' => '2022.9.21 13:00',
        'class' => 0,
        'name' => $login_company,
    ),
    1 => array(
        'body' => 'こんにちは。連絡してくれてめっちゃ嬉しいです。まじ感謝です。平日は仕事なんで無理っす。土日でお願いできますか？よろしくっす。',
        'datetime' => '2022.9.22 23:00',
        'class' => 1,
        'name' => $user_name,
    ),
    2 => array(
        'body' => 'ご返信ありがとうございます。ご都合がつかないようですので、今回は結構です。ありがとうございました。ニセコ株式会社人事部松本',
        'datetime' => '2022.9.23 9:00',
        'class' => 0,
        'name' => $login_company,
    ),
);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2><?= $user_name ?>さんとのメッセージ</h2>
        <hr>
        <div class="msg_wrap">
            <?php foreach ($messages as $message) : ?>
                <div class="message <?php echo $message['class'] == 1 ? 'opposite_message' : 'my_message'; ?>">
                    <div class="message_body <?php echo $message['class'] == 1 ? 'opposite_message_body' : 'my_message_body'; ?>">
                        <p><?= h($message['body']) ?></p>
                    </div>
                    <p class="message_datetime"><?= $message['datetime'] ?> <?= $message['name'] ?></p>
                </div>
            <?php endforeach; ?>
            <form class="message my_message" action="" method="POST">
                <textarea name="send_message_body" id="send_message_body" cols="50" rows="10" placeholder="メッセージを入力して下さい。"></textarea>
                <input class="bg_btn company_btn message_send_btn" type="submit">
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
