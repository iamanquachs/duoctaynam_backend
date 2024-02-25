<?php
require('modules/yeucauClass.php');
$db = new YeuCau();
$filename = 'yeucau';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'add_yeucau':
        require('add_yeucau.php');
        break;
    case 'delete_yeucau':
        require('delete_yeucau.php');
        break;
    case 'load_yeucau':
        require('load_yeucau.php');
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
