<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo ->prepare('SELECT * FROM my_mv_log WHERE id=:id');
$stmt ->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = ' ';

if ($status == false){
    sql_error($stmt);
}else{
    $result = $stmt->fetch();
}

?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
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
<form method="POST" enctype="multipart/form-data" action="update.php">
      
  <div class="jumbotron">
   <fieldset>
    <legend>My Movie Log</legend>
     <label>Name：<br>
     <input type="text" name="name" value="<?= $result['name']?>"></label><br>
     <label>Title：<br>
     <input type="text" name="title" value="<?= $result['title']?>"></label><br>
     <label>ジャンル：<br>
       <input type="text" name="genre" value="<?= $result['genre']?>"></label><br>
     <label>Rate：
     <select name="rate" value="<?= $result['rate']?>">
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
       <option value="5">5</option>
      </select>
     </label><br>
     <label>お気に入りシーン：<br>
     <input type="file" name="up">
     <!--  <input type="submit" value="アップロード"> -->
      </label><br>
     <label>感想：<br>
     <textArea name="kanso" rows="4" cols="40" ><?= $result['kanso']?></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>

</html>
