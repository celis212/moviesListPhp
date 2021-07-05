<?php
if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "bootstrap.php"; ?>
        <title>Log in Movie App</title>
    </head>
    <body>
        <div class="container">
            <!-- <h1>Welcome Movie Listing App</h1> -->
            <h2>Please Log In</h2>
            <?php   

            ?>
             <div class="container-form">
                <form method="POST">
                    <label form="name">username</label>
                    <input type="text" name="user_name" id="name" pattern="[A-Za-z]{1,}" required></br>

                    <label form="password">password</label>
                    <input type="password" name="password_name" id="password" pattern="[a-zA-Z!@#$%^*_|]{6}" size="6" required><br/>
                    <input type="submit" value="Submit">
                    <!-- <input type="submit" name="cancel" value="Cancel"> -->
                </form>
                <form method="POST">
                    <input type="submit" name="cancel" value="Cancel">
                </form>
             </div>
        </div>
    </body>
</html>