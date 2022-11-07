<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1-07</title>
</head>
<body>

<?php
    
// DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    
//CREATE文   
    $sql = "CREATE TABLE IF NOT EXISTS table7"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);

    
    
?>

<form action="" method="post">
        <input type="text" name="form_name" placeholder="名前"><br>
        <input type="text" name="form_comment" placeholder="コメント">
        <input type="submit" name="submit"><br><br>
        
        <input type="number" name="delete" placeholder="削除番号">
        <input type="submit" name="submit" value="削除">
</form>



<?php

    if(!empty($_POST['form_name']) && !empty($_POST['form_comment'])) {
    
//INSERT    
    $sql = $pdo -> prepare("INSERT INTO table7 (name, comment) VALUES (:name, :comment)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);

    $name = $_POST['form_name'];
    $comment = $_POST['form_comment'];
    
    $sql -> execute();
    
    }
    
//DELETE
    if(!empty($_POST['delete'])){
    $dlnum = $_POST['delete'];
    
    $id = $dlnum;
    $sql = 'delete from table7 where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    }
    
//SELECT    
    $sql = 'SELECT * FROM table7';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment']. '<br>';
        echo "<hr>";
    }
    


    
?>
</body>
</html>