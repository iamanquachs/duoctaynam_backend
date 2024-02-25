<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->Load_DiaChi($data['maxa']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");

echo json_encode($list) . "\n";
