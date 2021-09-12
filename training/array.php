<?php
require_once('data.php');
    //print-----------------------------------------------------------------
        $input = "uno";
        var_dump($input);

        echo $input, "\n"; 

        echo "<br>";

        print $x; 
        print "\n"; 

        echo("<pre>\n"); 
        print_r($input); 
        echo("\n</pre>\n"); 

    //array----------------------------------------------------------------
        
        $learn = array('uno', 'dos', 'tres');       //created an array
        $learn[] = 'cuatro';                        //add at the end of the array 
        Array_push($learn, 'cinco', 'seis');        //add at the end of the array
        Array_unshift($learn, '-uno', 'cero');      //add at the bigging of the array

        Array_shift($learn);                        //deleted and returned the firts item 
        Array_pop($learn);                          //deleted and returned the last item   
        Unset($learn[0], $learn[2]);                //deleted based on the key 
        
        array_values($learn);                       //set the key values from the begging
         
        $learn[0] = "one";                          //changed a value based on the key

        $list = array($learn, $learn);              //created an array with two array

        sort($learn);                               //sort the values in order changing the key value
        asort($learn);                              //SORT THE VALUES IN ORDER WITHOUT CHANGED THE KEY 
        rsort($learn);                              //SORT THE VALUES IN REVERSE ORDER WITHOUT CHANGED THE KEY 
        ksort($learn);                              //Sorts the array by key

        $array = array('apellido', 'email');        //convert to string separate by a comma or nothing
        $separado_por_comas = implode(",", $array); //'apellido,email,teléfono'


        while(list($key, $val) = each($list)){     //sort: the value alphabetic 
            echo "$key => $val\n";                  //list: gave a variable name to each item on the array 
        }                                           //each: loop each item on an array 

        $input = array("red", "green", "blue", "yellow");   
        array_splice(variable, position, Num);      //Eliminated an item from array
        array_splice($input, 2);                    // red y green
        array_splice($input, 1, -1);                //red y yellow
        $numer = count($input);
        array_splice($input, 1, $numer, "orange");  //red y orange
        array_splice($input, -1, 1);                //red, green y blue

        $inputo = array("a", "b", "c", "d", "e");   //return based on the location and the number of values
        array_slice($inputo, 2);                    // returns "c", "d", and "e"
        array_slice($inputo, -2, 1);                // returns "d"
        array_slice($inputo, 0, 3);                 // returns "a", "b", and "c"

        array_merge($a, $b);                        //combine the arrays 
        array_reverse([1,2,3]);                     //REVERSE AN ARRAY
        count([1,2,3]);                             //COUNT OF ELEMENTS IN ARRAY 
        implode(",", [1,2,3]);                      //JOIN AN ARRAY '1,2,3'
        array_unique([1,2,2,3,3]);                  //Return array without similar 
        $res = max([1,2,2,3,3]);                    //Max value of array 
        Unset($learn);                              //destroy the array
        shuffle($learn);                            //ALLOW ME TO TAKE A RANDOM VALUE OF THE ARRAY MIXED IT UP  
        array_key_exists($key, $ar);                //Returns TRUE if key is set in the array
        isset($ar['key']);                          //Returns TRUE if key is set in the array
        is_array($ar);                              //Returns TRUE if a variable is an array 

        $a = array('green', 'red', 'yellow');       //[green] => avocado, [red] => apple y [yellow] => banana
        $b = array('avocado', 'apple', 'banana');
        array_combine($a, $b);                      //combine the same number of values and combine

        Array_keys($names);                         //call the key of an array

        Function print_info($value, $key){ 
            Echo "$key is a $value</br>"; 
            } 
        Array_walk($names, 'print_info');           //apply determinated function to each member of an array 

        $os = array("Mac", "NT", "Irix", "Linux");
        if (in_array("Irix", $os)) {                //verify if one element is on an array
            echo "Existe Irix";
        }

        $array = array(0 => 'azul', 1 => 'rojo', 2 => 'verde', 3 => 'rojo');
        $clave = array_search('verde', $array);     // return the key of the match

    //string--------------------------------------------------------------
        //string to array
        $str = "Hello Friend";
        str_split($str);                            // [0] => H  [1] => e  [2] => l [3] => l [4] => o  [5] =>  ...
        str_split($str, 3);                         // [0] => Hel [1] => lo [2] => Fri [3] => end
        substr('variable',1,1);                     //divide a string
        str_split($str);                            //CONVERT STRING TO ARRAY 
        strlen('variable');                         //COUNT OF CHARACTERS OF STRING 
        explode(' ', $str);                         //Divide a string to an array
        str_split(variable, number);                //Divide strings to array based on a number
        preg_split("/(\s|,\s)/", variable);  
        str_word_count(variable, 1);                //return all the words 
        strrev(".dlrow olleH");                     //reverse 
        str_repeat("Hip ", 2);                      //repeat the word 
        strtoupper("hooray!");                      //upper case
        strpos($var, '@') > -1;                      //search the word on a string
        preg_match("/uno|dos/i", $lastelement);
        str_replace("Anywhere, ","", $loc);


    //continue y break
        while ($learn) {  // <--------------------┐
            continue;     // --- vuelve aquí -----┘
            break;        // ----- salta aquí ----┐
        }
                            // <---------------------┘

    //Utilities
        abs(3.55);                                  //the absolute of a number 
        rand(0,10);                                 //pick a number randomly between a range 
        define($variable, 'Value');                 //MAKE A CONST 
        is_numeric($var);                           //confirme is numeric
        intval('42');                               //Convert a string to int 
        (int)$stringA;                              //Convert a string to int 


        $variable = '["red","green","blue"]';
        $array = json_decode($variable);  //red, green, blue

        $variable = 'a:3:{i:0;s:3:"red";i:1;s:5:"green";i:2;s:4:"blue";}';
        $array = unserialize($variable);  //red, green, blue
  
    //code repeated
        for($i=0; $i<count($list); $i++){$uno;}                            //for
        foreach($list as $item){echo $item['title']."<br />\n";}             //foreach
        foreach($list as $key => $item){echo $key.'='.$item['title']."<br />\n";}

        //EXPLODE
        $inp = "This is a sentence with seven words"; 
        $temp = explode(' ', $inp); 
        print_r($temp); 

        //IMPLODE
        $inp_two = Implode("\n", $temp); 
        Echo $inp_two;

        //TERNARY
        $www = 123; 
        $msg = $www > 100 ? "Large" : "Small" ;  
        echo "First: $msg \n"; 
        $msg = ( $www % 2 == 0 ) ? "Even" : "Odd"; 
        echo "Second: $msg \n"; 
        $msg = ( $www % 2 ) ? "Odd" : "Even"; 
        echo "Third: $msg \n"; 

        //NULL COALSECE
        $za = array(); 
        $za["name"] = "Chuck"; 
        $za["course"] = "WA4E"; 
        $name = $za['name'] ?? 'not found'; 
        $addr = $za['addr'] ?? 'not found'; 

        //function
        function howdy($lang='es') {
            if ( $lang == 'es' ) return "Hola"; 
            if ( $lang == 'fr' ) return "Bonjour"; 
            return "Hello"; 
        } 
        print howdy() . " Glenn\n"; 

        //eliminar duplicados 
            //nums = [0,0,1,1,1,2,2,3,3,4]
            //[0,1,2,3,4,_,_,_,_,_]
        /*1*/   $nums = array_unique($nums);
        /*2*/   for ($k = 0, $i = 1; $i<count($nums); $i++) {
                    if ($nums[$i] != $nums[$k]) {
                        $nums[++$k] = $nums[$i];
                    }
                }
                array_splice($nums,$k+1);

        //maxima ganancia 
            //[7,1,5,3,6,4]
            //7
                $count = 0;
                for($i=1; $i<count($prices); $i++){
                    if($prices[$i] > $prices[$i-1]){
                        $count += $prices[$i] - $prices[$i-1];
                    }
                }
                return $count;

        //rotate
            //[1,2,3,4,5,6,7], k = 3
            //[5,6,7,1,2,3,4]
                $k = $k%count($nums);
                $part = (-$k);
                $firts =  array_slice($nums, $part);
                $second = array_slice($nums, 0, $part);
                $nums = array_merge($firts, $second);

        //contien duplicados 
            //nums = [1,2,3,1]
            //true
                $validate = [];
                foreach($nums as $num){
                    if(isset($validate[$num])){
                        $validate[$num] += 1;
                        return true;
                    } else{
                        $validate[$num] = 1; 
                    }
                }

        //numero unico
            //nums = [2,2,1]
            //1
                sort($nums);
                for($i=0; $i<count($nums); $i++){
                    //echo $nums[$i];
                    if($nums[$i]!=$nums[$i+1]){
                        return $nums[$i];
                    }
                    $i++;
                }

        //interseccion entre dos array
            //nums1 = [1,2,2,1], nums2 = [2,2]
            //[2,2]
            /*1*/   sort($nums1);
                    sort($nums2);
                    $result = [];
                    for($i=0, $j=0; $i<count($nums1) && $j<count($nums2); $i++, $j++){
                        if($nums1[$i]<$nums2[$j]){
                            $j--;
                        }else if($nums1[$i]>$nums2[$j]){
                            $i--;
                        }else{
                            $result[] = $nums1[$i];
                        }
                    }
                    return $result;
            /*2*/   $arrShort = [];
                    $arrLong = [];
                    $arrAnswer = [];
                    if(count($nums1)>count($nums2)){
                        $arrLong = $nums1;
                        $arrShort = $nums2;
                    }else{
                        $arrLong = $nums2;
                        $arrShort = $nums1;
                    }
                    foreach($arrShort as $num){
                        $temp = in_array($num, $arrLong) ? array_search($num, $arrLong) : -1;
                        if($temp>=0){
                            $arrAnswer[] = $arrLong[$temp];
                            $arrLong[$temp] = -1;
                        }
                    }
                    return $arrAnswer;

        //sumando uno
            //[1,2,3]
            //[1,2,4]
                if($digits[0]!==0){
                    $stringA = implode($digits);
                    $stringA = (int)$stringA;
                    $stringA = $stringA+1;
                    $digits = str_split($stringA);
                }else{
                    $digits[0]=1;
                }
                return $digits;
                    
        //moviendo los zeros 
            //[0,1,0,3,12]
            //[1,3,12,0,0]
                $count = count($nums);
                $beginCount = 0;
                for($i=0; $i<$count; $i++){
                    if($nums[$i]!==0){
                        $nums[$beginCount++] = $nums[$i];
                    }
                }
                while($beginCount<$count){
                    $nums[$beginCount++] = 0;
                }

        //sumando para un objetivo 
            //[2,7,11,15], target = 9 
            //[0,1]
            $result = [];
            for($i=0; $i<count($nums); $i++){
                for($j=$i+1; $j<count($nums); $j++){
                    if($nums[$i]+$nums[$j]===$target){
                        array_push($result, $i); 
                        array_push($result, $j); 
                        return $result;
                    }
                }
            }
                
