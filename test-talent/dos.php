<?php
    $ar = [3,5,-1,8,12];
    //(3,5,-1,8,12)
    //(5,7,16,1,2)
    print_r($ar);
    echo "<br>";

    function check($arr){
        $largest = $arr[0];
        $location = 0;
        $result = false;
        /**
         * find the bigeest one

         */
        for($i=0; $i<count($arr);$i++){
            if($arr[$i]>$largest){
                $largest = $arr[$i];
                $location = $i;
            }
        }

        $sum = 0;
        $mean = 0;
        
        //eliminated the biggest one
        array_splice($arr, $location, 1);
        for($j=0; $j<count($arr); $j++){
            $part = (-$j);
            $firts =  array_slice($arr, $part);
            $second = array_slice($arr, 0, $part);
            $arr = array_merge($firts, $second);

            $mean = 0;
            $sum = 0;
            foreach($arr as $array){
                $mean = $array + $sum;
                var_dump($mean);
                echo "<br>";
                if($mean <= $largest){//if the sum is no biggest that the largest
                    $sum = $array + $sum;
                }
            }

            if($sum === $largest){
                $result = true;
                break;
            }
        }
        var_dump($result);



/* one way 
        //orderer in a mayor way
        //arsort($arr);
        $sum = 0;
        $mean = 0;
        for($j=0;$j<count($arr);$j++){
            $mean = 0;
            $sum = 0;
            foreach($arr as $array){
                $mean = $array + $sum;
                echo "$mean";
                echo "<br>";
                if($mean <= $largest){//if the sum is no biggest that the largest
                    $sum = $array + $sum;
                }
            }
            //verify if we find the result 
            if($sum === $largest){
                $result = true;
                break;
            }

            //change the order of the arr
            //1
            $arr = array_reverse($arr);
            //2
            //$mean2 = $arr[0];
            //for($k=count($arr);$k>0;--$k){
            //    $temp = $arr[$k];//0=1  1=4   3  
            //    $arr[$k]=$mean2; //1=0  4=1   
            //    $mean2 = $temp;    //0=1  1=4
            //}
        }*/
        return $result;     
    }
    check($ar)
?>