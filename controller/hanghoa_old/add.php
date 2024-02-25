<?php
$data = json_decode(file_get_contents('php://input'), true);
$add = $db->add($data['phanloai']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($add) . "\n";
