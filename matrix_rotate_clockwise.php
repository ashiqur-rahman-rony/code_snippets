<?php
/****
 * This code takes an square matrix as input and rotates it clockwise by one step.
 * So, the first line will take the number of rows (N) of the matrix.
 * Next the code will expect N rows of space seperated numbers. And there should be N numbers in each row
 * Output will be the rotated matrix
 *
 * Input format:
 * > 2
 * > 1 2
 * > 3 4
 *
 * Output:
 * > 3 1
 *   4 2
 *
 ****/
 
fscanf(STDIN, "%d\n", $n);
$items = array();
$result = array();
for($i=0; $i<$n; $i++) {
    $a = trim(fgets(STDIN));
    $a = explode(' ', $a);
    $items[] = $a;
    if(sizeof($a) != $n) {
        echo 'ERROR' . "\n";
        exit;
    }
	$result[] = array_fill(0, $n, 'X');
}

if(sizeof($items) != $n) {
    echo 'ERROR' . "\n";
    exit;
}

$i = 0;
do {
	$top = $items[$i];
	$top = array_slice($top, $i, ($n - (2 * $i)));

	$right = array_column($items, ($n - $i - 1));
	$right = array_slice($right, $i, ($n - (2 * $i)));

	$bottom = $items[($n - $i - 1)];
	$bottom = array_slice($bottom, $i, ($n - (2 * $i)));

	$left = array_column($items, $i);
	$left = array_slice($left, $i, ($n - (2 * $i)));

	$top_rev = array_reverse($top);
	array_shift($top_rev);
	$top = array_reverse($top_rev);
	array_unshift($top, 'X');

	$right_rev = array_reverse($right);
	array_shift($right_rev);
	$right = array_reverse($right_rev);
	array_unshift($right, 'X');

	array_shift($bottom);
	array_push($bottom, 'X');

	array_shift($left);
	array_push($left, 'X');

	foreach($top as $k => $v) {
		if($v != 'X') {
			$result[$i][$k] = $v;
		}
	}

	foreach($bottom as $k => $v) {
		if($v != 'X') {
			$result[($n - $i -1)][$k] = $v;
		}
	}

	for($j = $i; $j < ($n - $i); $j++) {
		$v = array_shift($left);
		if($v != 'X') {
			$result[$j][$i] = $v;
		}
		$v = array_shift($right);
		if($v != 'X') {
			$result[$j][($n - $i - 1)] = $v;
		}
	}

	$i++;
} while($i < (($n / 2) - 1));

$final_result = $result;
foreach($final_result as $r => $row) {
	foreach($row as $c => $col) {
		if($col == 'X') {
			$final_result[$r][$c] = $items[$r][$c];
		}
	}
}

print_result($final_result);

function print_result($result = array()) {
	foreach ( $result as $row ) {
		foreach ( $row as $col ) {
			echo $col . ' ';
		}
		echo "\n";
	}
}
