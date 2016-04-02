<?php
/**
 * Provided a range of positive integers A and B.
 * where 0 ≤ A ≤ B < 2^32.
 * We have to find the and product of the series inclusive the boundaries.
 * 
 * In case of the series, it will come down to the two boundaries, A and B.
 * If A and B are equal, the product will be equal to that. If B is greater than A then
 * things get a little interesting.
 * It's explained in more detail here: 
 * http://yucoding.blogspot.com/2015/06/leetcode-question-bitwise-and-of.html
 *
 * @author Ashiqur Rahman
 * @url http://ghumkumar.com
 **/
 
$_fp = fopen("php://stdin", "r");

$line = trim(fgets(STDIN));
list($a, $b) = explode(' ', $line);
/* If A == B, we don't need to go any furhter */
if($a == $b) {
    echo $a . PHP_EOL;
    continue;
}
$miss_matches = 0;
while($b != $a) {
    $miss_matches += 1;
    
    /* Lowest bit didn't match. Shift one bit to the right */
    $a = $a >> 1;
    $b = $b >> 1;
}
/* All the miss matched lower bits will be 0. Left shift the number of miss matches. */

$a = $a << $miss_matches;
echo $a . PHP_EOL;
