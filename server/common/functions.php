<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions_varidate.php';
require_once __DIR__ . '/functions_db.php';

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

//画像のアップロードが対象の拡張子か確認する関数
function check_file_image_ext($upload_file)
{
    $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
    return !in_array($file_ext, EXTENSION_IMAGE) ? true : false;
}
//履歴書のアップロードが対象の拡張子か確認する関数
function check_file_pdf_ext($upload_file)
{
    $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
    return !in_array($file_ext, EXTENSION_PDF) ? true : false;
}

//性別を文字に変換する関数
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

//--------------------------------------------
//user
//ユーザーのログインを行う関数
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

//--------------------------------------------
//company
//カンパニーユーザーがログインする関数
function company_login($company)
{

    $_SESSION['current_company']['id'] = $company['id'];
    $_SESSION['current_company']['name'] = $company['name'];
    $_SESSION['current_company']['email'] = $company['email'];
    $_SESSION['current_company']['manager_name'] = $company['manager_name'];
    $_SESSION['current_company']['image'] = $company['image'];

    header('Location: ../companys/company_job_list.php');
    exit;
}
