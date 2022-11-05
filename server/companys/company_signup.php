<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = '';

if (isset($_SESSION['login_company'])) {
    $login_company = $_SESSION['login_company'];
}
$name = '';
$password = '';
$post_code = '';
$address = '';
$manager_name = '';
$email = '';
$profile = '';
$image = '';
$upload_file = '';
$upload_tmp_file = '';
$url = '';
$val_flag = true;
$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');
    $post_code = filter_input(INPUT_POST, 'post_code');
    $address = filter_input(INPUT_POST, 'address');
    $manager_name = filter_input(INPUT_POST, 'manager_name');
    $email = filter_input(INPUT_POST, 'email');
    if (isset($_POST['profile'])) {
        $profile = h($_POST['profile']);
    }
    $image = filter_input(INPUT_POST, 'image');
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    list(
        $errors,
        $val_flag
    )
        = company_signup_validate(
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

    if (
        $val_flag
    ) {
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../images/company/' . $image_name;

        if ((move_uploaded_file($upload_tmp_file, $path)) &&
            insert_company($name, $password, $post_code, $address, $manager_name, $email, $profile, $image_name, $url)
        ) {
            header('Location: company_login.php');
            exit;
        } else {
        }
    };
};

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">

        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Company sign up</span>カンパニーユーザー新規登録</h1>
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


        <form class="form" method="post" action="company_signup.php" enctype="multipart/form-data">

            <label for="name">
                <div class="form_title company_title">会社名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['name']) ?: print 'err_input'; ?>" id="name" type="text" name="name" value="<?= h($name); ?>">
                    <?php if (!empty($errors['name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </label>

            <label for="password">
                <div class="form_title company_title">パスワード</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['password']) ?: print 'err_input'; ?>" id="password" type="password" name="password">
                    <?php if (!empty($errors['password'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['password'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="post_code">
                <div class="form_title company_title">郵便番号</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['post_code']) ?: print 'err_input'; ?>" id="post_code" type="number" name="post_code" value="<?= h($post_code); ?>">
                    <?php if (!empty($errors['post_code'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['post_code'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="address">
                <div class="form_title company_title">住所</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['address']) ?: print 'err_input'; ?>" id="address" type="text" name="address" value="<?= h($address); ?>">
                    <?php if (!empty($errors['address'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['address'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="manager_name">
                <div class="form_title company_title">担当者名</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['manager_name']) ?: print 'err_input'; ?>" id="manager_name" type="text" name="manager_name" value="<?= h($manager_name); ?>">
                    <?php if (!empty($errors['manager_name'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['manager_name'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </label>

            <label for="email">
                <div class="form_title company_title">担当者メールアドレス</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <input class="input_item <?php empty($errors['email']) ?: print 'err_input'; ?>" id="email" type="email" name="email" value="<?= h($email); ?>">
                    <?php if (!empty($errors['email'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['email'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </label>

            <label for="profile">
                <div class="form_title company_title">会社概要</div><span class="required">必須</span>
                <div class="input_item_wrap">
                    <textarea class="input_item input_item_textarea <?php empty($errors['profile']) ?: print 'err_input'; ?>" id="profile" name="profile" rows="15"><?= h($profile); ?></textarea>
                    <?php if (!empty($errors['profile'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['profile'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </label>

            <label for="image">
                <div class="form_title company_title">画像</div>
                <div class="input_item_wrap">
                    <input class="input_item up_load <?php empty($errors['image']) ?: print 'err_input'; ?>" id="image" type="file" accept="image/png,image/jpeg,image/gif" name="image">
                    <?php if (!empty($errors['image'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['image'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </label>

            <label for="url">
                <div class="form_title company_title">会社ホームページURL</div>
                <div class="input_item_wrap">
                    <input class="input_item" id="url" type="url" name="url" value="<?= h($url); ?>">
                    <?php if (!empty($errors['url'])) : ?>
                        <ul class="err_msg">
                            <?php foreach ($errors['url'] as $error) : ?>
                                <li><i class="fa-solid fa-circle-exclamation"></i><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            </label>

            <input id="company_login_btn" class="bg_btn company_btn" type="submit" value="新規登録">
    </div>

    </form>

    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
