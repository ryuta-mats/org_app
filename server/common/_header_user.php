    <header id="menu" class="page_header_user wrapper">
        <h1 class="logo-wrap">
            <a href="index.php">
                <span class="logo-text">NISEKO WORK</span>
                <p class="logo-sub-text">ニセコエリアのお仕事マッチングサイト</p>
            </a>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav">
                <li><a class="nav_link" href="../companys/company_login.php">企業向け</a></li>
                <li><a class="nav_link" href="">問い合わせ</a></li>
                <li><a class="nav_link" href="../users/user_signup.php">新規登録</a></li>
                <li><a class="nav_link" href="../users/user_login.php">ログイン</a></li>
                <?php if ($login_user) : ?>
                    <li class="login_flag status_user_login">
                        <img class="login_image" src="../images/ryuta_matsumoto.PNG" alt="<?= $login_user ?>">
                        <div class="login_wrap">
                            <p><?= $login_user['name'] ?></p>
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
