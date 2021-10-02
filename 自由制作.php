<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>登録画面</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
    <h1>[新規登録]</h1>
    <p>
        <!--  文字の色、字体を変更します  -->
        <span style="color:red; font_style italic">初めてこのサイトをご利用される方は登録する必要があります。</span>
    </p>
    <input type="text" name="name" placeholder="名前を記入">  
    <br>
    <input type="text" name="adress" placeholder="メールアドレスを記入">  
    <br>
    <input type="text" name="pass" placeholder="パスワードを記入">
    <button type="submit" name="submit">送信</button>
    <br>
    <br>
    <u>*登録完了後こちらからメールを送信いたします。それを持って登録完了とさせていただきます。</u>
    <br>
    <br>
    <form action="" method="post">
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
    $dsn="データベース";
    $user="ユーザー名";
    $password="パスワード";
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
    -------------------------------------------------------------------------------------------
    <h3>頂いたコメント</h3>
<?php
$dsn="データベース";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM コメント登録';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
        echo $row['id'].',';
        echo $row['name2'].',';
        echo $row['comment2'].',';
        echo $row['commentdate'].'<br>';
    echo "<hr>";
    }
?>
    </form>
    
    
<?php
$dsn="データベース";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//新規登録
if(!empty($_POST["name"]) and !empty($_POST["adress"]) and !empty($_POST["pass"])){
    $user_name=$_POST["name"];
    $mail_adress=$_POST["adress"];
    $password=$_POST["pass"];
    $date=date("Y年m月d日 H時i分s秒");
    $sql = $pdo -> prepare("INSERT INTO 登録 (user_name, mail_adress, password, date) VALUES (:user_name, :mail_adress, :password, :date)");
    $sql -> bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $sql -> bindParam(':mail_adress', $mail_adress, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $sql -> execute();
//データベースに登録完了

//メール送信
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'setting.php';
    
    // PHPMailerのインスタンス生成
        $mail = new PHPMailer\PHPMailer\PHPMailer();
    
        $mail->isSMTP(); 
        $mail->SMTPAuth = true;
        $mail->Host = "メインのSMTPサーバー"; 
        $mail->Username = "SMTPユーザー名（メールユーザー名）"; 
        $mail->Password = "メールパスワード"; 
        $mail->SMTPSecure = "tls";
        $mail->Port = 587; // 接続するTCPポート
    
        // メール内容設定
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
        $mail->addAddress($mail_adress); //受信者（送信先）を追加する
        $mail->addReplyTo('ホストのメールユーザ名');
        $mail->addCC('CCで送るメールアドレス'); 
        $mail->addBcc('BCCで送るメールアドレス'); 
        $mail->Subject = "メールタイトル"; 
        $mail->isHTML(true);   
        $body =
        //メールの内容
        "ご登録いただきありがとうございます。.<br>
        登録が完了いたしましたことを再度お知らせいたします。<br>
        引き続きログインされる方はこちらからでも可能です。<br>
        制作物のURL. <br>";

        $mail->Body  = $body;
        // メール送信の実行
        if(!$mail->send()) {
        	echo 'メッセージは送られませんでした！';
        	echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
        	echo '送信完了！';
        }
}//if(empty)
    //新規登録、メール送信完了
    
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
	    header( "Location: 制作物のURL" ) ;
	    exit ;
    }//header	//exit ;
}//ログイン完了
?>
</body>
</html>
