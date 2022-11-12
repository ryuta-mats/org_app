<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($_GET['appry_id'])) {
    header('Location: ../companys/company_appry_list.php');
    exit;
}
$appry_id = $_GET['appry_id'];

$id = $_SESSION['current_company']['id'];
$login_company = find_company_by_id($_SESSION['current_company']['id']);

$appry = find_appry_by_appry_id($appry_id);
$messages = find_message_by_appry_id($appry_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = filter_input(INPUT_POST, 'body');
    $errors = message_validate($body);

    if (empty($errors)) {
        $msg_from = 1; //送信元(0=USER、1=COMPANY)
        //関数でデータベースにinsert
        if (inssert_message($body, $appry, $msg_from)) {
            //自分をリダイレクト
            header('Location: company_message.php?appry_id=' . $appry['appry_id']);
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>
    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>message</span><?= h($appry['company']) ?>さんと<?= h($appry['user']) ?>さんとのメッセージ</h1>
        </div>
        <div class="msg_wrap">
            <?php if (empty($messages)) : ?>
                <div>メッセージなし</div>
            <?php endif; ?>
            <?php if (!empty($errors)) : ?>
                <div class="login_err_wrap">
                    <ul class="err_msg">
                        <?php foreach ($errors as $error) : ?>
                            <?php foreach ($error as $val) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $val ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php foreach ($messages as $message) : ?>
                <div class="message <?php echo $message['msg_from'] == 0 ? 'opposite_message' : 'my_message'; ?>">
                    <div class="message_body <?php echo $message['msg_from'] == 0 ? 'opposite_message_body' : 'my_message_body'; ?>">
                        <p><?= h($message['body']) ?></p>
                    </div>
                    <p class="message_datetime">
                        <?= $message['created_at'] ?>
                        <?php if ($message['msg_from'] == 0) : ?>
                            <?= $message['user'] ?>
                        <?php else : ?>
                            <?= $message['company'] ?>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            <form class="message my_message" action="company_message.php?appry_id=<?= $appry_id ?>" method="POST">
                <textarea class="<?php empty($errors['body']) ?: print 'err_input'; ?>" name="body" id="send_message_body" cols="50" rows="10" placeholder="メッセージを入力して下さい。"></textarea>
                <?php if (!empty($errors['body'])) : ?>
                    <ul class="err_msg">
                        <?php foreach ($errors['body'] as $error) : ?>
                            <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <input id="position" class="bg_btn company_btn message_send_btn" type="submit">
            </form>
        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
    <script>
        window.addEventListener('DOMContentLoaded', function(e) {
            location.hash = "position";
        });
    </script>
</body>

</html>
