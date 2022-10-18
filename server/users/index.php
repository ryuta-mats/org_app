<?php
include_once __DIR__ . '/../common/functions.php';
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . "/../common/_head.html" ?>

<body>
    <?php include_once __DIR__ . "/../common/_header_user.php" ?>

    <div id="main">
        <div class="serch wrapper">
            <form class="serch_category" action="" method="post">
                <label for="serch_category_select">カデコリ検索<br>
                    <select name="serch_category" id="serch_category_select">
                        <option value="jimu">事務系</option>
                        <option value="eigyo">営業系</option>
                        <option value="nikutai">肉体労働系</option>
                    </select>
                </label>
                <label class="serch-btn" for="serch-category-submit">
                    <i class="fa-sharp fa-solid fa-magnifying-glass" for="serch-category-submit"></i>
                    <input id="serch-category-submit" type="submit" value="検索">
                </label>
            </form>

            <form class="serch_word" action="" method="post">
                <label for="serch_word_input">キーワード検索<br>
                    <input type="text" id="serch_word_input">
                </label>
                <label class="serch-btn" for="serch-word-submit">
                    <i class="fa-sharp fa-solid fa-magnifying-glass" for="serch-word-submit"></i>
                    <input id="serch-word-submit" type="submit" value="検索">
                </label>
            </form>
        </div>
        <div id="job" class="wrapper">
            <div class="job-row">
                <div class="job-1 job-content">
                    <h3 class="company-name">会社名</h3>
                    <img class="job-image" src="../images/c1.jpg" alt="job1のimage">
                    <p class="job-text">仕事内容テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
                    <a href="" class="detail">詳しく見る<i class="fa-sharp fa-solid fa-circle-chevron-right"></i></a>
                </div>
                <div class="job-2 job-content">
                    <h3 class="company-name">会社名</h3>
                    <img class="job-image" src="../images/c1.jpg" alt="job2のimage">
                    <p class="job-text">仕事内容テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
                    <a href="" class="detail">詳しく見る<i class="fa-sharp fa-solid fa-circle-chevron-right"></i></a>
                </div>
                <div class="job-3 job-content">
                    <h3 class="company-name">会社名</h3>
                    <img class="job-image" src="../images/c1.jpg" alt="job3のimage">
                    <p class="job-text">仕事内容テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
                    <a href="" class="detail">詳しく見る<i class="fa-sharp fa-solid fa-circle-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . "/../common/_footer_user.html" ?>
</body>

</html>
