<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();
$login_user = '';

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらば一覧画面にリダイレクト
if (empty($_SESSION['current_user'])) {
    header('Location: ../users/user_login.php');
    exit;
} elseif (empty($_GET['job_id'])) {
    header('Location: ../users/index.php');
    exit;
}
$login_user = find_user_by_id($_SESSION['current_user']['id']);
$job = find_job_by_id($_GET['job_id']);
$company = find_company_by_id($job['company_id']);
$category = find_category_by_id($job['category_id']);
$appry_flag = user_appry_flag($login_user['id'], $_GET['job_id']);
$motivation = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $motivation = filter_input(INPUT_POST, 'motivation');
    $upload_file = $_FILES['resume']['name'];
    $upload_tmp_file = $_FILES['resume']['tmp_name'];
    $errors = user_appry_validate($motivation, $upload_file);

    //バリデーションエラーがないか確認
    if (empty($errors)) {
        //なければアップロードファイルのパス
        $resume_name = date('YmdHis') . '_' . $upload_file;
        $path = '../files/resume/' . $resume_name;

        //ファイルアップロード、DBへインサート
        if ((move_uploaded_file($upload_tmp_file, $path)) &&
            insert_use_appry($job['id'], $login_user['id'], $company['id'], $motivation, $resume_name)
        ) {
            header('Location: user_appry_list.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="job_detail wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>job offer</span>求人詳細</h1>
            </div>
            <?php if ($appry_flag) : ?>
                <div class="err_msg appry_msg">応募済みの求人です。</div>
            <?php endif; ?>

            <?php include_once __DIR__ . "/_appry_detail.php" ?>

        </div>
    </div>

    <?php if (!$appry_flag) : ?>
        <div class="job_appry wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>apply</span>この求人への応募</h1>
            </div>
            <?php if (!empty($errors)) : ?>
                <ul class="err_msg top_err_msg">
                    <?php foreach ($errors as $error) : ?>
                        <?php foreach ($error as $val) : ?>
                            <li><i class="fa-solid fa-circle-exclamation"></i><?= $val ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form class="form" method="post" action="" enctype="multipart/form-data">

                <label for="user_motivation">
                    <div class="form_title user_title">志望動機</div><span class="required">必須</span>
                    <div class="input_item_wrap">
                        <textarea class="input_item user_motivation" id="user_motivation" type="text" name="motivation"><?= h($motivation) ?></textarea>
                        <?php if (!empty($errors['motivation'])) : ?>
                            <ul class="err_msg">
                                <?php foreach ($errors['motivation'] as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </label>
                <label for="user_resume">
                    <div class="form_title user_title">履歴書</div><span class="required">必須</span>
                    <div class="input_item_wrap">
                        <ul class="err_msg">
                            <li><i class="fa-solid fa-circle-exclamation"></i>PDFファイルのみ添付可能です</li>
                        </ul>
                        <input class="input_item up_load" id="user_resume" type="file" accept="application/pdf" name="resume">
                        <?php if (!empty($errors['resume'])) : ?>
                            <ul class="err_msg">
                                <?php foreach ($errors['resume'] as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </label>
                <input class="bg_btn user_btn" type="submit" value="応募送信">
            </form>
        <?php endif; ?>
        </div>

        <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
