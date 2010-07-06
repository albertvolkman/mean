<?php

class rangeFinder {
	public $datapoints = array();
	public $range = array();
	public $final = array();

	function __construct($datapoints) {
		$this->datapoints = $datapoints;
	}

	function find() {
		$this->data_range();
		$this->smaller_range();
	}

	function data_range () {
		$range = array();
		
		$count = count($this->datapoints);
		
		for ($i=1; $i < $count; $i++) {
			$x = $this->datapoints[$i] - $this->datapoints[$i-1];
			if ($x < 0) {
				$x = $x - ($x * 2);
			}
		
			$this->range[] = $x;
		}
	}
	
	function smaller_range() {
		$prior = '';
		foreach ($this->range as $key=>$data) {
			if($prior && $prior <= $data) {
				echo "x = [" . implode(' ', $this->datapoints) . "]\n";
				echo "r = [" . implode(' ', $this->range) . "]\n";
				echo "Deleting: " . $this->datapoints[$key] . " & " . $this->datapoints[$key - 1] . "\n";
				$item['range'] = $prior;
				$item['mean'] = ($this->datapoints[$key] - $this->datapoints[$key - 1]) / 2;
				echo "Range: " . $prior . "\n";
				echo "Mean: " . $item['mean'] . "\n\n";
				$this->final[] = $item;
				unset($this->datapoints[$key]);
				unset($this->datapoints[$key - 1]);
				$this->datapoints = array_values($this->datapoints);
				break;
			}
		
			$prior = $data;
		}

		$this->range = array();
	}
}

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
