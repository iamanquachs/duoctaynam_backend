<?php
require('modules/ecnhapxuatClass.php');
$db = new ECNhapXuat();
$filename = 'ecnhapxuat';
$action = '';
$action = $_GET['action'];
switch ($action) {
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
