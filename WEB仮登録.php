<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>仮登録画面</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
    <h1>[新規登録]</h1>
    <p>
        <!--  文字の色、斜体を変更します  -->
        <span style="color:red; font_style italic">初めてこのサイトをご利用される方は登録する必要があります。</span>
    </p>
    <input type="text" name="adress" placeholder="メールアドレスを記入">  
    <button>送信</button>
    <br>
    <br>
    <u>*仮登録完了後こちらからメールを送信いたします。</u>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//新規登録
if(!empty($_POST["adress"])){
    $mail_adress=$_POST["adress"];
    $date=date("Y年m月d日 H時i分s秒");
    $sql = $pdo -> prepare("INSERT INTO 仮登録 (mail_adress, date) VALUES (:mail_adress, :date)");
    $sql -> bindParam(':mail_adress', $mail_adress, PDO::PARAM_STR);
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
    
        $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
        $mail->SMTPAuth = true;
        $mail->Host = "メールホスト名"; // メインのSMTPサーバー（メールホスト名）を指定
        $mail->Username = "メールユーザ―名"; // SMTPユーザー名（メールユーザー名）
        $mail->Password = "メールパスワード"; // SMTPパスワード（メールパスワード）
        $mail->SMTPSecure = "tls"; // TLS暗号化を有効にし、「SSL」も受け入れます
        $mail->Port = 587; // 接続するTCPポート
    
        // メール内容設定
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
        $mail->addAddress($mail_adress); //受信者（送信先）を追加する
        $mail->addReplyTo('返信先');
        $mail->addCC('ccで追加'); // CCで追加
        $mail->addBcc('bccで追加'); // BCCで追加
        $mail->Subject = "仮登録完了のお知らせ"; // メールタイトル
        $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
        $body =
        "仮登録いただきありがとうございます。.<br>
        本登録は下記のURLからお願いいたします。<br>
        https://tech-base.net/tb-230455/WEB%E6%9C%AC%E7%99%BB%E9%8C%B2.php. <br>"
        
        //ログイン画面だけのページを挿入
        ;
    
        $mail->Body  = $body; // メール本文
        // メール送信の実行
        if(!$mail->send()) {
        	echo 'メッセージは送られませんでした！';
        	echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
        	echo '送信完了！';
        }
}//if(empty)
    //メール送信完了
?>
</body>
</html>