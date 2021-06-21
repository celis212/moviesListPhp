<h1>hello from web page</h1>
<p>
<?php 
echo "Hi, there \n";
$x = 6 * 7;
echo "the answer is $x what was the question \n";
$y = 12;
$z = 12 + $y++;
//$y = $y + 1;
echo "the value of \$y is $y and \$z is equal to $z \n";

$array = array(1,2,3);

echo $array."\n"; //<----only print the data type

var_dump($array) //<-----print the complete structure

?>
</p>
<p>Another paragraph</p>