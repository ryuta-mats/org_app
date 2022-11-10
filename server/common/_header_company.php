    <header id="menu" class="page_header_company wrapper">
        <h1>
            <a href="../users/index.php">
                <span class="logo-text">NISEKO WORK</span>
            </a>
            <p class="logo-sub-text">ニセコのお仕事マッチング</p>
        </h1>
        <nav class="menu-content">
            <ul class="menu-nav">
                <?php if (!empty($login_company)) : ?>
                    <li><a class="nav_link" href="../companys/company_job_list.php?id=<?= $login_company['id'] ?>">求人リスト</a></li>
                    <li><a class="nav_link" href="../companys/company_appry_list.php?id=<?= $login_company['id'] ?>">応募者リスト</a></li>
                    <li><a class="nav_link" href="../companys/company_job_create.php">新規求人登録</a></li>
                    <li><a class="nav_link" href="../companys/company_edit.php?id=<?= $login_company['id'] ?>">登録情報変更</a></li>
                    <li><a class="nav_link" href="../companys/company_logout.php">ログアウト</a></li>
                <?php else : ?>
                    <li><a class="nav_link" href="../companys/company_signup.php">新規登録</a></li>
                    <li><a class="nav_link" href="../companys/company_login.php">ログイン</a></li>
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
