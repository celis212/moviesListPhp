<?php
  if ( ! isset($_GET['testget']) ) { 
    echo("Missing guess parameter");
  } else if ( strlen($_GET['testget']) < 1) {
    echo("Your guess is too short");
  } else if ( ! is_numeric($_GET['testget']) ) {
    echo("Your guess is not a number");
  } else if ( $_GET['testget'] < 35 ) {
    echo("Your guess is too low");
  } else if ( $_GET['testget'] > 35 ) {
    echo("Your guess is too high");
  } else {
    echo("Congratulations - You are right");
  }
?>

<?php
   $oldguess = isset($_POST['testpost']) ? $_POST['testpost'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <h1>Test Talent</h1>
    <form method="GET">
        <label for="nam">Info GET</label>
        <input type="text" name="testget" id="nam"><br/>
        <input type="submit" value="Send Info"/>
    </form>
    <form method="post">
        <p><label for="guess">Info POST</label>
        <input type="text" name="testpost" size="40" id="guess" value="<?= htmlentities($oldguess) ?>"/></p>
        <input type="submit"/>
    </form>

    <pre>
        $_GET:
        <?php
        //$uno es la variable donde estamos guardando la informacion API
            $info = '';
           // $info = json_decode($uno['camino key'], true);
            print_r($_GET);
        ?>
    </pre>
    <pre>
        $_POST:
        <?php
            print_r($_POST);
        ?>
    </pre>
</body>
</html>