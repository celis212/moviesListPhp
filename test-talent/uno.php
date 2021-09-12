<?php
$word = array("baseball", "a,all,b,ball,bas,base,cat,code,d,e,quit,z");
$word2 = array("abcgefd","a,ab,abc,abcg,b,c,dog,e,efd,zzzz");

print_r (Arraychallenge($word));

function Arraychallenge($strAtrr){
    $comWord = $strAtrr[0];
    $searchs = explode(",", $strAtrr[1]); 
    print_r($searchs);
    echo"<br>";
    print_r($comWord);
    echo"<br>";
    foreach($searchs as $search){
        $numberOne = strpos($comWord,$search);//Encuentra la posición numérica de la primera ocurrencia
        if($numberOne == 0){
            $wordOne = substr($comWord, 0, strlen($search));
            $wordTwo = substr($comWord, strlen($search));
            echo $wordOne, " ",$wordTwo,"//<br>";
            for($i=0; $i<count($searchs); $i++){
                if (strcmp($searchs[$i], $wordTwo) === 0){//Devuelve < 0 si str1 es menor que str2; > 0 si str1 es mayor que str2 y 0 si son iguales. 
                    return "$wordOne".","."$wordTwo ";
                }
            }
        }
    }

    /*
    foreach($searchs as $search){
        //echo $search, " ",$comWord,"//<br>";
        if (strncmp($search, $comWord, strlen($search)) === 0){//search each word on the array in to the string based of the equal length
            $firts = substr($comWord,0,strlen($search));//separate the firts word based on the length of the word
            $second = substr($comWord,strlen($search),strlen($comWord));//separate the second word based on the rest of the comWord 
            echo $firts, " ",$second,"//<br>";
            for($i=0; $i<count($searchs); $i++){//if the second word coincidence with the search we find the 2 word  
                if (strcmp($searchs[$i], $second) === 0){
                    return "$firts".","."$second";
                }
            }
            //echo "Los strings coinciden =$search";
        } // Coinciden, ya que hol === hol
    }*/
    return "not possible";
}
?>