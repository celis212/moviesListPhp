<?php
$word = array("baseball", "a,all,b,ball,bas,base,cat,code,d,e,quit,z");
$word2 = array("abcgefd","a,ab,abc,abcg,b,c,dog,e,efd,zzzz");

print_r (Arraychallenge($word2));

function Arraychallenge($strAtrr){
    $comWord = $strAtrr[0];
    $searchs = explode(",", $strAtrr[1]); 
    print_r($searchs);
    echo"<br>";
    print_r($comWord);
    echo"<br>";

    foreach($searchs as $search){
        //echo $search, " ",$comWord,"//<br>";
        if (strncmp($search, $comWord, strlen($search)) === 0){
            $firts = substr($comWord,0,strlen($search));
            $second = substr($comWord,strlen($search),strlen($comWord));
            echo $firts, " ",$second,"//<br>";
            for($i=0; $i<count($searchs); $i++){
                if (strcmp($searchs[$i], $second) === 0){
                    return "$firts".","."$second";
                }
            }
            //echo "Los strings coinciden =$search";
        } // Coinciden, ya que hol === hol
    }
    return "not possible";
}
?>