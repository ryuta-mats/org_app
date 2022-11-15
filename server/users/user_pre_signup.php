<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();
$login_user = '';

if (isset($_SESSION['current_user'])) {
    $login_user = find_user_by_id($_SESSION['current_user']['id']);
}

// ログイン判定
if (isset($_SESSION['current_user'])) {
    header('Location: ../users/index.php');
    exit;
}

$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');

    $errors = user_pre_signup_validate($email);

    //エラーがない場合、pre_userテーブルにインサート
    if (empty($errors)) {
        $urltoken = hash('sha256', uniqid(rand(), 1));
        $url = "http://localhost/users/signup.php?urltoken=" . $urltoken;
        //ここでデータベースに登録する
        if (insert_pre_user($email, $urltoken)) {
            $pre_user_msg = send_mail_pre_user($email, $urltoken);

            header('Location: user_login.php');
            exit;
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
            <h1 class="title user_bg_title"><span>pre sign up</span>ユーザー仮登録</h1>
        </div>

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

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) : ?>
            <!-- 登録完了画面 -->
            <p>仮登録完了</p>
            <p>↓TEST用(後ほど削除)：このURLが記載されたメールが届きます。</p>
            <a href="<?= $url ?>"><?= $url ?></a>
        <?php else : ?>
            <!-- 登録画面 -->
            <form class="form" method="post" action="user_pre_signup.php" enctype="multipart/form-data">

                <label for="user_email">
                    <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                    <div class="input_item_wrap">
                        <input class="input_item <?php empty($errors['email']) ?: print 'err_input'; ?>" id="user_email" type="email" name="email" value="<?= h($email); ?>">
                    </div>
                </label>
                <input id="user_login_btn" class="bg_btn user_btn" type="submit" value="メール送信">

            </form>
        <?php endif; ?>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
