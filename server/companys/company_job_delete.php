<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($_GET['job_id'])) {
    header('Location: ../companys/company_job_list.php');
    exit;
} else {
    $job_id = $_GET['job_id'];
    $job = find_job_by_id($job_id);

    $id = $_SESSION['current_company']['id'];
    $login_company = find_company_by_id($_SESSION['current_company']['id']);
}

//関数でキャンセルフラグを0に変更する
if (update_job_cxl($job_id)) {
} else {
    //falseの場合、リストにリダイレクトする
    header('Location: ../companys/company_job_list.php?job_id=' . $job_id);
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>job delete</span>求人削除</h1>
        </div>

        <h2><?= h($job['name']) ?>を削除しました。</h2>
    </div>



    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
