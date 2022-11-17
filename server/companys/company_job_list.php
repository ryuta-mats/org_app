<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
}
$id = $_SESSION['current_company']['id'];
$login_company = find_company_by_id($_SESSION['current_company']['id']);

//求人の情報を配列にする
$jobs = find_job_by_comapny_id($id);

//応募数を確認し配列に追加する
foreach ($jobs as $index => $job) {
    $appry_count = count_appry_by_job_id($job['job_id']);
    $jobs[$index]['appry_count'] = $appry_count['count(*)'];
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Job list</span>求人リスト</h1>
        </div>

        <div id="job" class="wrapper">
            <?php foreach ($jobs as $job) : ?>
                <div class="job-content">
                    <h3 class="company-name"><?= h($job['company']) ?></h3>
                    <img class="index_job_image" src="../images/job/<?php print h($job['image']) ?>" alt="<?= h($job['company']) ?>">
                    <div class="job_info_wrap">
                        <div class="job_name_text"><?= h($job['job_name']) ?></div>
                        <p class="job-text"><?= h($job['profile']) ?></p>
                        <div class="saraly_text">
                            <?= $job['category'] ?> <?= h($job['price']) ?>円
                        </div>
                        <div class="job-span">募集期間 <?= date("Y/m/d", strtotime(h($job['start_date']))) ?> から <?= date("Y/m/d", strtotime(h($job['end_date']))) ?> まで</div>
                        <div class="job-area">勤務地 <?= h($job['area']) ?></div>
                        <div class="job-area">応募者 <?= $job['appry_count'] ?>人</div>
                    </div>
                    <div class="icons_wrap">
                        <a href="company_job_show.php?job_id=<?= $job['job_id'] ?>" class="icon icon_appry_detail icon_wrap">
                            <i class="fa-solid fa-file-invoice"></i>
                            <p>詳細</p>
                        </a>
                        <a href="company_job_edit.php?job_id=<?= $job['job_id'] ?>" class="icon icon_appry_detail icon_wrap">
                            <i class="fa-solid fa-pen"></i>
                            <p>変更</p>
                        </a>
                        <a href="company_job_delete.php?job_id=<?= $job['job_id'] ?>" class="icon icon_appry_detail icon_wrap">
                            <i class="fa-solid fa-square-xmark"></i>
                            <p>削除</p>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <a href="../companys/company_job_create.php" class="bg_btn company_btn new_ofer_btn">新規求人登録</a>

    </div>
    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
