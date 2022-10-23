<?php
include_once __DIR__ . '/../common/functions.php';
$login_company = '株式会社ニセコリゾート観光協会';
$job_name = '';
$salary_category = '';
$salary_jpy = '';
$job_profile = '';
$job_image = '../images/c1.jpg';
$job_area = '';
$start_date = '';
$start_time = '';
$end_date = '';
$end_time = '';

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2 class="title">登録内容変更</h2>
        <form class="form" method="post" action="">
            <label for="job_name">
                <div class="form_title">仕事(職種)名</div><span class="required">必須</span>
                <input class="input_item edit_item" id="job_name" type="text" name="job_name" value="<?= $job_name ?>">
            </label>

            <label for="salary_category">
                <div class="form_title">給料</div><span class="required">必須</span>
                <div class="input_item_wrapper">
                    <select id="salary_item" class="input_item user_input_small edit_item" name="salary_category" id="salary_category" value="<?= $salary_category ?>">
                        <option value="0">時給</option>
                        <option value="1">月給</option>
                    </select>
                    <div class="jpy_wrap">
                        <input class="input_item user_input_small edit_item" id="salary_jpy" type="number" name="salary_jpy" value="<?= $salary_jpy ?>">
                        <p class="jpy">円</p>
                    </div>
                </div>
            </label>

            <label for="job_profile">
                <div class="form_title">仕事内容</div><span class="required">必須</span>
                <textarea class="input_item input_item_textarea edit_item" id="job_profile" name="job_profile" value="<?= $job_profile ?>" rows="15"></textarea>
            </label>

            <label for="job_image">
                <div class="form_title">写真</div><span class="required">必須</span>
                <?php if ($job_image) : ?>
                    <div class="job_edit_image">
                        <p>現在登録中の画像</p>
                        <img src="<?= $job_image ?>" alt="">
                    </div>
                <?php endif; ?>
                <input class="input_item up_load" id="job_image" type="file" accept="image/png,image/jpeg,image/gif" name="job_image">
            </label>

            <label for="job_area">
                <div class="form_title">勤務地</div><span class="required">必須</span>
                <input class="input_item edit_item" id="job_area" type="text" name="job_area" value="<?= $job_area ?>">
            </label>

            <label for="job_term_start">
                <div class="form_title">開始日時</div><span class="required">必須</span>
                <div class="input_item_wrapper">
                    <label for="start_date">
                        <input class="input_item user_input_small date_item edit_item" id="start_date" type="date" name="start_date" value="<?= $start_date ?>">
                    </label>
                    <label for="start_time">
                        <input class="input_item user_input_small time_item edit_item" id="start_time" type="time" name="start_time" value="<?= $start_time ?>">
                    </label>
                </div>
            </label>

            <label for="job_term_end">
                <div class="form_title">終了日時</div><span class="required">必須</span>
                <div class="input_item_wrapper">
                    <label for="end_date">
                        <input class="input_item user_input_small date_item edit_item" id="end_date" type="date" name="end_date" value="<?= $end_date ?>">
                    </label>
                    <label for="end_time">
                        <input class="input_item user_input_small time_item edit_item" id="end_time" type="time" name="end_time" value="<?= $end_time ?>">
                    </label>
                </div>
            </label>
            <input id="company_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
