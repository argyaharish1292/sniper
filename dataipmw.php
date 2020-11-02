<?php
    header('Content-Type: application/json');
	include 'connect.php';
    $query="MATCH (a:site)-[r:IPMW]->(b:site) WHERE a.rtp <> 'null' RETURN [[a.rtp, COUNT(r)]] as total;";
    $result=$client->run($query);
    $data = array();
    foreach ($result->records() as $record){
        $response = $record->get('total');
        foreach ($response as $row){
            $attribute =[];
            $attribute['rtp'] = $row[0];
            $attribute['total'] = $row[1];
            $data[] = $attribute;
        }
    }
    echo json_encode($data);
?>