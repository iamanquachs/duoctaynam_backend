<?php
require('modules/danhmucClass.php');
$db = new DanhMuc();
$filename = 'danhmuc';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'listdanhmuc':
        require('list_danhmuc.php');
        break;
    case 'listdanhmuc_nuocsx':
        require('list_danhmuc_nuocsx.php');
        break;
    case 'listdanhmuc_nhasx':
        require('list_danhmuc_nhasx.php');
        break;
    case 'list_danhmuc_nhom':
        require('list_danhmuc_nhom.php');
        break;
    case 'sodienthoai':
        require('sodienthoai.php');
        break;
    case 'checkMSDN':
        require('check_msdn.php');
        break;
    case 'delete':
        require('delete.php');
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
