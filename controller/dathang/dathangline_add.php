<?php
$data = json_decode(file_get_contents('php://input'), true);
$get_giaban = $db->ktr_giaban($data['mshh'], $data['soluong']);

$list = $db->dathangline_add($data['msdv'], $data['msdn'], $data['mshh'], $data['tenhh'],  $data['dvt'], $data['msnpp'], $data['thuesuat'],  $data['soluong'], $data['gianhap'], $data['mshhnpp'], $data['pttichluy'], $get_giaban[0]->giaban ,$data['ptgiam'], $data['msctkm']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($result) . "\n";
