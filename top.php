<?php

require_once('funcs.php');


//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();



//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる。
    // 結果を$resultの中に取り出してくれる。
    // $result['項目名']の形で取り出せる。　.　でつないでいく。
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $view .= '<p>';

        $view .= '<a href = "bm_update_view2.php?id=' .$result['id']. '">';
        $view .= '【更新日】　　' . h($result['updated']) . '<br>' .
                 '【書籍名】　　' . h($result['bookname']) . '<br>' ;
        $view .= '</a>';        
    
        $view .= '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Bookmark</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                 <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div style="color:gray; font-size:40px; text-align:center;">最近読んだ本のまとめ</div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

</body>
</html>