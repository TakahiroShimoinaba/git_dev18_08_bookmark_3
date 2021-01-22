<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//DB接続
function db_conn() 
{
    try {
        $db_name = "bookmark_kadai";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;
        // 関数の外で使えるようにするためにreturnを追加する必要がある。

    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
$error = $stmt->errorInfo();
exit("SQLError:".$error[2]);
};


//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
header("Location:" . $file_name);
exit();

}

// ログインチェック処理 loginCheck()

// if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()
// ！　isset $?_SESSION['chk_ssid]　がisset、セットされていなかった場合。
// || または、|| $_SESSION['chk_ssid'] != session_id()　⇒　$_SESSION['chk_ssid']　とsession_idが一致してない時


function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        exit('LOGIN ERROR!!!!!!');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

// 一度ログインチェックに成功したらregenerateして新しい
// session IDを生成する仕組みにして、ハイジャックを防いでいる。