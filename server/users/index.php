<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';
$serch_word = '';

if (!empty($_SESSION['current_user'])) {
    $login_user = $_SESSION['current_user'];
    $user_id = $_SESSION['current_user']['id'];
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    !empty($_POST['serch_word'])
) {
    $serch_word = filter_input(INPUT_POST, 'serch_word');
    $jobs = find_job_by_serch_word($serch_word);
} else {

    $jobs = find_all_job();
}

$job_count = count($jobs);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>

    <div id="main" class="wrapper index_main">
        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>job list</span>現在募集中の求人</h1>
        </div>

        <?php if (!empty($serch_word)) : ?>
            <p class="serch_word_echo">検索ワード: <?= h($serch_word) ?></p>
        <?php endif; ?>

        <div id="job" class="wrapper">
            <?php foreach ($jobs as $job) : ?>
                <div class="job-content">
                    <h3 class="company-name"><?= h($job['company']) ?></h3>
                    <img class="index_job_image" src="../images/job/<?php print h($job['image']) ?>" alt="<?= h($job['company']) ?>">
                    <div class="job_info_wrap">
                        <div class="job_name_text"><?= h($job['job_name']) ?></div>
                        <p class="job-text"><?= mb_strimwidth(h($job['profile']), 0, 200, '…', 'UTF-8') ?></p>
                        <div class="saraly_text">
                            <?= $job['category'] ?> <?= h($job['price']) ?>円
                        </div>
                        <div class="job-span">募集期間 <?= date("Y/m/d", strtotime(h($job['start_date']))) ?> から <?= date("Y/m/d", strtotime(h($job['end_date']))) ?> まで</div>
                        <div class="job-area">勤務地 <?= h($job['area']) ?></div>
                    </div>
                    <a href="user_appry_form.php?job_id=<?= $job['job_id'] ?>" class="bg_btn user_btn">詳しく見る<i class="fa-sharp fa-solid fa-circle-chevron-right"></i></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
