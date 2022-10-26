<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '松本竜太';

$jobs = array(
    0 => array(
        'company_name' => '株式会社ニセコリゾート観光協会',
        'category' => '営業職',
        'salary' => 250000,
        'content' => '楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト',
        'status' => '検討中',
        'ofer' => 1,
    ),
    1 => array(
        'company_name' => 'ニセコ株式会社',
        'category' => '事務職',
        'salary' => 230000,
        'content' => '厳しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト',
        'status' => '検討中',
        'ofer' => 2,
    )
);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <div class="wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>appry list</span><?= $login_user ?>さん 応募中の求人一覧</h1>
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
                    <?php foreach ($jobs as $job) : ?>
                        <tr>
                            <td class="td_center"><?= h($job['company_name']) ?></td>
                            <td class="td_center"><?= h($job['category']) ?></td>
                            <td class="td_center"><?= h($job['salary']) ?>円</td>
                            <td class="long_text"><?= h($job['content']) ?></td>
                            <td class="td_center"><?= h($job['status']) ?></td>
                            <td class="icon_td">
                                <div class="icons_wrap">
                                    <a href="" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-circle-info"></i>
                                        <p>詳細</p>
                                    </a>
                                    <a href="" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-trash"></i>
                                        <p>辞退</p>
                                    </a>
                                    <a href="" class="icon icon_appry_detail icon_wrap">
                                        <i class="fa-solid fa-message"></i>
                                        <p>メッセージ</p>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
