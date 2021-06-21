<?php
    $arr = [4,6,23,10,1,3];
    echo var_dump($arr);

    function check($array){
        $largest = $array[0];
        $location = 0;
        $result = false;
        for($i=0; $i<count($array);$i++){
            if($array[$i]>$largest){
                $largest = $array[$i];
                $location = $i;
            }
        }
        array_splice($array, $location, 1);
        arsort($array);
        $sum = 0;
        foreach($array as $arr){
            $mean = $arr + $sum;
            if($mean <= $largest){
                $sum = $arr + $sum;
            }
        }
        if($sum === $largest){
            $result = true;
        }
        return $result;


        //print_r($array);
        //print_r($result);
        echo "<br>";
        //echo $largest;        
    }
?>