<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';

// セッションにidが保持されていなければログイン画面にリダイレクト
if (empty($_SESSION['current_user'])) {
    header('Location: ../users/user_login.php');
    exit;
}

$user_id = $_SESSION['current_user']['id'];
$login_user = find_user_by_id($user_id);
$apprys = find_appry_by_user_id($user_id);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <div class="wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>apply list</span>応募中の求人一覧</h1>
            </div>
            <div id="job" class="wrapper">
                <?php foreach ($apprys as $appry) : ?>
                    <div class="job-content">
                        <h3 class="company-name"><?= h($appry['company']) ?></h3>
                        <div class="appry_status <?php $appry['status_id'] == 2 ? print 'user_adopted' : print ''; ?>"><?= h($appry['status']) ?></div>
                        <img class="index_job_image" src="../images/job/<?php print h($appry['job_image']) ?>" alt="<?= h($appry['company']) ?>">
                        <div class="job_info_wrap">
                            <div class="job_name_text"><?= h($appry['job_name']) ?></div>
                            <p class="job-text"><?= h($appry['profile']) ?></p>
                            <div class="saraly_text">
                                <?= $appry['category_name'] ?> <?= h($appry['price']) ?>円
                            </div>
                            <div class="job-span">募集期間 <?= date("Y/m/d", strtotime(h($appry['start_date']))) ?> から <?= date("Y/m/d", strtotime(h($appry['end_date']))) ?> まで</div>
                            <div class="job-area">勤務地 <?= h($appry['area']) ?></div>
                        </div>

                        <div class="user_info_wrap">
                            <p class="job-text">志望動機 <?= h($appry['motivation']) ?></p>
                            <a class="bg_btn user_resume" href="../files/resume/<?= h($appry['resume']) ?>">履歴書</a>
                        </div>

                        <div class="icons_wrap">
                            <a href="user_appry_cxl.php?appry_id=<?= h($appry['appry_id']) ?>" class="icon icon_appry_detail icon_wrap" alt="test">
                                <i class="fa-solid fa-trash"></i>
                                <p>辞退</p>
                            </a>
                            <a href="user_message.php?appry_id=<?= h($appry['appry_id']) ?>" class="icon icon_appry_detail icon_wrap">
                                <i class="fa-solid fa-message"></i>
                                <p>メッセージ</p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
