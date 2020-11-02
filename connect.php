<?php
 //Connect to Neo4j
require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()

->addConnection('bolt', 'bolt://neo4j:rto1234@0.0.0.0:7687')
//Example for HTTP connection configuration (port is optional)
->build();
?>