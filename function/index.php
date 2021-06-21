<!DOCTYPE html>
<head><title>Cesar Celis MD5 Cracker</title></head>
<body>
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.</p>
<pre>
Debug Output:
<?php
$goodtext = "Not found";
// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) {
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];

    // This is our numeric base
    $txt = "abcdefghijklmnopqrstuvwxyz";
    $number = "0123456789";
    $show = 15;

    // Outer loop go go through the number for the 
    // first position in our "possible" pre-hash
    // number
    for($i=0; $i<strlen($number); $i++ ) {
        $ch1 = $number[$i];   // The first of four characters

        // Our inner loop Not the use of new variables
        // $j and $ch2 
        for($j=0; $j<strlen($number); $j++ ) {
            $ch2 = $number[$j];  // Our second number

            // Our inner loop Not the use of new variables
            // $k and $ch3 
            for($k=0; $k<strlen($number); $k++ ) {
                $ch3 = $number[$k];  // Our third number    

                // Our inner loop Not the use of new variables
                // $j and $ch4
                for($l=0; $l<strlen($number); $l++ ) {
                    $ch4 = $number[$l];  // Our fourth number

                    // Concatenate the four numbers together to 
                    // form the "possible" pre-hash pin
                    $try = $ch1.$ch2.$ch3.$ch4;

                    // Run the hash and then check to see if we match
                    $check = hash('md5', $try);
                    if ($check == $md5 ) {
                        $goodtext = $try;
                        break;   // Exit the inner loop
                    }

                    // Debug output until $show hits 0
                    if ( $show > 0 ) {
                        print "$check $try\n";
                        $show = $show - 1;
                    }
                }
                if($goodtext == $try){
                    break;
                }
            }
            if($goodtext == $try){
                break;
            }
        }
        if($goodtext == $try){
            break;
        }
    }
    
    // Compute elapsed time
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";
}
?>
</pre>
<!-- Use the very short syntax and call htmlentities() -->
<p>Original Text: <?= htmlentities($goodtext); ?></p>
<form >
<input type="text" name="md5" size="40"/>
<input type="submit" value="Crack MD5"/>
</form>
</body>
</html>

