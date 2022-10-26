<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// エスケープ処理を行う関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function user_login_validate($email, $password)
{
    $errors_email = [];
    $errors_password = [];

    if (empty($email)) {
        $errors_email[] = MSG_EMAIL_REQUIRED;
        $errors_email[] = 'test_err_msg';
    }

    if (empty($password)) {
        $errors_password[] = MSG_PASSWORD_REQUIRED;
    }

    return array($errors_email, $errors_password);
}

function user_signup_validate($name, $email, $tel,  $password, $post_code, $address, $age, $sex, $image, $flag)
{
    $errors_name = [];
    $errors_email = [];
    $errors_tel = [];
    $errors_password = [];
    $errors_post_code = [];
    $errors_address = [];
    $errors_age = [];
    $errors_sex = [];
    $errors_image = [];
    $val_flag = $flag;

    if (empty($name)) {
        $errors_name[] = MSG_NAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($email)) {
        $errors_email[] = MSG_EMAIL_REQUIRED;
        $val_flag = false;
    }

    if (empty($tel)) {
        $errors_tel[] = MSG_TEL_REQUIRED;
        $val_flag = false;
    }

    if (empty($password)) {
        $errors_password[] = MSG_PASSWORD_REQUIRED;
        $val_flag = false;
    }

    if (empty($post_code)) {
        $errors_post_code[] = MSG_POSTCODE_REQUIRED;
        $val_flag = false;
    }

    if (empty($address)) {
        $errors_address[] = MSG_ADDRESS_REQUIRED;
        $val_flag = false;
    }

    if (empty($age)) {
    }

    if (empty($sex)) {
    }

    if (empty($image)) {
        $errors_image[] = MSG_NO_IMAGE;
        $val_flag = false;
    } else {
        if (check_file_ext($image)) {
            $errors_image[] = MSG_NOT_ABLE_EXT;
        }
    }
    return array(
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
    );
}

function check_file_ext($upload_file)
{
    $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
    return !in_array($file_ext, EXTENTION) ? true : false;
}

function insert_user($name, $email, $tel, $password, $post_code, $address, $age, $sex, $image)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            users
            (email, password, name, post_code, address, age, sex, tel, image)
        VALUES
            (:email, :password, :name, :post_code, :address, :age, :sex, :tel, :image);
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $pw_hash, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':age', $age, PDO::PARAM_INT);
        $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
        $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
