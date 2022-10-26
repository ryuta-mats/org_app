<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <h1 class="title user_bg_title">ユーザー新規登録</h1>
        <form class="form" method="post" action="">
            <label for="user_signup_name">
                <div class="form_title user_title">氏名</div><span class="required">必須</span>
                <input class="input_item" id="user_signup_name" type="text" name="user_signup_name">
            </label>

            <label for="user_signup_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <input class="input_item" id="user_signup_email" type="email" name="user_signup_email">
            </label>

            <label for="user_signup_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <input class="input_item" id="user_signup_password" type="password" name="user_signup_password">
            </label>

            <label for="user_signup_post_code">
                <div class="form_title user_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item" id="user_signup_post_code" type="number" name="user_signup_post_code">
            </label>

            <label for="user_signup_address">
                <div class="form_title user_title">住所</div><span class="required">必須</span>
                <input class="input_item" id="user_signup_address" type="text" name="user_signup_address">
            </label>
            <div class="input_item_small_wrap">
                <label for="user_signup_age" class="small_label">
                    <div class="form_title user_title">年齢</div>
                    <input class="input_item user_input_small" id="user_signup_age" type="number" name="user_signup_age">
                </label>

                <label for="user_signup_sex" class="small_label">
                    <div class="form_title user_title">性別</div>
                    <select class="input_item input_item_small user_input_small" id="user_signup_sex" type="text" name="user_signup_sex">
                        <option value="0"></option>
                        <option value="1">男</option>
                        <option value="2">女</option>
                        <option value="9">その他</option>
                    </select>
                </label>
            </div>
            <label for="user_image">
                <div class="form_title user_title">画像</div><span class="required">必須</span>
                <input class="input_item up_load" id="user_image" type="file" accept="image/png,image/jpeg,image/gif" name="user_image">
            </label>


            <input id="user_login_btn" class="bg_btn user_btn" type="submit" value="新規登録">
    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
