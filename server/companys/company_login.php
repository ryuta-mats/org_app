<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = '';

if (isset($_SESSION['current_company'])) {
    $login_company = $_SESSION['current_company'];
}
// ログイン判定
if (isset($_SESSION['current_company'])) {
    header('Location: ../companys/company_job_list.php');
    exit;
}

$email = '';
$password = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $errors = company_login_validate($email, $password);

    if (empty($errors)) {
        $company = find_company_by_email($email);
        if (!empty($company) && password_verify($password, $company['password'])) {
            company_login($company);
        } else {
            $errors[] = MSG_EMAIL_PASSWORD_NOT_MATCH;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title">ログイン</h1>
        </div>
        <?php if (!empty($errors)) : ?>
            <div class="login_err_wrap">
                <ul class="err_msg">
                    <?php foreach ($errors as $error) : ?>
                        <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form" method="post" action="">
            <label for="company_login_email">
                <div class="form_title company_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item" id="company_login_email" type="email" name="email" value="<?= h($email); ?>">
                </div>
            </label>
            <label for="company_login_password">
                <div class="form_title company_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item" id="company_login_password" type="password" name="password">
                </div>
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
