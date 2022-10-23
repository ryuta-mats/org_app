    <header id="menu" class="page_header_company wrapper">
        <h1>
            <a href="index.php">
                <span class="logo-text">NISEKO WORK</span>
                <p class="logo-sub-text">ニセコエリアのお仕事マッチングサイト</p>
            </a>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav">
                <li><a class="nav_link" href="../companys/company_appry_list.php">求人一覧</a></li>
                <li><a class="nav_link" href="../companys/company_jobofer_list.php">応募者一覧</a></li>
                <li><a class="nav_link" href="../companys/company_signup.php">新規登録</a></li>
                <li><a class="nav_link" href="../companys/company_login.php">ログイン</a></li>
                <?php if ($login_company) : ?>
                    <li class="login_flag status_login">
                        <img class="login_image" src="../images/niseko-ta.jpg" alt="<?= $login_company ?>">
                        <div class="login_wrap">
                            <p><?= $login_company ?></p>
                        </div>
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
