<?php
include_once __DIR__ . '/../common/functions.php';
// セッション開始
session_start();

$login_company = '';

if (isset($_SESSION['current_company'])) {
    $login_company = $_SESSION['current_company'];
}

$users = array(
    0 => array(
        'name' => 'ニセコ太郎',
        'job' => '営業職',
        'tel' => '100_0000_0000',
        'address' => 'aaa@bbb.jp',
        'motivation' => '貴社の企業理念に惹かれたからです。貴社の企業理念に惹かれたからです。貴社の企業理念に惹かれたからです。貴社の企業理念に惹かれたからです。',
    ),
    1 => array(
        'name' => 'ニセコ花子',
        'job' => '事務職',
        'tel' => '111_1111_1111',
        'address' => 'ccc@ddd.jp',
        'motivation' => '家から近いからです。',
    )
);

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>

    <?php include_once __DIR__ . "/../common/_header_company.php" ?>

    <div id="main" class="wrapper">
        <h2 class="title company_bg_title">応募者一覧</h2>

        <table class="base_table">
            <thead>
                <tr class="headline">
                    <th>名前</th>
                    <th>応募先求人</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>志望動機</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="td_center"><?= h($user['name']) ?></td>
                        <td class="td_center"><?= h($user['job']) ?></td>
                        <td class="td_center"><?= h($user['tel']) ?></td>
                        <td class="td_center"><?= h($user['address']) ?></td>
                        <td><?= h($user['motivation']) ?></td>

                        <td class="icon_td">
                            <div class="icons_wrap">
                                <a href="" class="icon icon_appry_detail icon_wrap">
                                    <i class="fa-solid fa-file"></i>
                                    <p>履歴書</p>
                                </a>
                                <a href="" class="icon icon_appry_detail icon_wrap">
                                    <i class="fa-solid fa-message"></i>
                                    <p>メッセージ</p>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_company.html" ?>
</body>

</html>
