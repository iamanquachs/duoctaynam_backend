<?php
$data = json_decode(file_get_contents('php://input'), true);
$db->update_dathangheader_xuatkhoheader();
$list_header = $db->listdathanghead($data['mskh'], $data['value_filter'], $data['value_tungay'], $data['value_denngay'], $data['thanhtoan'], $data['trangthai']);
$stt = 0;
$list = array();

foreach ($list_header as $r) {
    $soct = $r->soct;
    $list_line = $db->listdathangline($soct);
    $list = $list + array($stt++ => array(
        "msdn" => $r->msdn,
        "ngay" => $r->ngay,
        "soct" => $r->soct,
        "sohd" => $r->sohd,
        "tongcongvat" => $r->tongcongvat,
        "dathanhtoan" => $r->dathanhtoan,
        "trangthai" => $r->trangthai,
        "time_xacnhan" => $r->time_xacnhan,
        "time_giao" => $r->time_giao,
        "time_nhan" => $r->time_nhan,
        "time_huy" => $r->time_huy,
        "line" => $list_line
    ));
}

header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($list) . "\n";
