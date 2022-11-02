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

function user_signup_validate($name, $email, $tel,  $password, $post_code, $address, $age, $sex, $image, $flag)
{
    $errors = [];
    $val_flag = $flag;

    if (empty($name)) {
        $errors['name'][] = MSG_NAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($email)) {
        $errors['email'][] = MSG_EMAIL_REQUIRED;
        $val_flag = false;
    }

    if (empty($tel)) {
        $errors['tel'][] = MSG_TEL_REQUIRED;
        $val_flag = false;
    }

    if (empty($password)) {
        $errors['password'][] = MSG_PASSWORD_REQUIRED;
        $val_flag = false;
    }

    if (empty($post_code)) {
        $errors['podt_code'][] = MSG_POSTCODE_REQUIRED;
        $val_flag = false;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
        $val_flag = false;
    }

    if (empty($age)) {
    }

    if (empty($sex)) {
    }

    if (empty($image)) {
        $errors['image'][] =  MSG_NO_IMAGE;
        $val_flag = false;
    } else {
        if (check_file_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
        }
    }

    if (
        empty($errors) &&
        check_exist_user($email)
    ) {
        $errors['email'][] = MSG_EMAIL_DUPLICATE;
        $val_flag = false;
    }

    return array($errors, $val_flag);
}

function check_exist_user($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT 
        * 
    FROM 
        users
    WHERE 
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}

