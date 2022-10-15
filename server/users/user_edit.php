<?php
include_once __DIR__ . '/../common/functions.php';

$user_name = '';
$user_email = '';
$user_post_code = '';
$user_address = '';
$user_age = '';
$user_sex = '';


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header.php" ?>
    <div id="main">
        <h2 class="title">ユーザー情報変更</h2>
        <form class="form" method="post" action="">
            <label for="user_signup_name">
                <div class="form_title">氏名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_signup_name" type="text" name="user_signup_name" value="<?= $user_name ?>">
            </label>

            <label for="user_signup_email">
                <div class="form_title">メールアドレス</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_signup_email" type="email" name="user_signup_email" value="<?= $user_email ?>">
            </label>

            <label for="user_signup_password">
                <div class="form_title">パスワード</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_signup_password" type="password" name="user_signup_password">
            </label>

            <label for="user_signup_post_code">
                <div class="form_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_signup_post_code" type="number" name="user_signup_post_code" value="<?= $user_post_code ?>">
            </label>

            <label for="user_signup_address">
                <div class="form_title">住所</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_signup_address" type="text" name="user_signup_address" value="<?= $user_address ?>">
            </label>
            <div class="input_item_wrapper">
                <label for="user_signup_age user_label_small">
                    <div class="form_title">年齢</div>
                    <input class="input_item input_item_small edit_item" id="user_signup_age" type="number" name="user_signup_age" value="<?= $user_age ?>">
                </label>

                <label for="user_signup_sex user_label_small">
                    <div class="form_title">性別</div>
                    <select class="input_item input_item_small edit_item" id="user_signup_sex" type="text" name="user_signup_sex" value="<?= $user_sex ?>">
                        <option value="-">-未選択-</option>
                        <option value="men">男</option>
                        <option value="woman">女</option>
                        <option value="other">その他</option>
                    </select>
                </label>
            </div>

            <input id="user_edit_btn" class="user_btn" type="submit" value="変更">
    </div>

    </form>
    </div>

    <?php include_once __DIR__ . "/../common/_footer.html" ?>
</body>

</html>