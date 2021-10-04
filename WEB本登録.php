<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>本登録</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
    <h1>[本登録はこちらから]</h1>
    <br>
    <input type="text" name="name" placeholder="名前を記入">  
    <br>
    <input type="text" name="pass" placeholder="パスワードを記入">
    <button type="submit" name="submit">送信</button>
    <br>
    </form>
<?php
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//新規登録
if(!empty($_POST["name"]) and !empty($_POST["pass"])){
    $user_name=$_POST["name"];
    $password=$_POST["pass"];
    $sql = $pdo -> prepare("INSERT INTO 本登録 (user_name, password, date) VALUES (:user_name, :password, :date)");
    $sql -> bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $user_name=$user_name;
    $password=$password;
    $date=date("Y年m月d日 H時i分s秒");
    $sql -> execute();
//データベースに登録完了
    echo "登録完了
    <br>
    <br>";
    "↓こちらからログインすることができます";
    echo '<a href="'. "https://tech-base.net/tb-230455/WEB%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3%E7%94%BB%E9%9D%A2.php" .'">'. "ログイン画面に移動します。" .'</a>';
}


?>
</body>
</html>