<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';

// ログイン判定
if (isset($_SESSION['current_user'])) {
    header('Location: ../users/index.php');
    exit;
}

$email = '';
$password = '';
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $errors = user_login_validate($email, $password);

    if (empty($errors)) {
        $user = find_user_by_email($email);
        if (!empty($user) && password_verify($password, $user['password'])) {
            user_login($user);
            header('Location: ../users/user_true_message.php?page=user_login');
            exit;
        } else {
            $errors[] = MSG_EMAIL_PASSWORD_NOT_MATCH;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>user login</span>ユーザーログイン</h1>
        </div>
        <?php if (!empty($errors)) : ?>
            <div class="login_err_wrap">
                <ul class="err_msg">
                    <?php foreach ($errors as $error) : ?>
                        <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form" method="post" action="">
            <label for="user_login_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item" id="user_login_email" type="email" name="email" value="<?= h($email); ?>">
                </div>
            </label>
            <label for="user_login_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item" id="user_login_password" type="password" name="password">
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
