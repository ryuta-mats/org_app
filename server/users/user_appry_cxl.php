<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

if (empty($_SESSION['current_user'])) {
    header('Location: user_login.php');
    exit;
} elseif (empty($_GET['appry_id'])) {
    header('Location: user_appry_list.php');
    exit;
}

$login_user = $_SESSION['current_user'];
$appry_id = $_GET['appry_id'];

//関数でキャンセルフラグを0に変更する
if (update_appry_cxl($appry_id)) {
} else {
    //falseの場合、リストにリダイレクトする
    header('Location: user_appry_list.php');
}
$appry =  find_appry_by_appry_id($appry_id);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main">
        <div class="wrapper">
            <div class="tit_wrap">
                <h1 class="title user_bg_title"><span>apply cancel</span>応募のキャンセル</h1>
            </div>
            <h2><?= h($appry['job_name']) ?>を削除しました。</h2>

        </div>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
