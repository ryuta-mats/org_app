<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = $_SESSION['current_company'];
$id = $_SESSION['current_company']['id'];

if (empty($login_company)) {
    header('Location: ../companys/company_login.php');
    exit;
}
$jobs = find_job_by_comapny_id($id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2><?= h($login_company['name']) ?>様の 求人リスト</h2>

        <table class="base_table">
            <thead>
                <tr class="headline">
                    <th>職種</th>
                    <th>給料</th>
                    <th>仕事内容</th>
                    <th>応募者数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job) : ?>
                    <?php if ($job['cxl_flag']) : ?>
                        <tr>
                            <td class="td_center"><?= h($job['name']) ?></td>
                            <?php $category = find_category_by_id($id); ?>
                            <td class="td_center"><?= $category['name'] ?> <?= h($job['price']) ?>円</td>
                            <td><?= h($job['profile']) ?></td>
                            <td class="td_center">0人</td>
                            <td class="icon_td">
                                <div class="icons_wrap">
                                    <a href="company_job_show.php?job_id=<?= $job['id'] ?>" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-file-invoice"></i>
                                        <p>ditail</p>
                                    </a>
                                    <a href="company_job_edit.php?job_id=<?= $job['id'] ?>" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-pen"></i>
                                        <p>edit</p>
                                    </a>
                                    <a href="company_job_delete.php?job_id=<?= $job['id'] ?>" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-square-xmark"></i>
                                        <p>delete</p>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../companys/company_job_create.php" class="bg_btn company_btn new_ofer_btn">新規求人登録</a>

    </div>
    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
