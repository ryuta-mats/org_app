<?php
include_once __DIR__ . '/../common/functions.php';
$login_company = '株式会社ニセコリゾート観光協会';
$company = array(
    'name' => '株式会社ニセコリゾート観光協会',
    'email' => 'aaa@bbb.jp',
    'post_code' => '0000000',
    'address' => '虻田郡ニセコ町字',
    'manager_name' => '松本竜太',
    'profile' => '観光業です。',
    'image' => '../images/niseko-ta.jpg',
    'url' => 'https://www.niseko-ta.jp/',
);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
    <pre>
        <?php
            empty($company) ?: var_dump($company);            
        ?>
    </pre>

        <h1 class="title company_bg_title">事業者変更</h1>
        <form class="form" method="post" action="">
            <label for="company_name">
                <div class="form_title company_title">会社名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_name" type="text" name="company_name" value="<?php empty($company) ?: print h($company['name']); ?>">
            </label>
    
            <label for="company_password">
                <div class="form_title company_title">パスワード</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_password" type="password" name="company_password">
            </label>

            <label for="company_post_code">
                <div class="form_title company_title">郵便番号</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_post_code" type="number" name="company_post_code" value="<?php empty($company) ?: print h($company['post_code']); ?>">
            </label>

            <label for="company_address">
                <div class="form_title company_title">住所</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_address" type="text" name="company_address" value="<?php empty($company) ?: print h($company['address']); ?>">
            </label>

            <label for="company_manager_name">
                <div class="form_title company_title">担当者名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_manager_name" type="text" name="company_manager_name" value="<?php empty($company) ?: print h($company['manager_name']); ?>">
            </label>

            <label for="company_email">
                <div class="form_title company_title">担当者メールアドレス</div><span class="required">必須</span>
                <input class="input_item edit_item" id="company_email" type="email" name="company_email" value="<?php empty($company) ?: print h($company['email']); ?>">
            </label>

            <label for="company_profile">
                <div class="form_title company_title">会社概要</div><span class="required">必須</span>
                <textarea class="input_item input_item_textarea edit_item" id="company_profile" name="company_profile" rows="15"><?php empty($company) ?: print h($company['profile']); ?></textarea>
            </label>

            <label for="company_image">
                <div class="form_title company_title">画像</div><span class="required">必須</span>
                <?php if ($company) : ?>
                    <div class="edit_image">
                        <p>現在登録中の画像</p>
                        <img src="<?php empty($company) ?: print $company['image']; ?>" alt="">
                    </div>
                <?php endif; ?>
                <input class="input_item up_load" id="company_image" type="file" accept="image/png,image/jpeg,image/gif" name="company_image">
            </label>

            <label for="company_url">
                <div class="form_title company_title">会社ホームページURL</div>
                <input class="input_item edit_item" id="company_url" type="url" name="company_url" value="<?php empty($company) ?: print h($company['url']); ?>">
            </label>

            <input id="company_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
