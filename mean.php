<?php

include('rangeFinder.php');

$datapoints = array(80,20,60,-100,40,-20,0,-80,80,-40,80);
$range_finder = new rangeFinder($datapoints);

while(count($range_finder->datapoints) >= 3) {
	$range_finder->find();
}	

echo "Range\tMean\n";
foreach ($range_finder->final as $item) {
	echo $item['range'] . "\t" . $item['mean'] . "\n";
}
?>
