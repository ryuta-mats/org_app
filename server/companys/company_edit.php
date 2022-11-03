<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
}else {
    $login_company = find_company_by_id($_SESSION['current_company']['id']);
    $id = $login_company['id'];
}

$name = $login_company['name'];
$password = $login_company['password'];
$post_code = $login_company['post_code'];
$address = $login_company['address'];
$manager_name = $login_company['manager_name'];
$email = $login_company['email'];
$profile = $login_company['profile'];
$image = $login_company['image'];
$upload_file = '';
$upload_tmp_file = '';
$url = $login_company['url'];
$val_flag = true;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $manager_name = filter_input(INPUT_POST, 'manager_name');
    $email = filter_input(INPUT_POST, 'email');
    $profile = $_POST['profile'];
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];
    //新しい画像がアップロードされているか確認、されていたら差し替える
    $image_change_flag = false;
    if (!empty($upload_file)) {
        $image_change_flag = true;
        $old_image = '../images/company/' . $login_company['image'];
        $image = date('YmdHis') . '_' . $upload_file;
        $path = '../images/company/' . $image;
    }
        $url = filter_input(INPUT_POST, 'url');

    list(
        $errors,
        $val_flag
    )
        = company_edit_validate(
            $name,
            $password,
            $post_code,
            $address,
            $manager_name,
            $email,
            $profile,
            $upload_file,
            $val_flag
        );
    //パスワードが一致するか確認
    if (!password_verify($password, $login_company['password'])) {
    echo var_dump($errors);
        $errors['password'][] = MSG_PASSWORD_NOT_MATCH;
    } else {

        //エラーがあるか確認
        if ($val_flag) {
            //画像に新しいのがあるか、ある場合アップロード
            if ($image_change_flag && move_uploaded_file($upload_tmp_file, $path)) {
                //古い画像消す
                unlink($old_image);
            };
            //DBの情報を修正する
            if (update_company($id, $name, $post_code, $address, $manager_name, $email, $profile, $upload_file, $url)) {
                //修正に成功したらSHOWにリダイレクトする
                header('Location: company_show.php?id=' . $id);
                exit;
            };
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <pre>
        <?php
        empty($company) ?: var_dump($company);
        ?>
        </pre>
        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Company edit</span>登録情報変更</h1>
        </div>

        <form class="form" method="post" action="" enctype="multipart/form-data">

            <label for="company_name">
                <div class="form_title company_title">会社名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['name']) ?: print 'err_input'; ?>" id="company_name" type="text" name="name" value="<?= h($name) ?>">
                    <?php if (!empty($errors['name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_password">
                <div class="form_title company_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['password']) ?: print 'err_input'; ?>" id="company_password" type="password" name="password">
                    <?php if (!empty($errors['password'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['password'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_post_code">
                <div class="form_title company_title">郵便番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['post_code']) ?: print 'err_input'; ?>" id="company_post_code" type="number" name="post_code" value="<?= h($post_code) ?>">
                    <?php if (!empty($errors['post_code'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['post_code'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_address">
                <div class="form_title company_title">住所</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['address']) ?: print 'err_input'; ?>" id="company_address" type="text" name="address" value="<?= h($address) ?>">
                    <?php if (!empty($errors['address'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['address'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_manager_name">
                <div class="form_title company_title">担当者名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['manager_name']) ?: print 'err_input'; ?>" id="company_manager_name" type="text" name="manager_name" value="<?= h($manager_name) ?>">
                    <?php if (!empty($errors['manager_name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['manager_name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_email">
                <div class="form_title company_title">担当者メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors['email']) ?: print 'err_input'; ?>" id="company_email" type="email" name="email" value="<?= h($email) ?>">
                    <?php if (!empty($errors['email'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['email'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_profile">
                <div class="form_title company_title">会社概要</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <textarea class="input_item input_item_textarea edit_item <?php empty($errors['profile']) ?: print 'err_input'; ?>" id="company_profile" name="profile" rows="15"><?= h($profile) ?></textarea>
                    <?php if (!empty($errors['profile'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['profile'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_image">
                <div class="form_title company_title">画像</div><span class="required">必須</span>
                <?php if ($image) : ?>
                    <div class="edit_image">
                        <img src="../images/company/<?php empty($image) ?: print $image ?>" alt="">
                    </div>
                <?php endif; ?>
                <div class="input_item_wrap">
                    <input class="input_item up_load <?php empty($errors['image']) ?: print 'err_input'; ?>" id="company_image" type="file" accept="image/png,image/jpeg,image/gif" name="image">
                    <?php if (!empty($errors['image'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['image'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="company_url">
                <div class="form_title company_title">会社ホームページURL</div>
                <div class="input_item_wrap">
                    <input class="input_item edit_item" id="company_url" type="url" name="url" value="<?= h($url) ?>">
                </div>
            </label>

            <input id="company_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">

        </form>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
