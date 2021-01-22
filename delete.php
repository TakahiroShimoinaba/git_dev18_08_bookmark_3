
<?php

// detailからまるっとコピー


// funcsの関数を使えるように呼び出す
require_once ('funcs.php');

// 実際のfuncsの関数を入力する
$pdo = db_conn();
$id = $_GET['id'];


//データ削除SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id');
// ↓追加
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示

if ($status == false) {
    sql_error($status);

} else {

redirect('select.php');
}



?>