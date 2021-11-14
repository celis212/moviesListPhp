<?php
/**
 * created a database to be a example hoow to use PDO 
 *  STEP ONE created a data base 
 * 1.CREATE DATABASE misc;
 * 2.GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';​
 *   GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
 * 3.USE misc; 
 * 4.CREATE TABLE users (​
 *   user_id INTEGER NOT NULL AUTO_INCREMENT,​
 *   name VARCHAR(128),​
 *   email VARCHAR(128),​
 *   password VARCHAR(128),​
 *   PRIMARY KEY(user_id),​
 *   INDEX(email)​
 *   ) ENGINE=InnoDB CHARSET=utf8;
 * 5.INSERT INTO users (name,email,password) VALUES ('Chuck','csev@umich.edu','123');​
 *   INSERT INTO users (name,email,password) VALUES ('Glenn','gg@umich.edu','456');
 */

    
    // use the PDO class
    $pdo = new PDO('mysql:host=localhost;port=33008;dbname=misc', 'fred', 'zap');
    //set the "errors" folder for details
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //firts call and use a array with all the info 
    $stmt = $pdo->query("SELECT * FROM users");
    echo "<pre>\n";
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
            print_r($row);
        }
    echo "</pre>\n";

    //second way with table 
    //call most expecific info about the database
    $stmt = $pdo->query("SELECT name, email, password FROM users");  
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    echo "<pre>\n";    
        echo '<table border="1">'."\n";  
            foreach ( $rows as $row ) {  
                echo "<tr><td>";  
                echo($row['name']);  
                echo("</td><td>");  
                echo($row['email']);  
                echo("</td><td>");  
                echo($row['password']);  
                echo("</td></tr>\n");  
            }  
        echo "</table>\n"; 
    echo "</pre>\n";