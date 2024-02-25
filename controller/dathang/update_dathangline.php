<?php
$data = json_decode(file_get_contents('php://input'), true);
$get_giaban = $db->ktr_giaban($data['mshh'], $data['soluong']);

$list = $db->update_dathangline($data['msdn'], $data['mshh'], $data['soluong'], $get_giaban[0]->giaban, $data['ptgiam']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($result) . "\n";
