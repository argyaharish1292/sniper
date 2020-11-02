<?php
	function createLine(){
		$line = new stdClass();
		$line->type = 'Feature';
		$line->properties = new stdClass();
		$line->geometry = new stdClass();
		$line->geometry->type = 'LineString';
		$line->geometry->coordinates = array();
		return $line;
	}
	
	function createCollectionL () {
		$collection = new stdClass();
		$collection->type = 'FeatureCollection';
		$collection->features = array();
		return $collection;
	}
?>