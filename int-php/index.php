<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesar Celis PHP</title>
</head>
<body>
    <h1>Cesar Celis PHP</h1>
    <p>
        <pre>ASCII ART:

            ***********
            **       **
            **
            **
            **
            **       **
            ***********
        </pre>
    </p>
    <?php 
        echo "The SHA256 hash of \"Cesar Celis\" is ", hash('sha256', 'Cesar Celis')."\n";
    ?>
    <p>
    <a href="/int-php/fail.php">fail link</a><br>
    <a href="/int-php/check.php">check link</a>
    </p>
</body>
</html>