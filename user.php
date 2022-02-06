<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

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

<h2>新規会員登録</h2>

<div class="container jumbotron">
<form name="useradd" action="useradd.php" method="post">
<p>名前：<input type="text" name="name" /></p>
<p>e-mail：<input type="email" name="email" /></p>
<p>住所：<input type="text" name="address" /></p>
<p>会員ID：<input type="text" name="lid" /></p>
<p>パスワード：<input type="password" name="lpw" /></p>
<input type="submit" value="useradd" />
</from>
</div>

</body>
</html>

