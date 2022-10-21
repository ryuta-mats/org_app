<?php
include_once __DIR__ . '/../common/functions.php';
$company_name='ニセコ株式会社';
$job_category = '営業職';
$job_salary = 250000;
$job_content ='楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト';
$job_ofer_num = 1;

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
            <h2><?= $company_name ?>様の 求人リスト</h1>

            <table class="base_table" >
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
                    <tr>
                        <td class="td_center"><?= $job_category ?></td>
                        <td class="td_center"><?= $job_salary ?>円</td>
                        <td><?= $job_content ?></td>
                        <td class="td_center"><?= $job_ofer_num ?></td>
                        <td class="icon_td">
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-pen-to-square"></i></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-xmark"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-message"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_center"><?= $job_category ?></td>
                        <td class="td_center"><?= $job_salary ?>円</td>
                        <td><?= $job_content ?></td>
                        <td class="td_center"><?= $job_ofer_num ?></td>
                        <td class="icon_td">
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-pen-to-square"></i></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-xmark"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-message"></i></a>
                    </tr>

                </tbody>
            </table>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
