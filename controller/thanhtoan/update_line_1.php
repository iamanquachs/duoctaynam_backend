<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->update_line_1($data['msdn'], $data['soct'], $data['rowid']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($result) . "\n";
