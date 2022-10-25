<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '';
$job = array(
    'company_name' => '株式会社ニセコリゾート観光協会',
    'job_name' => '営業職',
    'salary_category' => '月給',
    'salary_price' => '250000',
    'profile' => 'きつい仕事ですがやりがいはあります。',
    'image' => '../images/c1.jpg',
    'area' => 'ニセコ町',
    'url' => 'https://www.niseko-ta.jp/',
    'start_date' => '2022年9月1日',
    'start_time' => '12:00',
    'end_date' => '2022年10月31日',
    'end_time' => '21:00',
);

$company_name = '';
$job_category = '';
$job_salary = '';
$job_detail = '';
$job_page = '';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="job_detail wrapper">
            <h2 class="title user_bg_title">求人詳細</h2>
            <?php include_once __DIR__ . "/_appry_detail.php" ?>
        </div>
    </div>

    <div class="job_appry wrapper">
        <form class="form" method="post" action="">
            <label for="user_motivation">
                <div class="form_title user_title">志望動機</div><span class="required">必須</span>
                <textarea class="input_item user_motivation" id="user_motivation" type="text" name="user_motivation" cols="30" rows="10"></textarea>
            </label>
            <label for="user_resume">
                <div class="form_title user_title">履歴書</div><span class="required">必須</span>
                <input class="input_item up_load" id="user_resume" type="file" accept="application/pdf" name="user_resume">
            </label>
            <input class="bg_btn user_btn" type="submit" value="応募送信">
        </form>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
