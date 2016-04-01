<?php
/**
 * Provided a positive integer N and we have to find the sum of all the numbers K
 * where 0 < K < N and k is divisible by either 3 or 5.
 *
 * To solve the problem we can break it down into three series.
 * Sum of the multiples of 3 are:
 * S3 = 3 + 6 + 9 + ... + (N - 1)
 * S3 = 3 x (1 + 2 + 3 + ... + (N - 1) / 3)
 * So, the highest number we need for the series is (N - 1) / 3.
 * Numbers larger than that will exceed N when multiplied by 3.
 *
 * In the same way Sum fo multiples of 5 are:
 * S5 = 5 x (1 + 2 + 3 + ... + (N - 1) / 5)
 *
 * Now if N is larger than 15 then the number is divisible by both 3 and 5.
 * In that case in our final result that specific number will be counted twice.
 * So, we are going to subtract that number from the final result.
 * To do that we need another series for 15 (multiple of 3 and 5)
 * S15 = 15 x (1 + 2 + 3 + ... + (N - 1) / 15)
 *
 * Our final result will be
 * Sum = S3 + S5 - S15
 *
 * @author Ashiqur Rahman
 * @url http://ghumkumar.com
 **/

$_fp = fopen( "php://stdin", "r" );

/* Get the number of test cases */
fscanf( STDIN, "%d\n", $T );
for ( $i = 0; $i < $T; $i ++ ) {
    /* Get the number N */
    fscanf( STDIN, "%d\n", $N );

    /* Find (N - 1) / 3 */
    $one_third     = floor( bcdiv( ( $N - 1 ), 3 ) );
    /* Find (N - 1) / 5 */
    $one_fifth     = floor( bcdiv( ( $N - 1 ), 5 ) );
    /* Find (N - 1) / 15 */
    $one_fifteenth = floor( bcdiv( ( $N - 1 ), 15 ) );

    $var   = 0;

    /**
     * We use the equation of arithmetic progression sum and also bitwise right shift to divide by two.
     * This is helpful to get results in case of large numbers.
     * https://en.wikipedia.org/wiki/Arithmetic_progression
     */

    /* S3 */
    $sum_3 = bcmul( 3, ( bcmul( $one_third, bcadd( $one_third, 1 ) ) >> 1 ) );
    /* S5 */
    $sum_5 = bcmul( 5, ( bcmul( $one_fifth, bcadd( $one_fifth, 1 ) ) >> 1 ) );

    if ( $N <= 15 ) {
        $var = bcadd( $sum_3, $sum_5 );
    } else {
        /* S15 */
        $sum_15 = bcmul( 15, ( bcmul( $one_fifteenth, bcadd( $one_fifteenth, 1 ) ) >> 1 ) );
        $var    = bcsub( bcadd( $sum_3, $sum_5 ), $sum_15 );
    }
    echo $var . PHP_EOL;
}
