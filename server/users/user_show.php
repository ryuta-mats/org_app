<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();
$login_user = '';

$id = $_SESSION['current_user']['id'];

// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらば一覧画面にリダイレクト
if (empty($_SESSION['current_user'])) {
    header('Location: ../users/user_login.php');
    exit;
} elseif (empty($id)) {
    header('Location: ../users/index.php');
    exit;
} else {
    $login_user = find_user_by_id($_SESSION['current_user']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>
    <div id="main" class="wrapper show_body">

        <div class="tit_wrap">
            <h1 class="title user_bg_title"><span>User info</span>ユーザー情報</h1>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title ">氏名</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['name']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title ">メールアドレス</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['email']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title">電話番号</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['tel']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title">パスワード</div>
            <div class="input_item_wrap">
                <div>非表示</div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title">郵便番号</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['post_code']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title">住所</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['address']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title  ">年齢</div>
            <div class="input_item_wrap">
                <div><?= h($login_user['age']); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title  ">性別</div>
            <div class="input_item_wrap">
                <div><?= h(rt_str_sex($login_user['sex'])); ?></div>
            </div>
        </div>

        <div class="user_show_wrap">
            <div class="form_title user_title  ">画像</div>
            <div class="input_item_wrap edit_image">
                <img src="../images/user/<?= $login_user['image'] ?>" alt="<?= $login_user['name'] ?>さんのプロフィール画像">
            </div>
        </div>
        <div class="user_show_wrap">
            <a href="../users/user_edit.php" class="bg_btn user_btn show_btn">変更</a>
        </div>

    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
