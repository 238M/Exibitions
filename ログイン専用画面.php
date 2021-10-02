<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン専用画面</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
    <h2>[ログイン]</h2>
    <br>
    <input type="text" name="name_1" placeholder="名前を記入">  
    <br>
    <input type="text" name="pass_1" placeholder="パスワードを記入">
    <button type="submit" name="submit" >送信</button>
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
    <br>
    <input type="text" name="adress_2" placeholder="メールアドレスを記入">
    <button type="submit" name="submit" >送信</button>
    <br>
    <br>
    <?php
    if(!empty($_POST["name_2"]) and !empty($_POST["adress_2"])){
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $user_name=$_POST["name_2"];
    $mail_adress=$_POST["adress_2"];
    $sql="select * from 登録 where user_name=:user_name and mail_adress=:mail_adress";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindParam(':mail_adress', $mail_adress, PDO::PARAM_STR);
	$stmt-> execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row){
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
    <br>
    <br>
    -------------------------------------------------------------------------------------------
    <h3>頂いたコメント</h3>
<?php
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM コメント登録';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
        echo $row['id'].',';
        echo $row['comment2'].',';
        echo $row['commentdate'].'<br>';
    echo "<hr>";
    }
?>
    </form>
    
    
<?php
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//ログイン
if(!empty($_POST["name_1"]) and !empty($_POST["pass_1"])){
    $user_name=$_POST["name_1"];
    $password=$_POST["pass_1"];
    $sql="select * from 登録 where user_name=:user_name and password=:password";
    $stmt = $pdo->prepare($sql);    
    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
	$stmt-> execute();
	$results = $stmt->fetchAll();
    foreach ($results as $row){
	    header( "制作物のURL" ) ;
	    exit ;
    }//header	//exit ;
}//ログイン完了
?>
</body>
</html>
