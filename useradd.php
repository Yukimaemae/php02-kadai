<?php
//DB接続
require_once('funcs.php');
$pdo = db_conn();

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$pw = password_hash($lpw,PASSWORD_DEFAULT);



if(isset($_POST['useradd'])) {
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id,name,email,address,lid,lpw,kanri_flg,life_flag)
 VALUES(NULL,:name,:email,:address,:lid,:lpw,'0','1')");
};

$stmt->bindValue(':name', $name, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':address', $address, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $pw, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');
}

?>

