<?php
    require_once "pdo.php";
    //ADD NEWW INFO TO THE DATA BASE
    if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        echo("<pre>\n".$sql."\n</pre>\n");
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']));
    }
    //DELETE INFO FROM THE DATABASE
    /*if ( isset($_POST['user_id']) ) {
        $sql="DELETE FROM users WHERE user_id = :zip";
        echo "<pre>\n$sql\n</pre>\n";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip'=>$_POST['user_id']));
    }*/
    
    if ( isset($_POST['delete']) && isset($_POST['user_id']) ) {
        $sql = "DELETE FROM users WHERE user_id = :zip";
        echo "<pre>\n$sql\n</pre>\n";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['user_id']));
    }
    

    //CALL INFO FROM THE DATA BASE
    $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);