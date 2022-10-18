<?php
include_once __DIR__ . '/../common/functions.php';
$company_name = 'ニセコ株式会社';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <div class="wrapper">
            <h2><?= $company_name ?>さんとのメッセージ</h2>
            <hr>
            <div class="msg_wrap">
                <div class="message opposite_message">
                    <div class="message_body opposite_message_body">
                        <p>この度は弊社求人へのご応募誠にありがとうございます。<br>
                            是非面接させていただきたいのですが、平日はお時間はありますか？オンラインでも可能です。<br>
                            ニセコ株式会社人事部松本
                        </p>
                    </div>
                    <p class="message_datetime">2022.9.21 13:00 <?= $company_name ?></p>
                </div>
                
                <div class="message my_message">
                    <div class="message_body my_message_body">
                        <p>こんにちは。連絡してくれてめっちゃ嬉しいです。まじ感謝です。平日は仕事なんで無理っす。土日でお願いできますか？よろしくっす。
                        </p>
                    </div>
                    <p class="message_datetime">2022.9.22 15:00</p>
                </div>
                
                <div class="message opposite_message">
                    <div class="message_body opposite_message_body">
                        <p>ご返信ありがとうございます。ご都合がつかないようですので、今回は結構です。
                            ありがとうございました。
                            ニセコ株式会社人事部松本
                        </p>
                    </div>
                    <p class="message_datetime">022.9.22 16:00 <?= $company_name ?></p>
                </div>
            </div>

            <form class="message my_message" action="" method="POST">
                <textarea name="send_message_body" id="send_message_body" cols="50" rows="10" placeholder="メッセージを入力して下さい。"></textarea>
                <input class="user_btn user_message_btn" type="submit">
            </form>

        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
