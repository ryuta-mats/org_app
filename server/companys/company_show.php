<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();
$login_company = '';
$edit = 0;
// セッションにidが保持されていなければログイン画面にリダイレクト
// パラメータを受け取れなけれらばログイン画面にリダイレクト
if (empty($_SESSION['current_company'])) {
    header('Location: ../companys/company_login.php');
    exit;
} else {
    $id = $_SESSION['current_company']['id'];
    $login_company = find_company_by_id($_SESSION['current_company']['id']);
}

//edit.phpから変更後のアクセスか判定
if (!empty($_GET['edit'])) {
    $edit = $_GET['edit'];
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper show_body">
        <?php if ($edit != 0) : ?>
            <!--変更があったときのみ表示-->
            <div class="login_err_wrap">
                <ul class="err_msg">
                    <li>下記の通り変更しました。</li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="tit_wrap">
            <h1 class="title company_bg_title"><span>Company info</span>カンパニーユーザー登録情報</h1>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title ">会社名</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['name']); ?></div>
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title">パスワード</div>
            <div class="input_item_wrap">
                <div>非表示</div>
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title">郵便番号</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['post_code']); ?></div>
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title">住所</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['address']); ?></div>
            </div>
        </div>
        <div class="_show_wrap">
            <div class="form_title company_title ">担当者名</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['manager_name']); ?></div>
            </div>
        </div>

        <div class="_show_wrap">
            <div class="form_title company_title ">担当者メールアドレス</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['email']); ?></div>
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title">会社概要</div>
            <div class="input_item_wrap">
                <div><?= h($login_company['profile']); ?></div>
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title  ">画像</div>
            <div class="input_item_wrap edit_image">
                <img src="../images/company/<?= $login_company['image'] ?>" alt="<?= $login_company['name'] ?>の画像">
            </div>
        </div>

        <div class="show_wrap">
            <div class="form_title company_title">会社ホームページ</div>
            <div class="input_item_wrap">
                <div>
                    <?php if (empty($login_company['url'])) : ?>
                        登録無し
                    <?php else : ?>
                        <a href="<?= h($login_company['url']); ?>"><?= h($login_company['url']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="show_wrap">
            <a href="../companys/company_edit.php" class="bg_btn company_btn show_btn">変更</a>
        </div>

    </div>

    </form>
    </div>
    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
