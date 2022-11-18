<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';

//もしcurrent_userがあれば$login_userに入れる。
if (!empty($_SESSION['current_user'])) {
    $login_user = find_user_by_id($_SESSION['current_user']['id']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>

    <div id="main" class="wrapper">

        <!--user_login成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'user_login') : ?>
            <h1>ユーザーログイン成功</h1>
            <a href="../users/user_appry_list.php" class="bg_btn">応募リスト</a>
            <a href="../users/index.php?#serch_position" class="bg_btn">トップ画面</a>
        <?php endif; ?>

        <!--user_signup成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'user_signup') : ?>
            <h1>ユーザー登録成功</h1>
            <p>さっそく仕事を探しましょう！</p>
            <a href="../users/index.php?#serch_position" class="bg_btn">トップ画面</a>
        <?php endif; ?>

        <!--user_logout成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'logput') : ?>
            <h1>ログアウトしました</h1>
        <?php endif; ?>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
