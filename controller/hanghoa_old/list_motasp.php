<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->list_motasp($data["mshh"]);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($list) . "\n";