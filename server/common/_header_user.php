    <header id="menu" class="page_header_user wrapper">
        <h1 class="logo-wrap">
            <a href="../users/index.php">
                <span class="logo-text">NISEKO WORK</span>
            </a>
            <p class="logo-sub-text">ニセコのお仕事マッチング</p>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav user_menu-nav">

                <li class="bg_btn company_btn nav_btn"><a class="nav_link_btn" href="../companys/company_login.php"><span>企業向け</span><i class="fa-solid fa-building nav_icon"></i></a></li>

                <li><a class="nav_link" href="../users/index.php"><span>トップ</span><i class="fa-solid fa-house nav_icon"></i></a></li>
                <?php if (!empty($login_user)) : ?>
                    <li><a class="nav_link" href="../users/user_appry_list.php"><span>応募リスト</span><i class="fa-solid fa-list nav_icon"></i></a></li>
                    <li><a class="nav_link" href="../users/user_edit.php"><span>登録情報変更</span><i class="fa-solid fa-pen-to-square nav_icon"></i></a></li>
                    <li><a class="nav_link" href="../users/user_logout.php"><span>ログアウト</span><i class="fa-solid fa-right-from-bracket nav_icon"></i></a></li>
                <?php else : ?>
                    <li><a class="nav_link" href="../users/user_pre_signup.php"><span>新規登録</span><i class="fa-solid fa-user-plus nav_icon"></i></a></li>
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
                    <li class="bg_btn user_btn nav_btn"><a class="nav_link_btn" href="../users/user_login.php">ログイン</a></li>
                <?php endif; ?>
            </ul>
            <?php if ($_SERVER['SCRIPT_NAME'] == '/users/index.php') : ?>
                <form class="serch_word" action="" method="post">
                    <input type="text" id="serch_word_input" name="serch_word">
                    <label class="serch-btn" for="serch-word-submit">
                        <i class="fa-sharp fa-solid fa-magnifying-glass" for="serch-word-submit"></i>
                        <input id="serch-word-submit" type="submit" value="">
                    </label>
                </form>
            <?php endif; ?>

        </nav>
    </header>
