<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->get_tim($data["mshh"]);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($list) . "\n";
