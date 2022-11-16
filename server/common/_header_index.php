    <header class="page_header_index">
        <div class="head_msg_area">
            <p class="head_msg msg_1">ニセコのオシゴト探しなら</p>
            <a href="../users/index.php">
                <span class="logo-text head_msg msg_main">NISEKO WORK</span>
            </a>
            <p class="head_msg msg_2">最短30秒で求人ページが作れる!?</p>
        </div>

        <div class="head_btn_area">
            <a href="../users/user_pre_signup.php" class="bg_btn user_btn head_btn"><div>働きたい！</div>
                <div class="head_btn_text">
                    いますぐ登録 <i class="fa-solid fa-circle-arrow-right"></i>
                </div>
            </a>
            <a href="../companys/company_signup.php" class="bg_btn company_btn head_btn"><div>求人を出したい！</div>
                <div class="head_btn_text">
                    いますぐ登録 <i class="fa-solid fa-circle-arrow-right"></i>
                </div>
            </a>

        </div>

        <div class="page_header_flex_wrap">
            <div class="logo_area">
                <h1 class="logo-wrap">
                    <a href="../users/index.php">
                        <span class="logo-text">NISEKO WORK</span>
                    </a>
                    <p class="logo-sub-text">ニセコのお仕事マッチング</p>
                </h1>
            </div>
            <nav class="menu-content index_menu_content">
                <ul class="menu-nav menu-nav_index">
                    <li>
                        <form class="serch_word" action="index.php#serch_position" method="post">
                            <input type="text" id="serch_word_input" name="serch_word">
                            <label class="serch-btn" for="serch-word-submit">
                                <i class="fa-sharp fa-solid fa-magnifying-glass" for="serch-word-submit"></i>
                                <input id="serch-word-submit" type="submit" value="">
                            </label>
                        </form>
                    </li>
                    <a class="nav_link_btn" href="../companys/company_login.php">
                        <li class="bg_btn company_btn nav_btn">企業向け</li>
                    </a>
                    <li><a class="nav_link" href="../users/index.php">トップ</a></li>
                    <?php if (!empty($login_user)) : ?>
                        <li><a class="nav_link" href="../users/user_appry_list.php">応募リスト</a></li>
                        <li><a class="nav_link" href="../users/user_edit.php">登録情報変更</a></li>
                        <li><a class="nav_link" href="../users/user_logout.php">ログアウト</a></li>
                    <?php else : ?>
                        <li><a class="nav_link" href="../users/user_pre_signup.php">新規登録</a></li>
                    <?php endif; ?>

                    <?php if ($login_user) : ?>
                        <li class="login_flag">
                            <a class="status_user_login" href="../users/user_show.php">
                                <img class="login_image" src="../images/user/<?= h($login_user['image']) ?>" alt="<?= $login_user ?>">
                                <div class="login_wrap">
                                    <p><?= h($login_user['name']) ?></p>
                                </div>
                            </a>
                        </li>
                    <?php else : ?>
                        <a class="nav_link_btn" href="../users/user_login.php">
                            <li class="bg_btn user_btn nav_btn">ログイン</li>
                        </a>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
<div id="serch_position"></div>
