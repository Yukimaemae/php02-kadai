<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック
loginCheck();


//以下ログインユーザーのみ
$user_name = $_SESSION['name'];
//$kanri_flg = $_SESSION['kanri_flg'];


//２．データ登録SQL作成
$pdo = db_conn(); 
$stmt = $pdo->prepare("SELECT * FROM my_mv_log");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $imageURL = 'uploads/'.$result["scene"];
    $view .= '<li class="card">';
    $view .= '投稿日: ';
    $view .= '<a href="detail.php?id='.$result['id'].' ">'.$result['indate'].'  ';
    $view .='投稿者: '.$result['name'].'</a>';
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.$result['id'].' ">';
    $view .= '      [ Delete ]';
    $view .= '</a>'.'<br>';
    $view .= 'タイトル: '.$result['title'].'<br>';
    $view .= 'ジャンル:  '.$result['genre'].'<br>';
    $view .= '評価:  '.$result['rate'].'<br>';
    $view .= 'お気に入りのシーン:  '.'<img Src ='.$imageURL.'/>'.'<br>';
    $view .= '感想: '.$result['kanso'];
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.$result['id'].' ">';
    $view .= '      [ Delete ]';
    $view .= '</a>';
    $view .= '</li>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>映画記録表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php">My movie Log</a></div>
    <a class="navbar-brand" href="post.php">新規投稿</a>
    <a class="navbar-brand" href="select.php">投稿一覧</a>
    <a class="navbar-brand" href="login.php">ログイン</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    <a class="navbar-brand" href="user.php">ユーザー登録</a>
    </div>
    <p><?= $user_name ?></p>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
