<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission5-1</title>
</head>
<body>
    <form action="" method="post">
    [投稿欄]
    <br>
    <input type="text" name="name" placeholder="名前を記入" value="<?php if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $id=$_POST["edit"];
        $password=$_POST["pass_2"];
        $sql = 'SELECT * FROM tbcomplete WHERE id=:id and password=:password';
        $stmt = $pdo->prepare($sql);                  
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();                            
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){              
                echo $row['name'];
            }//foreach
}//if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){    
     ?>">  
    <br>
    <input type="text" name="comment" placeholder="コメントを記入" value="<?php if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $id=$_POST["edit"];
        $password=$_POST["pass_2"];
        $sql = 'SELECT * FROM tbcomplete WHERE id=:id and password=:password';
        $stmt = $pdo->prepare($sql);                  
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();                   
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                echo $row['comment'];
            }//foreach
}//if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){    
     ?>">  
    <br>
    <input type="text" name="pass" placeholder="パスワードを入力" value="<?php if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $id=$_POST["edit"];
        $password=$_POST["pass_2"];
        $sql = 'SELECT * FROM tbcomplete WHERE id=:id and password=:password';
        $stmt = $pdo->prepare($sql);                
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();                           
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                echo $row['password'];
            }//foreach
}//if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){    
     ?>">  

    <button type="submit" name="submit">送信</button>
    <br>
    <input type="hidden" name="edit_2" value="<?php if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $id=$_POST["edit"];
        $password=$_POST["pass_2"];
        $sql = 'SELECT * FROM tbcomplete WHERE id=:id and password=:password';
        $stmt = $pdo->prepare($sql);                 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();                           
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                echo $row['id'];
            }//foreach
}//if(!empty($_POST["edit"]) and !empty($_POST["pass_2"])){    
     ?>">      
    <br>
    [削除欄]
    <br>
    <input type="number" name="delet" placeholder="削除する番号を記入">
    <br>
    <input type="text" name="pass_1" placeholder="パスワードを入力">
    <button type="submit" name="submit">削除</button>
    <br>
    <br>    
    [編集欄]
    <br>
    <input type="number" name="edit" placeholder="編集する番号を入力">
    <br>
    <input type="text" name="pass_2" placeholder="パスワードを入力">
    <button type="submit" name="submit">編集</button>
    <br>
    <br>
    </form> 
    
<?php
//データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));    

//テーブルの作成
$sql = "CREATE TABLE IF NOT EXISTS tbcomplete"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date TEXT,"
    . "password char(32)"
    .");";
    $stmt = $pdo->query($sql);

//投稿機能 パスワード無し
if(!empty($_POST["name"]) and !empty($_POST["comment"]) and empty($_POST["pass"]) and empty($_POST["edit_2"])){
    $name=$_POST["name"];
    $comment=$_POST["comment"];
    $password=$_POST["pass"];
    $sql = $pdo -> prepare("INSERT INTO tbcomplete (name, comment, date, password) VALUES (:name, :comment, :date, :password)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $name = $name;
    $comment = $comment;
    $password = $password;
    $date=date("Y年m月d日 H時i分s秒");
    $sql -> execute();
}//if(!empty)
    
//新規投稿 パスワード在りの場合    
if(!empty($_POST["name"]) and !empty($_POST["comment"]) and !empty($_POST["pass"]) and empty($_POST["edit_2"])){
    $name=$_POST["name"];
    $comment=$_POST["comment"];
    $password=$_POST["pass"];
    $sql = $pdo -> prepare("INSERT INTO tbcomplete (name, comment, date, password) VALUES (:name, :comment, :date, :password)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $name = $name;
    $comment = $comment;
    $password = $password;
    $date=date("Y年m月d日 H時i分s秒");
    $sql -> execute();
}//hidden空終    

//編集機能 passwordも変更する場合
if(!empty($_POST["name"]) and !empty($_POST["comment"]) and !empty($_POST["pass"]) and !empty($_POST["edit_2"])){
    $id = $_POST["edit_2"]; //変更する投稿番号
    $password=$_POST["pass"];
    $name = $_POST["name"];
    $comment = $_POST["comment"]; 
    $sql = 'UPDATE tbcomplete SET name=:name,comment=:comment,password=:password WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}//if(!empty($_POST["name"]) and !empty($_POST["comment"]))終

//passwordを消して投稿を消せなくする場合
if(!empty($_POST["name"]) and !empty($_POST["comment"]) and empty($_POST["pass"]) and !empty($_POST["edit_2"])){
    $id = $_POST["edit_2"]; //変更する投稿番号
    $password=$_POST["pass"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $sql = 'UPDATE tbcomplete SET name=:name,comment=:comment,password=:password WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}//if(!empty($_POST["name"]) and !empty($_POST["comment"]))終
//投稿機能終る

//削除作業
    if(!empty($_POST["delet"]) and !empty($_POST["pass_1"])){
    $id = $_POST["delet"];
    $password=$_POST["pass_1"];
    $sql = 'delete from tbcomplete where id=:id and password=:password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
}//削除機能完成

//投稿表示
$sql = 'SELECT * FROM tbcomplete';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].'<br>';
    echo "<hr>";
}
?>
</body>
</html>
