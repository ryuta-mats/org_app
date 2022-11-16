<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

//
//---------------------------------------
//user

//ユーザー仮登録のバリデーションを行う関数
function user_pre_signup_validate($email)
{
    $errors = [];
    if (empty($email)) {
        $errors['email'][] = MSG_EMAIL_REQUIRED;
    }elseif (check_exist_user($email)) {
        $errors['email'][] =  MSG_EMAIL_DUPLICATE;
    }


    return $errors;
}

//ユーザーサインアップのバリデーションを行う関数
function user_signup_validate($name, $tel,  $password, $post_code, $address, $age, $sex, $image)
{
    $errors = [];

    if (empty($name)) {
        $errors['name'][] = MSG_NAME_REQUIRED;
    }

    if (empty($tel)) {
        $errors['tel'][] = MSG_TEL_REQUIRED;
    }

    if (empty($password)) {
        $errors['password'][] = MSG_PASSWORD_REQUIRED;
    }

    if (empty($post_code)) {
        $errors['podt_code'][] = MSG_POSTCODE_REQUIRED;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
    }

    if (empty($age)) {
    }

    if (empty($sex)) {
    }

    if (empty($image)) {
        $errors['image'][] =  MSG_NO_IMAGE;
    } else {
        if (check_file_image_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
        }
    }

    return $errors;
}

//ユーザーのログイン時のバリデーションを行う関数
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

//ユーザー情報変更時のバリデーションを行う関数
function user_edit_validate($id, $name, $email, $tel,  $password, $post_code, $address, $age, $sex, $image)
{
    $user = find_user_by_id($id);
    $errors = [];

    if (empty($name)) {
        $errors['name'][] = MSG_NAME_REQUIRED;
    }

    if (empty($email)) {
        $errors['email'][] = MSG_EMAIL_REQUIRED;
    } elseif (check_exist_user($email)) {
        if ($user['email'] != $email) {
            $errors['email'][] = MSG_EMAIL_REQUIRED;
        }
    }

    if (empty($tel)) {
        $errors['tel'][] = MSG_TEL_REQUIRED;
    }

    if (empty($password)) {
        $errors['password'][] = MSG_PASSWORD_REQUIRED;
    }

    if (empty($post_code)) {
        $errors['post_code'][] = MSG_POSTCODE_REQUIRED;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
    }

    if (empty($age)) {
    }

    if (empty($sex)) {
    }

    if (!empty($image)) {
        if (check_file_image_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
        }
    }
    return $errors;
}

//ユーザー求人申し込みのバリデーションを行う関数
function user_appry_validate($motivation, $upload_file)
{

    $errors = [];

    if (empty($motivation)) {
        $errors['motivation'][] = MSG_MOTIVATION_REQUIRED;
    } elseif (mb_strlen($motivation) < 10) {
        $errors['motivation'][] = MSG_MOTIVATION_SHORT;
    }

    if (empty($upload_file)) {
        $errors['resume'][] =  MSG_NO_RESUME;
    } else {
        if (check_file_pdf_ext($upload_file)) {
            $errors['resume'][] = MSG_NOT_ABLE_EXT;
        }
    }

    return $errors;
}

//メッセージのバリデーションを行う関数
function message_validate($body)
{

    $errors = [];

    if (empty($body)) {
        $errors['body'][] = MSG_BODY_REQUIRED;
    }

    return $errors;
}

//
//---------------------------------------
//company
function company_signup_validate($name, $password, $post_code, $address, $manager_name, $email, $profile, $image, $flag)
{
    $errors = [];

    if (empty($name)) {
        $errors['name'][] =  MSG_COMPANYNAME_REQUIRED;
    }

    if (empty($password)) {
        $errors['password'][] =  MSG_PASSWORD_REQUIRED;
    }

    if (empty($post_code)) {
        $errors['post_code'][] =  MSG_POSTCODE_REQUIRED;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
    }

    if (empty($manager_name)) {
        $errors['manager_name'][] =  MSG_MANAGERNAME_REQUIRED;
    }

    if (empty($email)) {
        $errors['email'][] =  MSG_EMAIL_REQUIRED;
    }
    if (check_exist_company($email)) {
        $errors['email'][] =  MSG_EMAIL_DUPLICATE;
    }

    if (empty($profile)) {
        $errors['profile'][] =  MSG_PROFILE_REQUIRED;
    }

    if (empty($image)) {
        $errors['image'][] =  MSG_NO_IMAGE;
    } else {
        if (check_file_image_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
        }
    }

    return $errors;
}
function company_edit_validate($id, $name, $password, $post_code, $address, $manager_name, $email, $profile, $image, $flag)
{
    $company = find_company_by_id($id);
    $errors = [];

    if (empty($name)) {
        $errors['name'][] =  MSG_COMPANYNAME_REQUIRED;
    }

    if (empty($password)) {
        $errors['password'][] =  MSG_PASSWORD_REQUIRED;
    }

    if (empty($post_code)) {
        $errors['post_code'][] =  MSG_POSTCODE_REQUIRED;
    }

    if (empty($address)) {
        $errors['address'][] = MSG_ADDRESS_REQUIRED;
    }

    if (empty($manager_name)) {
        $errors['manager_name'][] =  MSG_MANAGERNAME_REQUIRED;
    }

    if (empty($email)) {
        $errors['email'][] =  MSG_EMAIL_REQUIRED;
    } elseif (check_exist_company($email)) {
        if ($company['email'] != $email) {
            $errors['email'][] =  MSG_EMAIL_DUPLICATE;
        }
    }

    if (empty($profile)) {
        $errors['profile'][] =  MSG_PROFILE_REQUIRED;
    }

    if (!empty($image)) {
        if (check_file_image_ext($image)) {
            $errors['image'][] = MSG_NOT_ABLE_EXT;
        }
    }

    return $errors;
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

//
//---------------------------------------
//job


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
        if (check_file_image_ext($image)) {
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
        if (check_file_image_ext($image)) {
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
