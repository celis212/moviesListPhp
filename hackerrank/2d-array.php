
<?php
/*
 * Complete the 'hourglassSum' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts 2D_INTEGER_ARRAY arr as parameter.
 */



function hourglassSum($arr) {
    // Write your code here
    $total = 0;

    for ($j = 0; $j<count($arr)-4; $j++) {

        for ($k = 0; $k<count($arr)-4; $k++) {
            $sumOne = $arr[$j][$k] + $arr[$j][$k+1] + $arr[$j][$k+2];
            $sumOne += $arr[$j+1][$k+1];
            $sumOne += $arr[$j+2][$k] + $arr[$j+2][$k+1] + $arr[$j+2][$k+2];
            
            if ($total < $sumOne) {
                $total = $sumOne;
            }
        }
    }
    return $total;
    
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$arr = array();

for ($i = 0; $i < 6; $i++) {
    $arr_temp = rtrim(fgets(STDIN));

    $arr[] = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));
}


//var_dump($arr);
echo "\n";
echo "<pre>";
print_r($arr);
print_r(array_count_values($arr));
echo count($arr);
echo "</pre>";
echo "\n";


$result = hourglassSum($arr);
echo "este es el resultado ", $result;

fwrite($fptr, $result . "\n");

fclose($fptr);
?>
