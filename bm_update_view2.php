<?php

/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */

// var_dump($GET);

// funcsの関数を使えるように呼び出す
require_once ('funcs.php');

// 実際のfuncsの関数を入力する
$pdo = db_conn();

$id = $_GET['id'];

// DB接続　　insert.phpからコピー

// try {
//     $db_name = "gs_db3";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:'.$e->getMessage());
// }



//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = ' . $id. ';');
$status = $stmt->execute();


//３．データ表示

if ($status == false) {
    sql_error($status);

} else {

    $row =  $stmt->fetch();
}
// fetchはデータを1個だけ取り出す。

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="top.php">Topへ</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<!-- updateにPOSTする -->

  <div class="jumbotron">
   
    <legend>詳細</legend>
     <p>登録日： <?= $row['indate'] ?></ｐ>
     <p>更新日： <?= $row['updated'] ?></p>
     <p>書籍名： <?= $row['bookname'] ?></p>
     <p>URL：<?= $row['url'] ?></p>
     <p>コメント<?= $row['comment'] ?></textArea></p><br>
     
    
  </div>

<!-- Main[End] -->


</body>
</html>
