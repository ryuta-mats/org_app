<?php
include_once __DIR__ . '/../common/functions.php';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <h2 class="title">ログイン</h2>
        <form class="form" method="post" action="">
            <label for="user_login_email">
                <div class="form_title">メールアドレス</div><span class="required">必須</span>
                <input class="input_item" id="user_login_email" type="email" name="user_login_email">
            </label>
            <label for="user_login_password">
                <div class="form_title">パスワード</div><span class="required">必須</span>
                <input class="input_item"  id="user_login_password" type="password" name="user_login_password">
            </label>
            <div id="login_send_wrap">
                <input id="user_login_btn" class="bg_btn user_btn" type="submit" value="ログイン">
                <a href="" class="bg_btn user_btn">新規登録</a>
            </div>

        </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
