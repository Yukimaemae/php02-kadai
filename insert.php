<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$name = $_POST['name'];
$title = $_POST['title'];
$genre = $_POST['genre'];
$rate = $_POST['rate'];
$kanso = $_POST['kanso'];

// ファイルのアップロード先
$targetDir = "./uploads";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

// 2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// ３．SQL文を用意(データ登録：INSERT)
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
  // 特定のファイル形式の許可
  $allowTypes = array('jpg','png','jpeg','gif','pdf');
  if(in_array($fileType, $allowTypes)){
      // サーバーにファイルをアップロード
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
          // データベースに画像ファイル名を挿入
          $stmt = $pdo->prepare(
            "INSERT INTO my_mv_log(id,name,title,genre,rate,scene,kanso,indate)
            VALUES( NULL, :name, :title, :genre, :rate, $fileName, :kanso, sysdate())"
          );
        }}};

//$nameのようにユーザーが入力したものをそのまま引っ張ると危険。:を付けることでバインド関数を用意

// 4. バインド変数を用意(セキュリティ対策)
$stmt->bindValue(':name', $name, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':genre', $genre, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rate', $rate, pdo::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanso', $kanso, pdo::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: select.php');
}
?>
