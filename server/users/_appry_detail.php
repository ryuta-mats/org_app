<table class="table ">
    <tbody>
        <tr class="element">
            <th>会社名</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['company_name']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>募集職種</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['job_name']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>給与</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['salary_category']) ?><?= h($job['salary_price']) ?>円</p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>仕事内容</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['profile']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>募集期間</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['start_date']) ?> <?= h($job['start_time']) ?> ～ <?= h($job['end_date']) ?> <?= h($job['end_time']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>企業ホームページ</th>
            <td>
                <div class="job_info_item">
                    <a href="<?= h($job['url']) ?>"><?= h($job['url']) ?></a>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="appry_image">
    <img src="<?= h($job['image']) ?>" alt="<?= h($job['company_name']) ?>">
</div>
