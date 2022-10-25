<?php
include_once __DIR__ . '/../common/functions.php';
$login_company ='株式会社ニセコリゾート観光協会';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2 class="title company_bg_title">ログイン</h2>
        <form class="form" method="post" action="">
            <label for="company_login_email">
                <div class="form_title company_title">メールアドレス</div><span class="required">必須</span>
                <input class="input_item" id="company_login_email" type="email" name="company_login_email">
            </label>
            <label for="company_login_password">
                <div class="form_title company_title">パスワード</div><span class="required">必須</span>
                <input class="input_item" id="company_login_password" type="password" name="company_login_password">
            </label>
            <div id="login_send_wrap">
                <input id="company_login_btn" class="bg_btn company_btn" type="submit" value="ログイン">
                <a href="" class="bg_btn company_btn">新規登録</a>
            </div>
        </form>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
