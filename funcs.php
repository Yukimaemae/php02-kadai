<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。

function db_conn(){
    try {
        $db_name = "gs_pj";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; // これを追記
    } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
      }
};




//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
};

//リダイレクト関数: redirect($file_name)
//５．index.phpへリダイレクト


function redirect($file_name){

    header("Location:".$file_name);
    exit();
};