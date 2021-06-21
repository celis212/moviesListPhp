<?php
    $arr = [25,20,13,12,8,3,4,1];
    //echo var_dump($arr);

    function check($array){
        $largest = $array[0];
        $location = 0;
        $result = false;
        /**
         * find the bigeest one

         */
        for($i=0; $i<count($array);$i++){
            if($array[$i]>$largest){
                $largest = $array[$i];
                $location = $i;
            }
        }
        //eliminated the biggest one
        array_splice($array, $location, 1);
        //orderer in a mayor way
        arsort($array);
        //print_r($array);
        $sum = 0;
        $temp = 0;
        $mean2 = 0;
        for($j=0;$j<count($array);$j++){
            foreach($array as $arr){
                $mean = $arr + $sum;
                if($mean <= $largest){//if the sum is no biggest that the largest
                    $sum = $arr + $sum;
                }
            }
            //verify if we find the result 
            if($sum === $largest){
                $result = true;
                break;
            }
            //change the order of the array
            $mean2 = $array[0];
            for($k=count($array);$k>0;--$k){
                $temp = $array[$k];
                $array[$k]=$mean2;
                $mean2 = $temp;
            }
        }
        /**foreach($array as $arr){
            $mean = $arr + $sum;
            if($mean <= $largest){//if the sum is no biggest that the largest
                $sum = $arr + $sum;
            }
        }*/

        print_r($array);
        echo "<br>";
        print_r($result);
        echo "<br>";
        echo $largest; 
        echo "<br>"; 
        echo $sum; 
        echo "<br>"; 
        return $result;     
    }
    check($arr)
?>