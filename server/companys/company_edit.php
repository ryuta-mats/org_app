<?php
include_once __DIR__ . '/../common/functions.php';

$company_name = '';
$company_email = '';
$company_post_code = '';
$company_address = '';
$company_manager_name = '';
$company_profile = '';

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
            <h1 class="title">事業者変更</h1>
        <form class="form" method="post" action="">
            <label for="company_name">
                <div class="form_title">会社名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_name" type="text" name="company_name" value="<?= $company_name ?>">
            </label>

            <label for="company_password">
                <div class="form_title">パスワード</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_password" type="password" name="company_password">
            </label>

            <label for="company_post_code">
                <div class="form_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_post_code" type="number" name="company_post_code" value="<?= $company_post_code ?>">
            </label>

            <label for="company_address">
                <div class="form_title">住所</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_address" type="text" name="company_address" value="<?= $company_address ?>">
            </label>

            <label for="company_manager_name">
                <div class="form_title">担当者名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_manager_name" type="text" name="company_manager_name" value="<?= $company_manager_name ?>">
            </label>

            <label for="company_email">
                <div class="form_title">担当者メールアドレス</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_email" type="email" name="company_email" value="<?= $company_email ?>">
            </label>

            <label for="company_profile">
                <div class="form_title">会社概要</div><span class="required">必須</span>
                <textarea class="input_item input_item_textarea edit_item" id="company_profile" name="company_profile" rows="15" value="<?= $company_profile ?>"></textarea>
            </label>

            <input id="company_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
