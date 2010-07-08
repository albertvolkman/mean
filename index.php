<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Test</title>
</head>
<body>
	<form action="index.php" method="post">
		<input type="text" name="datapoints" title="test" />
		<input type="submit" value="Submit" />	
	</form>
<?php
if ($_POST['datapoints']) {
	// Include our rangefinder class
	include('rangeFinder.php');
	
	// Instantiate new instace of rangefinder class with an array of our datapoints
	//$datapoints = array(80,20,60,-100,40,-20,0,-80,80,-40,80);
	$datapoints = explode(',', $_POST['datapoints']);
	$range_finder = new rangeFinder($datapoints);
	
	$range_finder->find();

	// Display results
	foreach ($range_finder->final as $item) {
		echo $item['datapoints'] . "<br />";
		echo $item['ranges'] . "<br />";
	
		// Display values were removing from datapoints
		echo "Deleting: " . $item['datapoint1'] . " & " . $item['datapoint2'] . "<br />";
	
		// Display current range and mean
		echo "Range: " . $item['range'] . "<br />";
		echo "Mean: " . $item['mean'] . "<br /><br />";
	}
	
	echo "<table><tr><th>Range</th><th>Mean</th></tr>";
	foreach ($range_finder->final as $item) {
		echo "<tr><td>" . $item['range'] . "</td><td>" . $item['mean'] . "</td></tr>";
	}
	echo "</table>";
}
?>

</body>
</html>
