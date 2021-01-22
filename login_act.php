<?php

//最初にSESSIONを開始！！ココ大事！！

session_start();

//POST値を受け取る

$lid = $_POST['lid'];
$lpw = $_POST['lpw'];


//1.  DB接続します
require_once("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
// gs_user_tableに、IDとPWがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw;');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合。中身がゼロ件であれば、STOP
if($status==false){
    sql_error($stmt);
}
// 以下はTRUEの場合。。

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
    
if( $val["id"] != "" ){
    //Login成功時。val["id"]が空＝””じゃなかった場合。
    // それぞれのsessionの中身を付与するイメージ。
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];
    header('Location: select.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();
