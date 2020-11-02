<?php
 //Connect to Neo4j
require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()

->addConnection('bolt', 'bolt://user:pass@0.0.0.0:7687')
//Example for HTTP connection configuration (port is optional)
->build();
?>
