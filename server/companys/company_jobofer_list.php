<?php
include_once __DIR__ . '/../common/functions.php';
$company_name = 'ニセコ株式会社';
$jobs = array(
    0 => array(
        'company_name' => 'ニセコ株式会社',
        'category' => '営業職',
        'salary' => 250000,
        'content' => '楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト',
        'ofer' => 1,
    ),
    1 => array(
        'company_name' => 'ニセコ株式会社',
        'category' => '事務職',
        'salary' => 230000,
        'content' => '厳しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト',
        'ofer' => 2,
    )
);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2><?= h($company_name) ?>様の 求人リスト</h2>

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
                    <tr>
                        <td class="td_center"><?= h($job['category']) ?></td>
                        <td class="td_center"><?= h($job['salary']) ?>円</td>
                        <td><?= h($job['content']) ?></td>
                        <td class="td_center"><?= $job['ofer'] ?></td>
                        <td class="icon_td">
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-pen"></i></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-square-xmark"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-message"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
