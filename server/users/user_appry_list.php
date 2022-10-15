<?php
include_once __DIR__ . '/../common/functions.php';

?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header.php" ?>
    <div id="main">
        <div class="wrapper">
            <h2 class="title">応募中求人一覧</h2>
            <table class="user_app_list_table" >
                <thead>
                    <tr class="headline">
                        <th>会社名</th>
                        <th>職種</th>
                        <th>給料</th>
                        <th>仕事内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ニセコ株式会社</td>
                        <td>営業職</td>
                        <td>25万円</td>
                        <td>楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト</td>
                        <td class="icon_td">
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-circle-info"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-trash"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-message"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>株式会社ニセコリゾート観光協会</td>
                        <td>営業職</td>
                        <td>25万円</td>
                        <td>楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト楽しい仕事です。テキストテキストテキストテキストテキストテキストテキストテキスト</td>
                        <td class="icon_td">
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-circle-info"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-solid fa-trash"></i></a>
                            <a href="" class="icon icon_appry_detail"><i class="fa-regular fa-message"></i></a>                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer.html" ?>
</body>

</html>
