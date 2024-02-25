<?php
require('modules/dathangClass.php');
$db = new DatHang();
$filename = 'dathang';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'dathangline_add':
        require('dathangline_add.php');
        break;
    case 'dathangline_delete':
        require('dathangline_delete.php');
        break;
    case 'list_kt_mshh_dathangline':
        require('list_kt_mshh_dathangline.php');
        break;
    case 'list_chitiet_thuchi_history':
        require('list_chitiet_thuchi_history.php');
        break;
    case 'load_qr_thanhtoan':
        require('load_qr_thanhtoan.php');
        break;
    case 'load_sct_thuchi':
        require('load_sct_thuchi.php');
        break;
    case 'update_trangthaithanhtoan':
        require('update_trangthaithanhtoan.php');
        break;
    case 'update_dathangline':
        require('update_dathangline.php');
        break;
    case 'listdathanghead':
        require('listdathanghead.php');
        break;
    case 'listdathangline':
        require('listdathangline.php');
        break;
    case 'get_chitiet_tichluy':
        require('get_chitiet_tichluy.php');
        break;
    case 'get_chuathanhtoan':
        require('get_chuathanhtoan.php');
        break;
    case 'delete':
        require('delete.php');
        break;
    case 'ecnhapxuat_add':
        require('ecnhapxuat_add.php');
        break;



    default:
        header('Content-Type: application/json');
        $result = array(
            "code" => 404
        );
        header("HTTP/1.0 404 NOT FOUND");
        echo json_encode($result) . "\n";
        break;
}
