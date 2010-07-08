<?php

class rangeFinder {
	public $datapoints = array(); // Given set of datapoints
	public $range = array(); // Derived ranges
	public $final = array(); // Final set of ranges and means

	function __construct($datapoints) {
		$this->datapoints = $datapoints;
	}

	// Execute data_range and smaller_range
	function find() {
	// Find ranges and means
		while(count($this->datapoints) >= 3) {
			$this->data_range();
			$this->smaller_range();
		}
	}

	// Determines data ranges from datapoints
	function data_range () {
		$range = array();
		
		$count = count($this->datapoints);
		
		for ($i=1; $i < $count; $i++) {
			$x = $this->datapoints[$i] - $this->datapoints[$i-1];

			// Make range an unsigned number
			if ($x < 0) {
				$x = $x - ($x * 2);
			}
		
			$this->range[] = $x;
		}
	}
	
	// Determines if previous range is smaller than the current
	function smaller_range() {
		foreach ($this->range as $key=>$data) {
			// Check to see if this isn't the first pass and if the value is less than / equal than the previous
			if($key != 0 && $this->range[$key - 1] <= $data) {
				// Display current datapoints and ranges

				// Display values were removing from datapoints
				$item['datapoints'] = "x = [" . implode(' ', $this->datapoints) . "]";
				$item['ranges'] = "r = [" . implode(' ', $this->range) . "]";
				$item['datapoint1'] = $this->datapoints[$key - 1];
				$item['datapoint2'] = $this->datapoints[$key];
				$item['range'] = $this->range[$key - 1];
				$item['mean'] = ($this->datapoints[$key] - $this->datapoints[$key - 1]) / 2;

				// Set value for final set
				$this->final[] = $item;

				// Remove relevant datapoints
				unset($this->datapoints[$key]);
				unset($this->datapoints[$key - 1]);

				// Rekey datapoints index
				$this->datapoints = array_values($this->datapoints);
				break;
			}
		}

		// Reset array
		$this->range = array();
	}
}

?>
