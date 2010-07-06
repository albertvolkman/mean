<?php

function data_range ($datapoints) {
	$range = array();
	
	$count = count($datapoints);
	
	for ($i=1; $i <= $count; $i++) {
		$x = $datapoints[$i] - $datapoints[$i-1];
		if ($x < 0) {
			$x = $x - ($x * 2);
		}
	
		$range[] = $x;
	}

	return $range;
}

$datapoints = array(80,20,60,-100,40,-20,0,-80,80,-40,80);
print_r(data_range($datapoints));

?>
