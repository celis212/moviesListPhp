<?php

// solicitud del parametro get
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// si el usuario pide salirse
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

// Set up the values for the game...
// 0 para piedra, 1 para papel, y 2 tijeras
$names = array('rock', 'paper', 'scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

$computer = rand(0,2); // codigo para piedra
// TODO: hace la iteracion al azar
// $computer = rand(0,2);

// esta funcion toma el registro del compuatdor y del usuario para jugar
// y devuelve empate, pierde, gana dependiendo de la jugada
// donde tu eres el humano contra la computadora
function check($computer, $human) {
    // For now this is a rock-savant checking function
    // TODO: Fix this
    if ( $human == $computer ) {
        return "Tie";
    } else if ( $human == 1 AND $computer == 0 ){
        return "You Win";
    } else if ( $human == 2 AND $computer == 1 ){
        return "You Win";
    } else if ( $human == 0 AND $computer == 2 ){
    	return "You Win";
    } else if ( $human == 2  and $computer == 0 ) {
        return "You Lose";
    } else if ( $human == 1  and $computer == 2) {
        return "You Lose";
    } else if ( $human == 0  and $computer == 1 ) {
        return "You Lose";
    }
    
    return false;
}

// mira que se hace el juego 
$result = check($computer, $human);

?>
<!DOCTYPE html>
<html>
<head>
<title>Cesar Celis 8491a034</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Rock Paper Scissors</h1>
<p>Welcome: celis212@hotmail.com</p>
<?php
if ( isset($_REQUEST['name']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    echo "</p>\n";
}
?>
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) {
    for($c=0;$c<3;$c++) {
        for($h=0;$h<3;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
</pre>
</div>
</body>
</html>