<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->dathangheader_add($data['msdv'], $data['msdn'], $data['mskh'], $data['tenkhachhang'], $data['tendaidien'], $data['dienthoai'], $data['diachi'], $data['soct'], $data['mavoucher'], $data['sotienvoucher'], $data['thanhtienvat']);
if ($data['mavoucher'] != '') {
    $db->dathangline_add_voucher($data['msdv'], $data['msdn'], $data['soct'], $data['mavoucher'], $data['sotienvoucher'], $data['tenvoucher'], 'XVC');
    $db->update_voucher($data['mavoucher'], $data['mskh']);
}
if ($data['tientichluy'] > 0 && $data['loaitichluy'] === true) {
    $db->dathangline_add_voucher($data['msdv'], $data['msdn'], $data['soct'], $data['mskh'], $data['tientichluy'], 'Tiền tích lũy', 'XTL');
    $tientichluy = '-' . $data['tientichluy'];
    $db->add_tientichluy($data['msdv'], $data['msdn'], $tientichluy, $data['mskh'], $data['soct']);
}
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    "message" => "success"
);
echo json_encode($result) . "\n";
