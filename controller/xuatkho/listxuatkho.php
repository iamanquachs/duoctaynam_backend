<?php
$data = json_decode(file_get_contents('php://input'), true);
$listHeader = $db->listxuatkhoHeader($data['mskh'], $data['sohd'], $data['soct']);
foreach ($listHeader as $r) {
    $msdv = $r->msdv;
    $soct = $r->soct;
    $ngayhd = $r->ngayhd;
    $tongcongvat = $r->tongcongvat;
    $mskh = $r->mskh;
    $tenkhachhang = $r->tenkhachhang;
}
$listLine = $db->listxuatkhoLine($msdv,  $soct);
$data = '';
$data = array(
    "ngayhd" => $ngayhd,
    "tongcongvat" => $tongcongvat,
    "mskh" => $mskh,
    "tenkhachhang" => $tenkhachhang,
    "line" => $listLine
);

header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($data) . "\n";