function user_edit_validate($name, $email, $tel,  $password, $post_code, $address, $age, $sex, $image, $flag)
{
    $errors = [];
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
        $errors[] = MSG_NAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($email)) {
        $errors_email[] = MSG_EMAIL_REQUIRED;
        $errors[] = MSG_EMAIL_REQUIRED;
        $val_flag = false;
    }

    if (empty($tel)) {
        $errors_tel[] = MSG_TEL_REQUIRED;
        $errors[] = MSG_TEL_REQUIRED;
        $val_flag = false;
    }

    if (empty($password)) {
        $errors_password[] = MSG_PASSWORD_REQUIRED;
        $errors[] = MSG_PASSWORD_REQUIRED;
        $val_flag = false;
    }

    if (empty($post_code)) {
        $errors_post_code[] = MSG_POSTCODE_REQUIRED;
        $errors[] = MSG_POSTCODE_REQUIRED;
        $val_flag = false;
    }

    if (empty($address)) {
        $errors_address[] = MSG_ADDRESS_REQUIRED;
        $errors[] = MSG_ADDRESS_REQUIRED;
        $val_flag = false;
    }

    if (empty($age)) {
    }

    if (empty($sex)) {
    }

    if (empty($image)) {
    } else {
        if (check_file_ext($image)) {
            $errors_image[] = MSG_NOT_ABLE_EXT;
            $errors[] = MSG_NOT_ABLE_EXT;
            $val_flag = false;
        }
    }
    return array(
        $errors,
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

function company_signup_validate($name, $password, $post_code, $address, $manager_name, $email, $profile, $image, $flag)
{
    $errors = [];
    $val_flag = $flag;

    if (empty($name)) {
        $errors['name'][] =  MSG_COMPANYNAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($password)) {
        $errors['password'][] =  MSG_PASSWORD_REQUIRED;
        $val_flag = false;
    }

    if (empty($post_code)) {
        $errors['post_code'][] =  MSG_POSTCODE_REQUIRED;
        $val_flag = false;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
        $val_flag = false;
    }

    if (empty($manager_name)) {
        $errors['manager_name'][] =  MSG_MANAGERNAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($email)) {
        $errors['email'][] =  MSG_EMAIL_REQUIRED;
        $val_flag = false;
    }

    if (empty($profile)) {
        $errors['profile'][] =  MSG_PROFILE_REQUIRED;
        $val_flag = false;
    }

    if (empty($image)) {
        $errors['image'][] =  MSG_NO_IMAGE;
        $val_flag = false;
    } else {
        if (check_file_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
            $val_flag = false;
        }
    }
}

function company_job_create_validate($name, $category, $price, $profile, $image, $area, $start_date, $start_time, $end_date, $end_time, $flag)
{
    $errors = [];
    $val_flag = $flag;

    if (empty($name)) {
        $errors['name'][] =  MSG_JOBNAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($category)) {
        $errors['category'][] =  MSG_CATEGORY_REQUIRED;
        $val_flag = false;
    }

    if (empty($price)) {
        $errors['price'][] =  MSG_PRICE_REQUIRED;
        $val_flag = false;
    } elseif (!is_numeric($price)) {
        $errors['price'][] =  MSG_PRICE_NOT_NUMBER;
        $val_flag = false;
    } elseif ($category == 1 && $price < 920) {
        $errors['price'][] =  MSG_PRICE_MINIMUM_RAGE;
        $val_flag = false;
    }

    if (empty($profile)) {
        $errors['profile'][] =  MSG_PROFILE_REQUIRED;
        $val_flag = false;
    }

    if (empty($image)) {
        $errors['image'][] =  MSG_NO_IMAGE;
        $val_flag = false;
    } else {
        if (check_file_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
            $val_flag = false;
        }
    }

    if (empty($area)) {
        $errors['area'][] =  MSG_AREA_REQUIRED;
        $val_flag = false;
    }

    if (empty($start_date)) {
        $errors['start_date'][] =  MSG_START_DATE_REQUIRED;
        $val_flag = false;
    }

    if (empty($start_time)) {
        $errors['start_time'][] =  MSG_START_TIME_REQUIRED;
        $val_flag = false;
    }

    if (empty($end_date)) {
        $errors['end_date'][] =  MSG_END_DATE_REQUIRED;
        $val_flag = false;
    }

    if (empty($end_time)) {
        $errors['end_time'][] =  MSG_END_TIME_REQUIRED;
        $val_flag = false;
    }

    return array($errors, $val_flag);
}
function company_job_edit_validate($name, $category, $price, $profile, $image, $area, $start_date, $start_time, $end_date, $end_time, $flag)
{
    $errors = [];
    $val_flag = $flag;

    if (empty($name)) {
        $errors['name'][] =  MSG_JOBNAME_REQUIRED;
        $val_flag = false;
    }

    if (empty($category)) {
        $errors['category'][] =  MSG_CATEGORY_REQUIRED;
        $val_flag = false;
    }

    if (empty($price)) {
        $errors['price'][] =  MSG_PRICE_REQUIRED;
        $val_flag = false;
    } elseif (!is_numeric($price)) {
        $errors['price'][] =  MSG_PRICE_NOT_NUMBER;
        $val_flag = false;
    } elseif ($category == 1 && $price < 920) {
        $errors['price'][] =  MSG_PRICE_MINIMUM_RAGE;
        $val_flag = false;
    }

    if (empty($profile)) {
        $errors['profile'][] =  MSG_PROFILE_REQUIRED;
        $val_flag = false;
    }

    if (empty($image)) {
    } else {
        if (check_file_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
            $val_flag = false;
        }
    }

    if (empty($area)) {
        $errors['area'][] =  MSG_AREA_REQUIRED;
        $val_flag = false;
    }

    if (empty($start_date)) {
        $errors['start_date'][] =  MSG_START_DATE_REQUIRED;
        $val_flag = false;
    }

    if (empty($start_time)) {
        $errors['start_time'][] =  MSG_START_TIME_REQUIRED;
        $val_flag = false;
    }

    if (empty($end_date)) {
        $errors['end_date'][] =  MSG_END_DATE_REQUIRED;
        $val_flag = false;
    }

    if (empty($end_time)) {
        $errors['end_time'][] =  MSG_END_TIME_REQUIRED;
        $val_flag = false;
    }

    return array($errors, $val_flag);
}

function company_login_validate($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}

function find_company_by_email($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        companies
    WHERE
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function find_company_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        companies
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function company_login($company)
{
    $_SESSION['current_company']['id'] = $company['id'];
    $_SESSION['current_company']['name'] = $company['name'];
    $_SESSION['current_company']['email'] = $company['email'];
    $_SESSION['current_company']['manager_name'] = $company['manager_name'];
    $_SESSION['current_company']['image'] = $company['image'];

    header('Location: ../companys/company_jobofer_list.php');
    exit;
}

function check_exist_company($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT 
        * 
    FROM 
        companies
    WHERE 
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $company = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($company)) {
        return true;
    } else {
        return false;
    }
}

function insert_company($name, $password, $post_code, $address, $manager_name, $email, $profile, $image, $url)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            companies
            (name, password, post_code, address, manager_name, email, profile, image, url)
        VALUES
            (:name, :password, :post_code, :address, :manager_name, :email, :profile, :image, :url)
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $pw_hash, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':manager_name', $manager_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':url', $url, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
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

function insert_job($name, $company_id, $category, $price, $profile, $image, $area, $start_date, $start_time, $end_date, $end_time)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            ofer
            (name, company_id, category_id, price, profile, area, image, start_date, end_date)
        VALUES
            (:name, :company_id, :category_id, :price, :profile, :area, :image, :start_date, :end_date);
        EOM;

        $new_start_datetime = change_date_time_to_datetime($start_date, $start_time);
        $new_end_datetime = change_date_time_to_datetime($end_date, $end_time);

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category, PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':area', $area, PDO::PARAM_STR);
        $stmt->bindValue(':start_date', $start_date . ' ' . $start_time, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date . ' ' . $end_time, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
function update_job($id, $name, $category, $price, $profile, $image, $area, $start_date, $start_time, $end_date, $end_time)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        UPDATE
            ofer
        SET
            name = :name,
            category_id = :category_id,
            price = :price,
            profile = :profile,
            area = :area,
            start_date = :start_date,
            end_date = :end_date
        EOM;

        if (!empty($image)) {
            $sql .= ', image = :image';
        }

        $sql .= ' WHERE id = :id';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category, PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
        if (!empty($image)) {
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        }
        $stmt->bindValue(':area', $area, PDO::PARAM_STR);
        $stmt->bindValue(':start_date', $start_date . ' ' . $start_time, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date . ' ' . $end_time, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
function update_job_cxl($id)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        UPDATE
            ofer
        SET
            cxl_flag = :cxl_flag
        EOM;

        $sql .= ' WHERE id = :id';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':cxl_flag', 0, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
function update_user($id, $name, $email, $tel, $password, $post_code, $address, $age, $sex, $image = '')
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        UPDATE
            users
        SET
            email = :email,
            password = :password,
            name = :name,
            post_code = :post_code,
            address = :address,
            age = :age,
            sex = :sex,
            tel = :tel
        EOM;

        if (!empty($image)) {
            $sql .= ', image = :image';
        }

        $sql .= ' WHERE id = :id';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $pw_hash, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':age', $age, PDO::PARAM_INT);
        $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
        $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
        if (!empty($image)) {
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        }

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function user_login_validate($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}

function find_user_by_email($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function find_user_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function find_job_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        ofer
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function find_job_by_comapny_id($company_id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        ofer
    WHERE
        company_id = :company_id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function find_category_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        saraly_category
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function user_login($user)
{
    $_SESSION['current_user']['id'] = $user['id'];
    $_SESSION['current_user']['name'] = $user['name'];
    $_SESSION['current_user']['image'] = $user['image'];
    $_SESSION['current_user']['age'] = $user['age'];
    $_SESSION['current_user']['sex'] = $user['sex'];

    header('Location: ../users/index.php');
    exit;
}

function rt_str_sex($sex_num)
{
    $sex_str = '';

    switch ($sex_num) {
        case 0:
            $sex_str = "未回答";
            break;
        case 1:
            $sex_str = "男性";
            break;
        case 2:
            $sex_str = "女性";
            break;
        case 9:
            $sex_str = "その他";
            break;
        default:
            $sex_str = "";
    };

    return $sex_str;
}


function change_datetime_to_date_time($datetime)
{
}

function change_date_time_to_datetime($date, $time)
{
    $datetime = strtotime($date . $time);
    return $datetime;
}
