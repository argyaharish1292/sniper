<?php

function createFeature () {
    $feature = new stdClass();
    $feature->type = 'Feature';
    $feature->properties = new stdClass();
    $feature->geometry = new stdClass();
    $feature->geometry->type = 'Point';
    $feature->geometry->coordinates = array();
    return $feature;
}

function createCollection () {
    $collection = new stdClass();
    $collection->type = 'FeatureCollection';
    $collection->features = array();
    return $collection;
}
?>