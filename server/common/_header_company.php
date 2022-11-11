    <header id="menu" class="page_header_company wrapper">
        <h1>
            <a href="../users/index.php">
                <span class="logo-text">NISEKO WORK</span>
            </a>
            <p class="logo-sub-text">ニセコのお仕事マッチング</p>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav">
                <li><a class="nav_link" href="../users/index.php">トップ</a></li>
                <?php if (!empty($login_company)) : ?>
                    <li><a class="nav_link" href="../companys/company_job_list.php">求人リスト</a></li>
                    <li><a class="nav_link" href="../companys/company_appry_list.php">応募者リスト</a></li>
                    <li><a class="nav_link" href="../companys/company_job_create.php">新規求人登録</a></li>
                    <li><a class="nav_link" href="../companys/company_edit.php">登録情報変更</a></li>
                    <li><a class="nav_link" href="../companys/company_logout.php">ログアウト</a></li>
                <?php else : ?>
                    <li><a class="nav_link" href="../companys/company_signup.php">新規登録</a></li>
                <?php endif; ?>

                <?php if ($login_company) : ?>
                    <li class="login_flag status_login">
                        <a class="status_user_login" href="../companys/company_show.php">
                            <img class="login_image" src="../images/company/<?= h($login_company['image']) ?>" alt="<?= $login_company['name'] ?>">
                            <div class="login_wrap">
                                <p><?= h($login_company['name']) ?></p>
                            </div>
                        </a>
                    </li>
                <?php else : ?>
                    <a class="nav_link_btn" href="../companys/company_login.php">
                        <li class="bg_btn company_btn">ログイン</li>
                    </a>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
