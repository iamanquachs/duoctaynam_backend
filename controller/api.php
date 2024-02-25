<?php
$filename = 'api';
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
require('includes/jwt.php');
require('modules/userClass.php');
$db = new User();
$authorization = apache_request_headers();
try {
    $token = str_replace('bearer ', '', $authorization['Authorization']);
    //giải mã nè
    $token = str_replace('.', '$', $token);
    $token = str_replace('O', '.', $token);
    $token = str_replace('$', 'O', $token);
    $json_authorization = JWT::decode($token, sha1('TPS@1719'), true);
    $data_encode =  json_encode($json_authorization);
    $data_decode = json_decode($data_encode);
    $msdv = $data_decode->msdv;
    $msdn = $data_decode->msdn;
    $sl_user = $db->check_user_again($msdv, $msdn);
    if (count($sl_user) === 1) {
        switch ($_GET['action']) {
            case 'user':
                require("user.php");
                break;
            case 'danhmuc':
                require("danhmuc.php");
                break;
            case 'sanpham':
                require("sanpham.php");
                break;
            default:
                break;
        }
    } else {
        header('Content-Type: application/json');
        $result = array(
            "code" => 401
        );
        header("HTTP/1.0 401 Unauthorized");
        echo json_encode($result) . "\n";
    }
} catch (\Throwable $th) {
    header('Content-Type: application/json');
    $result = array(
        "code" => 401
    );
    header("HTTP/1.0 401 Unauthorized");
    echo json_encode($result) . "\n";
}
