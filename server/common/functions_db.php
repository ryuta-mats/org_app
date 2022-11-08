<?php
// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

//
//---------------------------------------
//user

//新しいユーザーをデータベースに保存する関数
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

//userテーブルの対象idの情報をアップデートする関数
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

//userテーブルから対象IDのユーザー情報をもってくる関数
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

//ユーザーのemailからユーザー情報をもってくる関数
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

//引数のメールアドレスが既にusersテーブルに登録があるか確認する関数
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
//
//---------------------------------------
//appry

function insert_use_appry($job_id, $user_id, $company_id, $motivation, $resume)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            appry
            (ofer_id, user_id, company_id, motivation, resume)
        VALUES
            (:ofer_id, :user_id, :company_id, :motivation, :resume)
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':ofer_id', $job_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->bindValue(':motivation', $motivation, PDO::PARAM_STR);
        $stmt->bindValue(':resume', $resume, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

//
//---------------------------------------
//company

//あたらしく会社を登録する関数
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

//カンパニーDBの対象IDの情報をアップデート修正する関数
function update_company($id, $name, $post_code, $address, $manager_name, $email, $profile, $image, $url)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        UPDATE
            companies
        SET
            name = :name,
            post_code = :post_code,
            address = :address,
            manager_name = :manager_name,
            email = :email,
            profile = :profile            
        EOM;

        if (!empty($image)) {
            $sql .= ', image = :image';
        }
        if (!empty($url)) {
            $sql .= ', url = :url';
        }

        $sql .= ' WHERE id = :id';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $post_code, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':manager_name', $manager_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
        if (!empty($image)) {
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        }
        if (!empty($url)) {
            $stmt->bindValue(':url', $url, PDO::PARAM_STR);
        }

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

//カンパニーテーブルからemailをもとに会社情報をもっていくる関数
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

//カンパニーテーブルからidをもとに会社情報をもっていくる関数
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

//引数のメールアドレスがcompaniesテーブルに既に登録があるか調べる関数
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

//job------------

//新しい求人をデータベースに登録する関数
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

//対象idの求人の情報をアップデートする関数
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

//対象idの求人をキャンセルにする関数
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

//oferテーブルからIDが一致する求人をもってくる関数
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



//給与カデコリidから給与を探す関数
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

//求人テーブルでカンパニーIDの求人情報情報をすべてとってくる関数
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

//応募テーブルでIDの求人情報情報をすべてとってくる関数
function find_appry_by_id($id)
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

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//カンパニーIDから応募を探す関数
function find_appry_by_company_id($company_id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        a.id AS appry_id,
        a.company_id,
        c.name AS company,
        a.ofer_id AS job_id,
        o.name AS job_name,
        o.category_id AS saraly_category,
        o.price,
        o.profile,
        o.area,
        o.cxl_flag,
        a.user_id,
        u.name AS user,
        u.tel AS user_tel,
        u.email AS user_email,
        u.age AS user_age,
        u.sex AS user_sex,
        u.image AS user_image,
        a.motivation,
        a.resume,
        a.status_id,
        s.name AS status,
        a.created_at
    FROM
        appry AS a
    INNER JOIN
        companies AS c
    ON
        a.company_id = c.id
    INNER JOIN
        ofer AS o
    ON
        a.ofer_id = o.id
    INNER JOIN
        users AS u
    ON
        a.user_id = u.id
    INNER JOIN
        status AS s
    ON
        a.status_id = s.id
    WHERE
        a.company_id = :company_id;

    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//ユーザーIDから申込みを探す関数
function find_appry_by_user_id($user_id)
{

    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        a.id AS appry_id,
        a.company_id,
        c.name AS company,
        a.ofer_id AS job_id,
        o.name AS job_name,
        o.category_id AS saraly_category,
        sa.name AS category_name,
        o.price,
        o.profile,
        o.area,
        o.cxl_flag AS cxl_ofer,
        a.user_id,
        u.name AS user,
        u.tel AS user_tel,
        u.email AS user_email,
        u.age AS user_age,
        u.sex AS user_sex,
        u.image AS user_image,
        a.motivation,
        a.resume,
        a.status_id,
        s.name AS status,
        a.created_at,
        a.cxl_flag AS appry_cxl
    FROM
        appry AS a
    INNER JOIN
        companies AS c
    ON
        a.company_id = c.id
    INNER JOIN
        ofer AS o
    ON
        a.ofer_id = o.id
    INNER JOIN
        users AS u
    ON
        a.user_id = u.id
    INNER JOIN
        status AS s
    ON
        a.status_id = s.id
    INNER JOIN
        saraly_category AS sa
    ON
        o.category_id = sa.id
    WHERE
        a.user_id = :user_id
    AND
        o.cxl_flag = :cxl_flag;

    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':cxl_flag', 1, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//申込みIDから申込み1件を見つける関数
function find_appry_by_appry_id($appry_id)
{

    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        a.id AS appry_id,
        a.company_id,
        c.name AS company,
        a.ofer_id AS job_id,
        o.name AS job_name,
        o.category_id AS saraly_category,
        sa.name AS category_name,
        o.price,
        o.profile,
        o.area,
        o.cxl_flag AS ofer_cxl,
        a.user_id,
        u.name AS user,
        u.tel AS user_tel,
        u.email AS user_email,
        u.age AS user_age,
        u.sex AS user_sex,
        u.image AS user_image,
        a.motivation,
        a.resume,
        a.status_id,
        s.name AS status,
        a.created_at,
        a.cxl_flag AS appry_cxl
    FROM
        appry AS a
    INNER JOIN
        companies AS c
    ON
        a.company_id = c.id
    INNER JOIN
        ofer AS o
    ON
        a.ofer_id = o.id
    INNER JOIN
        users AS u
    ON
        a.user_id = u.id
    INNER JOIN
        status AS s
    ON
        a.status_id = s.id
    INNER JOIN
        saraly_category AS sa
    ON
        o.category_id = sa.id
    WHERE
        a.id = :appry_id;

    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':appry_id', $appry_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//対象idの申込みをキャンセルにする関数
function update_appry_cxl($id)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        UPDATE
            appry
        SET
            cxl_flag = :cxl_flag,
            status_id = :status_id
        EOM;

        $sql .= ' WHERE id = :id';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':cxl_flag', 0, PDO::PARAM_INT);
        $stmt->bindValue(':status_id', 4, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

//新しいメッセージをデータベースに登録する関数
function inssert_message($body, $appry, $msg_from)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            message
            (appry_id, user_id, company_id, body, msg_from)
        VALUES
            (:appry_id, :user_id, :company_id, :body, :msg_from);
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':appry_id', $appry['appry_id'], PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $appry['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':company_id', $appry['company_id'], PDO::PARAM_INT);
        $stmt->bindValue(':body', $body, PDO::PARAM_STR);
        $stmt->bindValue(':msg_from', $msg_from, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}

//メッセージテーブルから対象のおうぼIDのメッセージの情報をすべてとってくる関数
function find_message_by_appry_id($appry_id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        m.id,
        m.appry_id,
        a.ofer_id,
        o.name AS job_name,
        m.user_id,
        u.name AS user,
        m.company_id,
        c.name AS company,
        m.body,
        m.msg_from,
        m.created_at
    FROM
        message AS m
    INNER JOIN
        companies AS c
    ON
        m.company_id = c.id
    INNER JOIN
        users AS u
    ON
        m.user_id = u.id
    INNER JOIN
        appry AS a
    ON
        m.appry_id = a.id
    INNER JOIN
        ofer AS o
    ON
        a.ofer_id = o.id
    WHERE
        m.appry_id = :appry_id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':appry_id', $appry_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
