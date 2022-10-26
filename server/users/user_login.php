<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '松本竜太';
$email = '';
$password = '';
$errors_email = [];
$errors_password = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    list($errors_email, $errors_password) = user_login_validate($email, $password);
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <pre>
<?php
var_dump($email);
var_dump($password);
var_dump($errors_email);
var_dump($errors_password);
?>
</pre>

        <h2 class="title user_bg_title">ログイン</h2>
        <form class="form" method="post" action="">
            <label for="user_login_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_email) ?: print 'err_input'; ?>" id="user_login_email" type="email" name="email" value="<?= h($email); ?>">
                    <?php if (!empty($errors_email)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_email as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <label for="user_login_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_password) ?: print 'err_input'; ?>" id="user_login_password" type="password" name="password">
                    <?php if (!empty($errors_password)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_password as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <div id="login_send_wrap">
                <input id="user_login_btn" class="bg_btn user_btn" type="submit" value="ログイン">
                <a href="../users/user_signup.php" class="bg_btn user_btn">新規登録</a>
            </div>

        </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
