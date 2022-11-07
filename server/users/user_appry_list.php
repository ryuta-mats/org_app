<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();


if (empty($_SESSION['current_user'])) {
    header('Location: ../users/user_login.php');
    exit;
}

$login_user = $_SESSION['current_user'];
$user_id = $_SESSION['current_user']['id'];
$apprys = find_appry_by_user_id($user_id);


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <div class="wrapper">
            <pre><?= var_dump($apprys) ?></pre>


            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>apply list</span>応募中の求人一覧</h1>
            </div>
            <table class="base_table">
                <thead>
                    <tr class="headline">
                        <th>会社名</th>
                        <th>職種</th>
                        <th>給料</th>
                        <th>仕事内容</th>
                        <th>状況</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($apprys as $appry) : ?>
                        <?php if ($appry['appry_cxl'] == 1) : ?>
                            <tr>
                                <td class="td_center"><?= h($appry['company']) ?></td>
                                <td class="td_center"><?= h($appry['job_name']) ?></td>
                                <td class="td_center">
                                    <?= h($appry['category_name']) ?>
                                    <?= h($appry['price']) ?>円</td>
                                <td class="long_text"><?= h($appry['profile']) ?></td>
                                <td class="td_center"><?= h($appry['status']) ?></td>
                                <td class="icon_td">
                                    <div class="icons_wrap">
                                        <a href="user_appry_show.php?job_id=<?= h($appry['job_id']) ?>" class="icon icon_appry_detail icon_wrap">
                                            <i class="fa-solid fa-circle-info"></i>
                                            <p>詳細</p>
                                        </a>
                                        <a href="user_appry_cxl.php?appry_id=<?= h($appry['appry_id']) ?>" class="icon icon_appry_detail icon_wrap">
                                            <i class="fa-solid fa-trash"></i>
                                            <p>辞退</p>
                                        </a>
                                        <a href="user_message.php?id=<?= h($appry['appry_id']) ?>" class="icon icon_appry_detail icon_wrap">
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
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
