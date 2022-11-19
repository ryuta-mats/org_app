<dl class="job_detail_body">
    <?php if (!empty($job['image'])) : ?>
        <div class="job_detail_wrap">
            <dd class="job_detail_content">
                <div class="appry_image">
                    <img src="../images/job/<?= h($job['image']) ?>" alt="<?= h($company['name']) ?>">
                </div>
            </dd>
        </div>
    <?php endif; ?>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">会社名</dt>
        <dd class="job_detail_content"><?= h($company['name']) ?></dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">募集職種名</dt>
        <dd class="job_detail_content"><?= h($job['name']) ?></dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">給料</dt>
        <dd class="job_detail_content"><?= h($category['name']) ?><?= h($job['price']) ?>円</dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">仕事内容</dt>
        <dd class="job_detail_content"><?= h($job['profile']) ?></dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">勤務地</dt>
        <dd class="job_detail_content">
            <p><?= h($job['area']) ?></p>
        </dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">人事担当者</dt>
        <dd class="job_detail_content">
            <p><?= h($company['manager_name']) ?></p>
        </dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">募集期間</dt>
        <dd class="job_detail_content">
            <p><?= h($job['start_date']) ?> から</p>
            <p><?= h($job['end_date']) ?> まで</p>
        </dd>
    </div>
    <div class="job_detail_wrap">
        <dt class="job_detail_title">企業ホームページ</dt>
        <dd class="job_detail_content">
            <?php if (empty($company['url'])) : ?>
                登録無し
            <?php else : ?>
                <a href="<?= h($company['url']); ?>"><?= h($company['url']); ?></a>
            <?php endif; ?>
        </dd>
    </div>
</dl>
