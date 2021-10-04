<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン画面</title>
</head>
<body>
<form action="" method="post">
    <h1>[ログイン]</h1>
    <br>
    <input type="text" name="name_1" placeholder="名前を記入">  
    <br>
    <input type="text" name="pass_1" placeholder="パスワードを記入">
    <button type="submit" name="submit" >送信</button>
    <br>
    <br>
    <br>
    <h2>[確認用]</h2>
    <p>
        登録がお済かどうかわからない方はこちらに登録した名前とメールアドレス入力して送信してください。
    </p>
    <p>
        *もしされていましたら登録されている情報が表示されます
    </p>
    <p>
        <!--  文字の色を変更、下線を引きます  -->
        *<span style="color:red; text-decoration: underline" >パスワードの確認にも使えます</span>
    </p>
    <input type="text" name="name_2" placeholder="名前を記入">  
    <button type="submit" name="submit" >送信</button>
    <br>
    <br>
<?php
if(!empty($_POST["name_2"])){
    $dsn="データベース名";
    $user="ユーザー名";
    $password="パスワード";
    $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $user_name=$_POST["name_2"];
    $sql="select * from 本登録 where user_name=:user_name";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
	$stmt-> execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row){
    //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['user_name'].',';
            echo $row['password'].',';
            echo $row['date'].'<br>';
        echo "<hr>";
    }
}
?>
    <br>
    <br>
    <br>
    <br>
    <br>
    -------------------------------------------------------------------------------------------
    <h3>頂いたコメント</h3>
<?php
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM コメント登録';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
//$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name2'].',';
        echo $row['comment2'].',';
        echo $row['commentdate'].'<br>';
    echo "<hr>";
    }
?>
    </form>
<?php
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if(!empty($_POST["name_1"]) and !empty($_POST["pass_1"])){
    $user_name=$_POST["name_1"];
    $password=$_POST["pass_1"];
    $sql="select * from 本登録 where user_name=:user_name and password=:password";
    $stmt = $pdo->prepare($sql);    
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
	$stmt-> execute();
	$results = $stmt->fetchAll();
    foreach ($results as $row){
	    header( "Location: https://tech-base.net/tb-230455/%E5%88%B6%E4%BD%9C%E7%89%A9%E5%86%85%E5%AE%B9.php" ) ;
	    exit ;
    }//header( "Location: https://tech-base.net/tb-230455/%E5%86%85%E5%AE%B9.html" ) ;
	//exit ;
}//ログイン完了
?>
</body>
</html>