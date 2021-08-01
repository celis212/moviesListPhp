<?php
if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}

$failure = false;
$checkCount = true;

if(!$users){
    $users = [];
}


if ( isset($_POST['user_name']) && isset($_POST['password_name']) ) {
    for($i = 0; $i < count($users); $i++){
        if($users[$i]['username'] === $_POST['user_name']){
            $failure = 'the user username already exists, please use another username';
            $checkCount = false;
            break;
        }
    }
    if($checkCount !== false){
        $user = array(
            'username' => $_POST['user_name'],
            'password' => $_POST['password_name'],
            'number'=> $_POST['phone_number'],
            'mail'=> $_POST['email']
        );
        array_push($users, $user);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "bootstrap.php"; ?>
        <title>Created account Movie App</title>
    </head>
    <body>
        <div class="container">
            <!-- <h1>Welcome Movie Listing App</h1> -->
            <h2>Created Account</h2>
            <?php   
                if($failure !== false){
                    echo '<p style="color: red;">'.htmlentities($failure)."</p>\n";
                }
            ?>
            <div class="container-form">
                <form method="POST" >
                    <label form="name">username</label>
                    <input type="text" name="user_name" id="name" pattern="[A-Za-z]{1,}" required></br>
                    <label form="phone">phone</label>
                    <input type="text" name="phone_number" id="phone" pattern="[+0-9]{10}" size="10"><br/>    
                    
                    <label form="mail">email</label>
                    <input type="email" name="email" id="mail" required><br/>
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
        <pre>
            $_POST:
            <?php
                print_r($_POST);
            ?>
            $list:
            <?php
                print_r($user);
            ?>
        </pre>
    </body>
</html>