<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

//ログイン確認
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
}
$id = $_SESSION['current_company']['id'];
$login_company = find_company_by_id($_SESSION['current_company']['id']);

$apprys = find_appry_by_company_id($id);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Apply list</span>応募者リスト</h1>
        </div>

        <div class="wrapper company_appry_list">
            <?php foreach ($apprys as $appry) : ?>
                <?php if ($appry['appry_cxl'] == 1) : ?>
                    <div class="job-content">
                        <h3 class="company-name"><?= h($appry['job_name']) ?></h3>
                        <div class="job_info_wrap">
                            <div class="saraly_text">
                                <?= $appry['category_name'] ?> <?= h($appry['price']) ?>円
                            </div>
                            <div class="job-span">募集期間 <?= date("Y/m/d", strtotime(h($appry['start_date']))) ?> から <?= date("Y/m/d", strtotime(h($appry['end_date']))) ?> まで</div>
                            <div class="job-area">勤務地 <?= h($appry['area']) ?></div>
                        </div>

                        <div class="user_info_wrap">
                            <div class="appry_status<?php $appry['status_id'] == 2 ? print ' user_adopted' : print ''; ?>"><?= h($appry['status']) ?></div>
                            <div class="user_info_name"><?= h($appry['user']) ?></div>
                            <img class="user_image" src="../images/user/<?php print h($appry['user_image']) ?>" alt="<?= h($appry['user']) ?>">
                            <div class="job-area">電話番号 <?= h($appry['user_tel']) ?></div>
                            <div class="job-area">メール <?= h($appry['user_email']) ?></div>
                            <div class="job-area">年齢 <?php $appry['user_age']==0 ? print '未回答' : h($appry['user_age']) ; ?></div>
                            <div class="job-area">性別 <?= rt_str_sex($appry['user_sex']) ?></div>

                            <p class="job-text">志望動機 <?= h($appry['motivation']) ?></p>
                            <a class="bg_btn user_resume" href="../files/resume/<?= h($appry['resume']) ?>" target="_blank">履歴書</a>
                        </div>

                        <div class="icons_wrap">
                            <a href="company_appry_ado.php?appry_id=<?= $appry['appry_id'] ?>" class="icon icon_appry_detail icon_wrap">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <p>採用</p>
                            </a>
                            <a href="company_appry_cxl.php?appry_id=<?= $appry['appry_id'] ?>" class="icon icon_appry_detail icon_wrap">
                                <i class="fa-solid fa-trash"></i>
                                <p>不採用</p>
                            </a>

                            <a href="company_message.php?appry_id=<?php print $appry['appry_id'] ?>" class="icon icon_appry_detail icon_wrap">
                                <i class="fa-solid fa-message"></i>
                                <p>メッセージ</p>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
