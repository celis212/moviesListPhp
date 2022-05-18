<?php
    /**WRONG WAY
     * if ( isset($_POST['email']) && isset($_POST['password']) ) {
        $e = $_POST['email'];
        $p = $_POST['password'];
        $sql = "SELECT name FROM users WHERE email = '$e' AND password = '$p'";
   $stmt = $pdo->query($sql);

     */

    if ( isset($_POST['email']) && isset($_POST['password'])  ) {
        echo("Handling POST data...\n");
        //:em and :pw are placeholders
        $sql = "SELECT name FROM users WHERE email = :em AND password = :pw";
        echo "<pre>\n$sql\n</pre>\n";
        $stmt = $pdo->prepare($sql);
        // get replace with the actual string
        $stmt->execute(array(
            ':em' => $_POST['email'],
            ':pw' => $_POST['password']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    var_dump($row);
    if ( $row === FALSE ) {
       echo "<h1>Login incorrect.</h1>\n";
    } else { 
       echo "<p>Login success.</p>\n";
    }
 
 ?>
 <p>Please Login</p>
 <form method="post">
 <p>Email:
 <input type="text" size="40" name="email"></p>
 <p>Password:
 <input type="text" size="40" name="password"></p>
 <p><input type="submit" value="Login"/>
 <a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
 </form>
 <p>
 Check out this 
 <a href="http://xkcd.com/327/" target="_blank">XKCD comic that is relevant</a>.
 