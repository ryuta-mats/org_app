<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = $_SESSION['current_company'];
$id = $_SESSION['current_company']['id'];
$job_id = $_GET['job_id'];

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} elseif (empty($id)) {
    header('Location: ../companys/company_login.php');
    exit;
} else {
    $job = find_job_by_id($job_id);
}

$name = $job['name'];
$category = $job['category_id'];
$price = $job['price'];
$profile = $job['profile'];
$image = $job['image'];
$image_name = '';
$area = $job['area'];
$start_date = date("Y-m-d", strtotime($job['start_date']));
$start_time = date("H:i", strtotime($job['start_date']));;
$end_date = date("Y-m-d", strtotime($job['end_date']));
$end_time = date("H:i", strtotime($job['end_date']));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $category = filter_input(INPUT_POST, 'category');
    $price = filter_input(INPUT_POST, 'price');
    $profile = $_POST['profile'];
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];
    //新たにimageがアップされているか
    $image_change_flag = false;
    if (!empty($upload_file)) {
        $image_change_flag = true;
        $old_image = '../images/job/' . $job['image'];
        $image = date('YmdHis') . '_' . $upload_file;
        $path = '../images/job/' . $image;
    }
    $area = filter_input(INPUT_POST, 'area');
    $start_date = filter_input(INPUT_POST, 'start_date');
    $start_time = filter_input(INPUT_POST, 'start_time');
    $end_date = filter_input(INPUT_POST, 'end_date');
    $end_time = filter_input(INPUT_POST, 'end_time');
    $val_flag = true;

    list(
        $errors,
        $val_flag
    )
        = company_job_edit_validate(
            $name,
            $category,
            $price,
            $profile,
            $upload_file,
            $area,
            $start_date,
            $start_time,
            $end_date,
            $end_time,
            $val_flag,
        );

    if ($val_flag) {
        //画像に新しいのがあるか
        if ($image_change_flag && move_uploaded_file($upload_tmp_file, $path)) {
            unlink($old_image);
        };
        if (update_job($job_id, $name, $category, $price, $profile, $image, $area, $start_date, $start_time, $end_date, $end_time)) {
            header('Location: company_job_show.php?job_id=' . $job_id);
            exit;
        };
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title company_bg_title">求人内容変更</h1>
        </div>

        <form class="form" method="post" action="" enctype="multipart/form-data">

            <label for="job_name">
                <div class="form_title company_title">仕事(職種)名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['name']) ?: print 'err_input'; ?>" id="job_name" type="text" name="name" value="<?= h($name) ?>">
                    <?php if (!empty($errors['name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="salary_category">
                <div class="form_title company_title">給料</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <div class="input_item_small_wrap">
                        <select id="salary_item" class="input_item user_input_small edit_item <?php empty($errors['category']) ?: print 'err_input'; ?>" name="category" id="salary_category">
                            <option value="" <?php $category == '' && print 'selected' ?>>未回答</option>
                            <option value="1" <?php $category == 1 && print 'selected' ?>>月給</option>
                            <option value="2" <?php $category == 2 && print 'selected' ?>>時給</option>
                            <option value="3" <?php $category == 3 && print 'selected' ?>>年俸</option>
                        </select>
                        <div class="jpy_wrap">
                            <input class="input_item user_input_small edit_item <?php empty($errors['price']) ?: print 'err_input'; ?>" id="salary_price" type="number" name="price" value="<?= h($price) ?>">
                            <p class="jpy">円</p>
                        </div>
                    </div>
                    <?php if (!empty($errors['category'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['category'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($errors['price'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['price'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="job_profile">
                <div class="form_title company_title">仕事内容</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <textarea class="input_item input_item_textarea edit_item <?php empty($errors['profile']) ?: print 'err_input'; ?>" id="job_profile" name="profile" rows="15"><?= h($profile) ?></textarea>
                    <?php if (!empty($errors['profile'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['profile'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            </label>

            <div>
                <div class="form_title company_title">写真</div><span class="required">必須</span>
                <?php if ($image) : ?>
                    <div class="edit_image">
                        <p>現在登録中の画像</p>
                        <img src="../images/job/<?php print h($image); ?>" alt="">
                    </div>
                <?php endif; ?>
                <div class="input_item_wrap edit_image" for="job_image">
                    <p>変更する画像</p>
                    <input class="input_item up_load <?php empty($errors['image']) ?: print 'err_input'; ?>" id="job_image" type="file" accept="image/png,image/jpeg,image/gif" name="image">
                    <?php if (!empty($errors['image'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['image'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <label for="job_area">
                <div class="form_title company_title">勤務地</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['area']) ?: print 'err_input'; ?>" id="job_area" type="text" name="area" value="<?= $area ?>">
                    <?php if (!empty($errors['area'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['area'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="job_term_start">
                <div class="form_title company_title">公開開始日時</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <div class="input_item_small_wrap">
                        <label for="start_date">
                            <input class="input_item user_input_small date_item edit_item <?php empty($errors['start_date']) ?: print 'err_input'; ?>" id="start_date" type="date" name="start_date" value="<?= h($start_date) ?>">
                        </label>
                        <label for="start_time">
                            <input class="input_item user_input_small time_item edit_item <?php empty($errors['start_time']) ?: print 'err_input'; ?>" id="start_time" type="time" name="start_time" value="<?= h($start_time) ?>">
                        </label>
                    </div>
                    <?php if (!empty($errors['start_date'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['start_date'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($errors['start_time'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['start_time'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            </label>

            <label for="job_term_end">
                <div class="form_title company_title">公開終了日時</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <div class="input_item_small_wrap">
                        <label for="end_date">
                            <input class="input_item user_input_small date_item edit_item <?php empty($errors['end_date']) ?: print 'err_input'; ?>" id="end_date" type="date" name="end_date" value="<?= h($end_date) ?>">
                        </label>
                        <label for="end_time">
                            <input class="input_item user_input_small time_item edit_item <?php empty($errors['end_time']) ?: print 'err_input'; ?>" id="end_time" type="time" name="end_time" value="<?= h($end_time) ?>">
                        </label>
                    </div>
                    <?php if (!empty($errors['end_date'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['end_date'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($errors['end_time'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['end_time'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <input id="company_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
