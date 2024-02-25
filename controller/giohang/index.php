<?php
require('modules/giohangClass.php');
$db = new GioHang();
$filename = 'giohang';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'listgiohang':
        require('list_giohang.php');
        break;
    case 'cart_delete_all':
        require('cart_delete_all.php');
        break;
    case 'listthongtinnhanhang':
        require('listthongtinnhanhang.php');
        break;
    case 'kt_thongtinnhanhang':
        require('kt_thongtinnhanhang.php');
        break;
    case 'add_thongtinnhanhang':
        require('add_thongtinnhanhang.php');
        break;
    case 'chitietthongtinnhanhang':
        require('chitietthongtinnhanhang.php');
        break;
    case 'load_danhmuc_tinh':
        require('load_danhmuc_tinh.php');
        break;
    case 'load_danhmuc_huyen':
        require('load_danhmuc_huyen.php');
        break;
    case 'load_danhmuc_xa':
        require('load_danhmuc_xa.php');
        break;
    case 'list_voucher':
        require('list_voucher.php');
        break;
    case 'load_tien_tichluy':
        require('load_tien_tichluy.php');
        break;
    case 'load_diachi':
        require('load_diachi.php');
        break;
    case 'delete_thongtin':
        require('delete_thongtin.php');
        break;
    case 'edit_thongtin':
        require('edit_thongtin.php');
        break;
    case 'add_hanghoa_km':
        require('add_hanghoa_km.php');
        break;
    case 'delete_hanghoa_km':
        require('delete_hanghoa_km.php');
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
