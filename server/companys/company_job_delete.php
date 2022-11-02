<?php
include_once __DIR__ . '/../common/functions.php';
include_once __DIR__ . '/../common/functions_db.php';
include_once __DIR__ . '/../common/functions_varidate.php';
// セッション開始
session_start();

$login_company = $_SESSION['current_company'];
$id = $login_company['id'];
$job_id = $_GET['job_id'];

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($id)) {
    header('Location: ../companys/company_login.php');
    exit;
} else {
    $job = find_job_by_id($job_id);
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
        <h2><?= h($job['name']) ?>を削除しました。</h2>
    </div>



    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
