<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = '';

//もしlogin_companyがあれば$login_userに入れる。
if (isset($_SESSION['current_company'])) {
    $login_company = find_company_by_id($_SESSION['current_company']['id']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">

        <!--company_login成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'company_login') : ?>
            <h1>カンパニーログイン成功</h1>
            <p><?= h($_SESSION['current_company']['manager_name']) ?>さんこんにちは。</p>
        <?php endif; ?>

        <!--company_signup成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'company_signup') : ?>
            <h1>カンパニー登録成功</h1>
            <p>さっそくログインして求人を登録しましょう！</p>
            <a href="../companys/company_login.php" class="bg_btn">ログイン</a>
        <?php endif; ?>

        <!--user_logout成功からのリダイレクト-->
        <?php if ($_GET['page'] == 'logput') : ?>
            <h1>ログアウトしました</h1>
        <?php endif; ?>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>


</html>
