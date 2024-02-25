<?php
require('modules/thanhtoanClass.php');
$db = new ThanhToan();
$filename = 'thanhtoan';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'update_line_1':
        require('update_line_1.php');
        break;
    case 'dathangheader_add':
        require('dathangheader_add.php');
        break;
    case 'get_thanhtien':
        require('get_thanhtien.php');
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
