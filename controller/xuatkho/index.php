<?php
require('modules/xuatkhoClass.php');
$db = new XuatKho();
$filename = 'xuatkho';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'listxuatkho':
        require('listxuatkho.php');
        break;
    case 'add':
        require('add.php');
        break;
    case 'edit':
        require('edit.php');
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
