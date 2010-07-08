<?php

// Include our rangefinder class
include('rangeFinder.php');

// Instantiate new instace of rangefinder class with an array of our datapoints
$datapoints = array(80,20,60,-100,40,-20,0,-80,80,-40,80);
$range_finder = new rangeFinder($datapoints);

$range_finder->find();

// Display results
foreach ($range_finder->final as $item) {
	echo $item['datapoints'] . "\n";
	echo $item['ranges'] . "\n";

	// Display values were removing from datapoints
	echo "Deleting: " . $item['datapoint1'] . " & " . $item['datapoint2'] . "\n";

	// Display current range and mean
	echo "Range: " . $item['range'] . "\n";
	echo "Mean: " . $item['mean'] . "\n\n";
}

echo "Range\tMean\n";
foreach ($range_finder->final as $item) {
	echo $item['range'] . "\t" . $item['mean'] . "\n";
}
?>
