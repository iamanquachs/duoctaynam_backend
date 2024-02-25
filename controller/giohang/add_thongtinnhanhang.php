<?php
$data = json_decode(file_get_contents('php://input'), true);
$ktr = $db->listthongtinnhanhang($data['msdv']);
$chinh = 0;
$tuoino = 0;
$dinhmucno = 0;
if (count($ktr) == 0) {
    $trangthaiadd = 1;
    $list = $db->add_thongtinnhanhang($data['msdv'], $data['tenkhachhang'], $data['masonguoinhan'], $data['hotennguoinhan'], $data['sodienthoai'], $data['diachi'], $data['tinh'], $data['huyen'], $data['xa'], $data['maxa'], $trangthaiadd, $chinh, $tuoino, $dinhmucno);
} else {
    $trangthaiadd = 0;
    $list = $db->add_thongtinnhanhang($data['msdv'], $data['tenkhachhang'], $data['masonguoinhan'], $data['hotennguoinhan'], $data['sodienthoai'], $data['diachi'], $data['tinh'], $data['huyen'], $data['xa'], $data['maxa'], $trangthaiadd, $chinh, $tuoino, $dinhmucno);
}
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");

echo json_encode($list) . "\n";
