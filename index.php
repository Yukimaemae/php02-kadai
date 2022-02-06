
<?php
//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

$user_name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>My Movie Log</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <style>div{text-align: center; padding: 10px;font-size:16px;}</style>
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

  <div class="jumbotron">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">

        </div>
    </div>
</nav>
  </div>

<!-- Main[End] -->



</body>
</html>
