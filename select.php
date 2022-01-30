<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_pj;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
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
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
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
