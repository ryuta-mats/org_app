<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();
$login_user = '';

$id = $_SESSION['current_user']['id'];

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらば一覧画面にリダイレクト
if (empty($_SESSION['current_user'])) {
    header('Location: ../users/user_login.php');
    exit;
} elseif (empty($id)) {
    header('Location: ../users/index.php');
    exit;
} else {
    $login_user = find_user_by_id($_SESSION['current_user']);
}

$name = '';
$email = '';
$tel = '';
$password = '';
$post_code = '';
$address = '';
$age = '';
$sex = '';
$image = '';
$image_name = '';
$upload_file = '';
$upload_tmp_file = '';
$val_flag = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $tel = filter_input(INPUT_POST, 'tel');
    $password = filter_input(INPUT_POST, 'password');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $age = filter_input(INPUT_POST, 'age');
    $sex = filter_input(INPUT_POST, 'sex');


    $upload_file = $_FILES['image']['name'];
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    //新たにimageがアップされているか
    $image_change_flag = false;
    if (!empty($upload_file)) {
        $image_change_flag = true;
        $old_image = '../images/user/' . $login_user['image'];
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../images/user/' . $image_name;
    }

    list(
        $errors_name,
        $errors_email,
        $errors_tel,
        $errors_password,
        $errors_post_code,
        $errors_address,
        $errors_age,
        $errors_sex,
        $errors_image,
        $val_flag
    )
        = user_edit_validate(
            $name,
            $email,
            $tel,
            $password,
            $post_code,
            $address,
            $age,
            $sex,
            $upload_file,
            $val_flag
        );

    if ($val_flag) {
        //画像に新しいのがあるか
        if ($image_change_flag && move_uploaded_file($upload_tmp_file, $path)) {
            unlink($old_image);
        };
        if (update_user($id, $name, $email, $tel, $password, $post_code, $address, $age, $sex, $image_name)) {
            header('Location: index.php');
            exit;
        };
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper">
        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>User edit</span>ユーザー情報変更</h1>
        </div>

        <form class="form" method="post" action="user_edit.php" enctype="multipart/form-data">
            <label for="user_name">
                <div class="form_title user_title">氏名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_name) ?: print 'err_input'; ?>" id="user_name" type="text" name="name" value="<?= h($login_user['name']); ?>">
                    <?php if (!empty($errors_name)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_name as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <label for="user_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_email) ?: print 'err_input'; ?>" id="user_email" type="email" name="email" value="<?= h($login_user['email']); ?>">
                    <?php if (!empty($errors_email)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_email as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <label for="user_tel">
                <div class="form_title user_title">電話番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_tel) ?: print 'err_input'; ?>" id="user_tel" type="tel" name="tel" value="<?= h($login_user['tel']); ?>">
                    <?php if (!empty($errors_tel)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_tel as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_password) ?: print 'err_input'; ?>" id="user_password" type="password" name="password">
                    <?php if (!empty($errors_password)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_password as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <label for="user_post_code">
                <div class="form_title user_title">郵便番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_post_code) ?: print 'err_input'; ?>" id="user_post_code" type="number" name="post_code" value="<?= h($login_user['post_code']); ?>">
                    <?php if (!empty($errors_post_code)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_post_code as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <label for="user_address">
                <div class="form_title user_title">住所</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item edit_item <?php empty($errors_address) ?: print 'err_input'; ?>" id="user_address" type="text" name="address" value="<?= h($login_user['address']); ?>">
                    <?php if (!empty($errors_address)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_address as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <div class="input_item_small_wrap">
                <label for="user_age" class="small_label">
                    <div class="form_title user_title">年齢</div>
                    <div class="input_item_wrap">
                        <input class="input_item edit_item user_input_small <?php empty($errors_age) ?: print 'err_input'; ?>" id="user_age" type="number" name="age" value="<?= h($login_user['age']); ?>">
                        <?php if (!empty($errors_age)) : ?>
                            <ul class="err_msg">
                                <?php foreach ($errors_age as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </label>
                <label for="user_sex" class="small_label">
                    <div class="form_title user_title">性別</div>
                    <div class="input_item_wrap">
                        <select class="input_item edit_item user_input_small <?php empty($errors_sex) ?: print 'err_input'; ?>" id="user_sex" type="text" name="sex" value="<?= h($login_user['sex']); ?>">
                            <option value="0"></option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                            <option value="9">その他</option>
                        </select>
                        <?php if (!empty($errors_sex)) : ?>
                            <ul class="err_msg">
                                <?php foreach ($errors_sex as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </label>
            </div>

            <label for="user_image">
                <div class="form_title user_title">画像</div><span class="required">必須</span>
                <?php if ($login_user['image']) : ?>
                    <div class="edit_image">
                        <p>現在登録中の画像</p>
                        <img src="../images/user/<?= $login_user['image'] ?>" alt="<?= $login_user['name'] ?>さんのプロフィール画像">
                    </div>
                <?php endif; ?>

                <div class="input_item_wrap">
                    <input class="input_item up_load <?php empty($errors_image) ?: print 'err_input'; ?>" id="user_image" type="file" name="image">
                    <?php if (!empty($errors_image)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_image as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>
            <input id="user_edit_btn" class="bg_btn edit_btn" type="submit" value="変更">
    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
