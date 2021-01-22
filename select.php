<?php

session_start();

// 参照されたファイルの中の関数が呼び出せるようになる。
require_once('funcs.php');
loginCheck();

//1.  DB接続します。insertと同じ。コピペで対応。
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=bookmark_kadai;charset=utf8;host=localhost', 'root', 'root'); //MAMPIDPassが「root」になっている
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

//２．データ取得SQL作成
// insertはインジェクション対応したが、今回は不要。すでにDB登録しているものなので。
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

        $view .= '<a href = "bm_update_view.php?id=' .$result['id']. '">';
        $view .= '【更新日】　　' . h($result['updated']) . '<br>' .
                 '【登録日】　　' . h($result['indate']) . '<br>' .
                 '【書籍名】　　' . h($result['bookname']) . '<br>' .
                 '【URL】　　　'    . h($result['url'])  . '<br>' .
                 '【コメント】　' . h($result['comment']) . '<br>';
        $view .= '</a>';

        if($_SESSION["kanri_flg"] == 1){
        $view .= '<a href = "delete.php?id=' .$result['id']. '">';
        $view .= '◆削除◆';
        $view .= '</a>';
        }
        
    
        $view .= '</p>';
 }
}
?>

  <!-- // $stmt->fetchで1行1行取ってくる。。
  // .=の意味は、上書きでは無くて足されていく。 -->



  <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookmark一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 20px;
        }

        a {
            font-size: 20px;
        }


}

    </style>
</head>
<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">登録画面</a>
                    <a class="navbar-brand" href="logout.php">ログアウト</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <!-- Main[Start] -->
  
  <table>

  <?= $view ?>
  
  </table>



    <!-- <div>   
        <div class="container jumbotron"><?= $view ?></div>
    </div> -->

</body>
</html>