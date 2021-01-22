<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ


$bookname = $_POST['bookname'];
$url = $_POST['url'];
$comment = $_POST['comment'];


//2. DB接続します。（エクセルで言うと「開く」） try catchなどは自分で調べる。ダメだったら21,22行目。  
// tryで接続に行って、catchで$eにエラーメッセージを受けてgetMessage()で表示する。★一塊で覚える。コピペ。★
try {
    //ID:'root', Password: 'root' 外部サーバーだとここにid/passを打つ。
    // host=localhost   外部サーバーだとここにipアドレスを打つことになる。

    $pdo = new PDO('mysql:dbname=bookmark_kadai;charset=utf8;host=localhost', 'root', 'root'); //MAMPIDPassが「root」になっている
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

//３．データ登録SQL作成

/// 1. SQL文を用意
// 「データベースは半角英数字でないといけない」ラーニングシステムより
// indate はinput dateの略
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, bookname, url, comment)VALUES(NULL, :bookname, :url, :comment)");

//  2. バインド変数を用意
// 上記SQL文で準備した:xxxxに対して、上記16行目付近で宣言した変数である$bookname、$urlなどを入れる、という指示文。
// :xxxxはSQL文と対象さえしていれば実際はbookmark等今回の実際の変数でなくても良い。
// 変な文字（ハッキングや悪意のあるもの）があった場合は無効化するのがbind関数。
// bind＝関連付ける関数

$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// ↑　XSSのように、ユーザーが書いた内容を直接インサートするのではなく、
// 一度変数に入れている。

//  3. 実行
$status = $stmt->execute();
// $statusに実行結果を入れる。
// sql開いて、入れるものを準備して、実行。

//４．データ登録処理後
// エラー処理は書き換える必要が無いので触る必要はほとんどない。

if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:" . $error[2]);
} else {

  // exitはここで処理を止める、ということ。
  // $erroの文字列で読めるのは配列の2番目なので[2]としている。


  //５．index.phpへリダイレクト

  header('Location: index.php');
// header関数はリダイレクト。header locationという括りで覚えてしまう。
}
?>
