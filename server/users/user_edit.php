<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';

if (isset($_SESSION['current_user'])) {
    $login_user = $_SESSION['current_user'];
}

$user_name = '';
$user_email = '';
$user_post_code = '';
$user_address = '';
$user_age = '';
$user_sex = '';
$user_image = '../images\ryuta_matsumoto.PNG';


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>edit</span>ユーザー情報変更</h1>
        </div>
        
        <form class="form" method="post" action="">
            <label for="user_name">
                <div class="form_title user_title">氏名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_name" type="text" name="user_name" value="<?= $user_name ?>">
            </label>

            <label for="user_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_email" type="email" name="user_email" value="<?= $user_email ?>">
            </label>

            <label for="user_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_password" type="password" name="user_password">
            </label>

            <label for="user_post_code">
                <div class="form_title user_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_post_code" type="number" name="user_post_code" value="<?= $user_post_code ?>">
            </label>

            <label for="user_address">
                <div class="form_title user_title">住所</div><span class="required">必須</span>
                <input class="input_item edit_item" id="user_address" type="text" name="user_address" value="<?= $user_address ?>">
            </label>
            <div class="input_item_small_wrap">
                <label for="user_age" class="small_label">
                    <div class="form_title user_title">年齢</div>
                    <input class="input_item edit_item user_input_small" id="user_age" type="number" name="user_age" value="<?= $user_age ?>">
                </label>

                <label for="user_sex" class="small_label">
                    <div class="form_title user_title">性別</div>
                    <select class="input_item edit_item user_input_small" id="user_sex" type="text" name="user_sex" value="<?= $user_sex ?>">
                        <option value="0"></option>
                        <option value="1">男</option>
                        <option value="2">女</option>
                        <option value="9">その他</option>
                    </select>
                </label>

            </div>

            <label for="user_image">
                <div class="form_title user_title">画像</div><span class="required">必須</span>
                <?php if ($user_image) : ?>
                    <div class="edit_image">
                        <p>現在登録中の画像</p>
                        <img src="<?= $user_image ?>" alt="">
                    </div>
                <?php endif; ?>
                <input class="input_item up_load" id="user_image" type="file" accept="image/png,image/jpeg,image/gif" name="user_image">
            </label>

            <input id="user_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
