<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();


if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
}
$login_company = $_SESSION['current_company'];
$id = $_SESSION['current_company']['id'];

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
        <pre>
<?= var_dump($apprys) ?>
</pre>

        <table class="base_table">
            <thead>
                <tr class="headline">
                    <th>名前</th>
                    <th>応募先求人</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>志望動機</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($apprys as $appry) : ?>
                    <?php if ($appry['appry_cxl'] == 1) : ?>
                        <tr>
                            <td class="td_center"><?= h($appry['user']) ?></td>
                            <td class="td_center">
                                <a href="company_job_show.php?job_id=<?php print $appry['job_id'] ?>"><?= h($appry['job_name']) ?></a>
                            </td>
                            <td class="td_center"><?= h($appry['user_tel']) ?></td>
                            <td class="td_center"><?= h($appry['user_email']) ?></td>
                            <td><?= h($appry['motivation']) ?></td>

                            <td class="icon_td">
                                <div class="icons_wrap">
                                    <a href="../files/resume/<?= h($appry['resume']) ?>" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-file"></i>
                                        <p>履歴書</p>
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
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
