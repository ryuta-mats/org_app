<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();


// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($_GET['job_id'])) {
    header('Location: ../companys/company_login.php');
    exit;
}
$login_company = find_company_by_id($_SESSION['current_company']['id']);
$id = $_SESSION['current_company']['id'];
$job_id = $_GET['job_id'];
$job = find_job_by_id($job_id);


//echo var_dump($job);
$name = $job['name'];
$category = find_category_by_id($job['category_id']);
$category_name = $category['name'];
$price = $job['price'];
$profile = $job['profile'];
$image = $job['image'];
$image_name = '';
$area = $job['area'];
$start_date = date("Y-m-d", strtotime($job['start_date']));
$start_time = date("H:i", strtotime($job['start_date']));;
$end_date = date("Y-m-d", strtotime($job['end_date']));
$end_time = date("H:i", strtotime($job['end_date']));

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper show_body">

        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>active jobs</span>募集中の求人詳細</h1>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">仕事(職種)名</div>
            <div class="input_item_wrap">
                <div>
                    <?= h($name) ?>
                </div>
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">給料</div>
            <div class="input_item_wrap">
                <div class="input_item_small_wrap">
                    <div>
                        <?= $category_name ?>
                    </div>
                    <div class="jpy_wrap">
                        <div>
                            <?= h($price) ?> 円
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">仕事内容</div>
            <div class="input_item_wrap">
                <div>
                    <?= h($profile) ?>
                </div>
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">写真</div>
            <div class="edit_image company_show_image">
                <img src="../images/job/<?php print h($image); ?>" alt="">
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">勤務地</div>
            <div class="input_item_wrap">
                <div>
                    <?= h($area) ?>
                </div>
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">公開開始日時</div>
            <div class="input_item_wrap">
                <div class="input_item_small_wrap">
                    <?= h($start_date) ?> <?= h($start_time) ?>
                </div>
            </div>
        </div>

        <div class="show_item_wrap">
            <div class="form_title company_title">公開終了日時</div>
            <div class="input_item_wrap">
                <div class="input_item_small_wrap">
                    <?= h($end_date) ?> <?= h($end_time) ?>
                </div>
            </div>
        </div>
        <div class="show_item_wrap">
            <a href="company_job_edit.php?job_id=<?php print $job_id ?>" class="bg_btn edit_btn">変更</a>
        </div>
    </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
