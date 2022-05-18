<?php require_once "database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <?php
            foreach ( $rows as $row ) {
                echo "<tr><td>";
                echo($row['user_id']);
                echo "</td><td>";
                echo($row['name']);
                echo("</td><td>");
                echo($row['email']);
                echo("</td><td>");
                echo($row['password']);
                echo("</td><td>");
                echo('<form method="post"><input type="hidden" ');
                echo('name="user_id" value="'.$row['user_id'].'">'."\n");
                echo('<input type="submit" value="Del" name="delete">');
                echo("\n</form>\n"); 
                echo("</td></tr>\n");
            }
        ?>
    </table>
    <form method="post">
        <p>Name:<input type="text" name="name" size="40"></p>
        <p>Email:<input type="text" name="email"></p>
        <p>Password:<input type="password" name="password"></p>
        <p><input type="submit" value="Add New"/></p>
    </form>
    <form action="login.php">
        <input type="submit" value="Log In"/>
    </form>
    <form action="delete.php">
        <input type="submit" value="Delete Data"/>
    </form>
</body>
</html>