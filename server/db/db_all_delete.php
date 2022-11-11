<?php 

require_once __DIR__ . '../../common/functions.php';

try {
    $dbh = connect_db();
    $sql_file = __DIR__ . '/sql/db_all_delete.sql';
    $sql = file_get_contents($sql_file);
    $dbh->exec($sql);

    echo '削除が完了しました';

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
