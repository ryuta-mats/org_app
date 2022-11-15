<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_user = '';

// ログイン判定
if (isset($_SESSION['current_user'])) {
    header('Location: ../users/index.php');
    exit;
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
$description = '';
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

    $image = filter_input(INPUT_POST, 'image');
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    list(
        $errors,
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
        } else {
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
        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>sign up</span>ユーザー新規登録</h1>
        </div>
        <?php if (!empty($errors)) : ?>
            <div class="login_err_wrap">
                <ul class="err_msg">
                    <?php foreach ($errors as $error) : ?>
                        <?php foreach ($error as $val) : ?>
                            <li><i class="fa-solid fa-circle-exclamation"></i><?= $val ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form" method="post" action="user_signup.php" enctype="multipart/form-data">
            <label for="user_name">
                <div class="form_title user_title">氏名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['name']) ?: print 'err_input'; ?>" id="user_name" type="text" name="name" value="<?= h($name); ?>">
                    <?php if (!empty($errors['name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_email">
                <div class="form_title user_title">メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['email']) ?: print 'err_input'; ?>" id="user_email" type="email" name="email" value="<?= h($email); ?>">
                    <?php if (!empty($errors['email'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['email'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_tel">
                <div class="form_title user_title">電話番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['tel']) ?: print 'err_input'; ?>" id="user_tel" type="tel" name="tel" value="<?= h($tel); ?>">
                    <?php if (!empty($errors['tel'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['tel'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_password">
                <div class="form_title user_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['password']) ?: print 'err_input'; ?>" id="user_password" type="password" name="password">
                    <?php if (!empty($errors['password'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['password'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_post_code">
                <div class="form_title user_title">郵便番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['post_code']) ?: print 'err_input'; ?>" id="user_post_code" type="number" name="post_code" value="<?= h($post_code); ?>">
                    <?php if (!empty($errors['post_code'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['post_code'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="user_address">
                <div class="form_title user_title">住所</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['address']) ?: print 'err_input'; ?>" id="user_address" type="text" name="address" value="<?= h($address); ?>">
                    <?php if (!empty($errors['address'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['address'] as $error) : ?>
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
                        <input class="input_item user_input_small <?php empty($errors['age']) ?: print 'err_input'; ?>" id="user_age" type="number" name="age" value="<?= h($age); ?>">
                        <?php if (!empty($errors['age'])) : ?>
                            <ul class="err_msg">
                            <?php foreach ($errors['age'] as $error) : ?>
                                    <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </label>
                <label for="user_sex" class="small_label">
                    <div class="form_title user_title">性別</div>
                    <div class="input_item_wrap">
                        <select class="input_item user_input_small <?php empty($errors['sex']) ?: print 'err_input'; ?>" id="user_sex" type="text" name="sex" value="<?= h($sex); ?>">
                            <option value="0">未回答</option>
                            <option value="1">男性</option>
                            <option value="2">女性</option>
                            <option value="9">その他</option>
                        </select>
                        <?php if (!empty($errors['sex'])) : ?>
                            <ul class="err_msg">
                            <?php foreach ($errors['sex'] as $error) : ?>
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
                    <input class="input_item up_load <?php empty($errors['image']) ?: print 'err_input'; ?>" id="user_image" type="file" accept="image/png,image/jpeg,image/gif"  name="image" value="<?= h($image); ?>">
                    <?php if (!empty($errors['image'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['image'] as $error) : ?>
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
