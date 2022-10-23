<?php
include_once __DIR__ . '/../common/functions.php';
$login_company ='';

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
            <h2 class="title">事業者新規登録</h2>
        <form class="form" method="post" action="">
            <label for="company_signup_name">
                <div class="form_title">会社名</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_name" type="text" name="company_signup_name">
            </label>

            <label for="company_signup_password">
                <div class="form_title">パスワード</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_password" type="password" name="company_signup_password">
            </label>

            <label for="company_signup_post_code">
                <div class="form_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_post_code" type="number" name="company_signup_post_code">
            </label>

            <label for="company_signup_address">
                <div class="form_title">住所</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_address" type="text" name="company_signup_address">
            </label>

            <label for="company_signup_manager_name">
                <div class="form_title">担当者名</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_manager_name" type="text" name="company_signup_manager_name">
            </label>

            <label for="company_signup_email">
                <div class="form_title">担当者メールアドレス</div><span class="required">必須</span>
                <input class="input_item" id="company_signup_email" type="email" name="company_signup_email">
            </label>

            <label for="company_signup_profile">
                <div class="form_title">会社概要</div><span class="required">必須</span>
                <textarea class="input_item input_item_textarea" id="company_signup_profile" name="company_signup_profile" rows="15"></textarea>
            </label>

            <input id="company_login_btn" class="bg_btn company_btn" type="submit" value="新規登録">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
