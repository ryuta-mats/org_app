<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();


if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($_GET['appry_id'])) {
    header('Location: ../companys/company_appry_list.php');
    exit;
}
$appry_id = $_GET['appry_id'];
$login_company = find_company_by_id($_SESSION['current_company']['id']);

//関数でステイタスも不採用へ変更する
if (update_appry_cange_status($appry_id, APPRY_STATUS_NOT_ADOPTED)) {
} else {
    //falseの場合、リストにリダイレクトする
    header('Location: user_appry_list.php');
    exit;
}


$appry = find_appry_by_appry_id($appry_id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>
    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Apply Not Adopted</span>不採用</h1>
        </div>

        <h2> <?= h($appry['job_name']) ?> への応募した <?= h($appry['user']) ?> さんを不採用としました。</h2>

        <a class="bg_btn" href="company_appry_list.php">応募者リストへ</a>

    </div>
    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
