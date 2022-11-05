<table class="table ">
    <tbody>
        <tr class="element">
            <th>会社名</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($company['name']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>募集職種</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($job['name']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>給与</th>
            <td>
                <div class="job_info_item">
                    <p><?= h($category['name']) ?><?= h($job['price']) ?>円</p>
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
                    <p><?= h($job['start_date']) ?>～ <?= h($job['end_date']) ?></p>
                </div>
            </td>
        </tr>
        <tr class="element">
            <th>企業ホームページ</th>
            <td>
                <div class="job_info_item">
                    <?php if (empty($company['url'])) : ?>
                        登録無し
                    <?php else : ?>
                        <a href="<?= h($company['url']); ?>"><?= h($company['url']); ?></a>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="appry_image">
    <img src="../images/job/<?= h($job['image']) ?>" alt="<?= h($company['name']) ?>">
</div>
