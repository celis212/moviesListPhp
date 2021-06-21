<?php
/**
 * https://gist.github.com/tjboudreaux/1351671
 * Original Question: Largest repeated subset. Find the longest repeated subset 
 * of array elements in given array. 
 * Example Input: array('b','r','o','w','n','f','o','x','h','u','n','t','e',
 *                      'r','n','f','o','x','r','y','h','u','n') 
 * Example Output: the longest repeated subset will be array('n','f','o','x').
 *
 * Implementation: 
 **/
function longest_subset ($input = array()) {
  
  $longestSubstring = "";
  $inputString =implode("",$input);//join the array element in array
  
  if (!is_array($input)) {
    throw new InvalidArgumentException("Invalid Input Type", 1);
  }
    
  if (empty($input)) {
    throw new LengthException("Your array must contain one or more values", 1);
  }
  

    for( $i=0; $i < strlen($inputString); $i++) {
        for( $j=0; $j < strlen($inputString); $j++) {
            $length = abs($j-$i);//determinate how many character the sub string have 
            /**
            * return part of the string base
            * the length is determinate by the long between $i and the difference
            */
            $substring = substr($inputString, $i, $length);
            /**
             * find the position of the substring on a string 
             * in this case find if this substring is repeated base in the $i and the sub
             * if it does return a true
             */
            //echo strrpos($inputString,$substring),">","$i","<br>";
            $doesSubstringRepeat = strrpos($inputString,$substring) > $i;
            //echo $doesSubstringRepeat,"<br>";
            /**
             * if substring is biggest than the longest return a true 
             */
            $substringLongerThanLongest = strlen($substring) > strlen($longestSubstring);
            /**
             * if we complete both requeriment we have one longest 
             */
            if ($doesSubstringRepeat && $substringLongerThanLongest) {
                $longestSubstring = $substring;
            }
        }
        //echo "<br>";
    }
    echo $longestSubstring,"<br>";
    return strlen($longestSubstring) > 0 ? str_split($longestSubstring) : false;
}

var_dump(longest_subset(array('b','r','o','w','n','f','o','x','h','u','n','t','e','r','n','f','o','x','r','y','h','u','n')));
?>