<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->cart_delete_all($data['msdn']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($result) . "\n";
