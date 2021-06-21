<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fa571e64</title>
</head>
<body>
<?php
  if ( ! isset($_GET['guess']) ) { 
    echo("Missing guess parameter");
  } else if ( strlen($_GET['guess']) < 1) {
    echo("Your guess is too short");
  } else if ( ! is_numeric($_GET['guess']) ) {
    echo("Your guess is not a number");
  } else if ( $_GET['guess'] < 35 ) {
    echo("Your guess is too low");
  } else if ( $_GET['guess'] > 35 ) {
    echo("Your guess is too high");
  } else {
    echo("Congratulations - You are right");
  }
?>
</body>
</html>