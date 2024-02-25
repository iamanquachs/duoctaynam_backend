<?php
$data = json_decode(file_get_contents('php://input'), true);
$diachi = $db->Load_DiaChi($data['maxa']);
foreach ($diachi as $r) {
    $tinh = $r->tentinh;
    $huyen = $r->tenhuyen;
    $xa = $r->tenxa;
}
$ktr = $db->listthongtinnhanhang($data['msdv']);
if (count($ktr) == 0 && $data['tinh'] == "" && $data['msdv'] != "") {
    //? egpp & k co line
    //todo add line
    $trangthaiadd = 1;
    $chinh = 1;
    $tuoino = 7;
    $dinhmucno = 5000000;
    $add = $db->add_thongtinnhanhang($data['msdv'], $data['tenkhachhang'], $data['masonguoinhan'], $data['hotennguoinhan'], $data['sodienthoai'], $data['diachi'], $tinh, $huyen,  $xa, $data['maxa'], $trangthaiadd, $chinh, $tuoino, $dinhmucno);
    //todo danh new
}
$list = $db->listthongtinnhanhang($data['msdv']);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");

echo json_encode($list) . "\n";
