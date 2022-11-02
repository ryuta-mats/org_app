<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

//
//---------------------------------------
//user

//ユーザーサインアップのバリデーションを行う関数
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

//
//---------------------------------------
//company
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
//company


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

