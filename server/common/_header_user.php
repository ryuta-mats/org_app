    <header id="menu" class="page_header_user wrapper">
        <h1 class="logo-wrap">
            <a href="index.php">
                <span class="logo-text">NISEKO WORK</span>
                <p class="logo-sub-text">ニセコエリアのお仕事マッチングサイト</p>
            </a>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav">
                <li><a class="nav_link" href="../companys/company_login.php">企業向けページ</a></li>
                <?php if (!empty($login_user)) : ?>
                    <li><a class="nav_link" href="../users/user_appry_list.php">応募リスト</a></li>
                    <li><a class="nav_link" href="../users/user_edit.php?id=<?= $login_user['id'] ?>">登録情報変更</a></li>
                    <li><a class="nav_link" href="../users/user_logout.php">ログアウト</a></li>
                <?php else : ?>
                    <li><a class="nav_link" href="../users/user_signup.php">新規登録</a></li>
                    <li><a class="nav_link" href="../users/user_login.php">ログイン</a></li>
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
                    <li class="login_flag status_logout">
                        <img class="login_image" src="../images/logout.png" alt="ゲストユーザー">
                        <div class="login_wrap">
                            <p>ログアウト中</p>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
