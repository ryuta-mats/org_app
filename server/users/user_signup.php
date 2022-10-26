<?php
include_once __DIR__ . '/../common/functions.php';
$login_user = '';
$name = '';
$email = '';
$tel = '';
$password = '';
$post_code = '';
$address = '';
$age = '';
$sex = '';
$image = '';
$description = '';
$upload_file = '';
$upload_tmp_file = '';

$val_flag = true;

$errors_email = [];
$errors_password = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $tel = filter_input(INPUT_POST, 'tel');
    $password = filter_input(INPUT_POST, 'password');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $age = filter_input(INPUT_POST, 'age');
    $sex = filter_input(INPUT_POST, 'sex');

        $image = filter_input(INPUT_POST, 'image');
        // アップロードした画像のファイル名
        $upload_file = $_FILES['image']['name'];
        // サーバー上で一時的に保存されるテンポラリファイル名
        $upload_tmp_file = $_FILES['image']['tmp_name'];

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
        = user_signup_validate(
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

    if (
        $val_flag
    ) {
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../images/user/' . $image_name;

        if ((move_uploaded_file($upload_tmp_file, $path)) &&
            insert_user($name, $email, $tel, $password, $post_code, $address, $age, $sex, $image_name)
        ) {
            header('Location: user_login.php');
            exit;
        }else{
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
        <h1 class="title user_bg_title">ユーザー新規登録</h1>
        <form class="form" method="post" action="user_signup.php" enctype="multipart/form-data">
            <label for="user_signup_name">
                <div class="form_title user_title">氏名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_name) ?: print 'err_input'; ?>" id="user_signup_name" type="text" name="name" value="<?= h($name); ?>">
                    <?php if (!empty($errors_name)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_name as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_signup_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_email) ?: print 'err_input'; ?>" id="user_signup_email" type="email" name="email" value="<?= h($email); ?>">
                    <?php if (!empty($errors_email)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_email as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_signup_tel">
                <div class="form_title user_title">電話番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_tel) ?: print 'err_input'; ?>" id="user_signup_tel" type="tel" name="tel" value="<?= h($tel); ?>">
                    <?php if (!empty($errors_tel)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_tel as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>


            <label for="user_signup_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_password) ?: print 'err_input'; ?>" id="user_signup_password" type="password" name="password">
                    <?php if (!empty($errors_password)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_password as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_signup_post_code">
                <div class="form_title user_title">郵便番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_post_code) ?: print 'err_input'; ?>" id="user_signup_post_code" type="number" name="post_code" value="<?= h($post_code); ?>">
                    <?php if (!empty($errors_post_code)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_post_code as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_signup_address">
                <div class="form_title user_title">住所</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors_address) ?: print 'err_input'; ?>" id="user_signup_address" type="text" name="address" value="<?= h($address); ?>">
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
                <label for="user_signup_age" class="small_label">
                    <div class="form_title user_title">年齢</div>
                    <div class="input_item_wrap">
                        <input class="input_item user_input_small <?php empty($errors_age) ?: print 'err_input'; ?>" id="user_signup_age" type="number" name="age" value="<?= h($age); ?>">
                        <?php if (!empty($errors_age)) : ?>
                            <ul class="err_msg">
                                <?php foreach ($errors_age as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </label>

                <label for="user_signup_sex" class="small_label">
                    <div class="form_title user_title">性別</div>
                    <div class="input_item_wrap">
                        <select class="input_item user_input_small <?php empty($errors_sex) ?: print 'err_input'; ?>" id="user_signup_sex" type="text" name="sex" value="<?= h($sex); ?>">
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
                <div class="input_item_wrap">
                    <input class="input_item up_load <?php empty($errors_image) ?: print 'err_input'; ?>" id="user_image" type="file" name="image" value="<?= h($image); ?>">
                    <?php if (!empty($errors_image)) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors_image as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <input id="user_login_btn" class="bg_btn user_btn" type="submit" value="新規登録">
    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
