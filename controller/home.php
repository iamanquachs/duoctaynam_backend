<?php
require('includes/jwt.php');
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
switch ($components) {
        //! PRIVITE
    case "api":
        require_once CONTROLS . "api.php";
        break;

        //! PUBLIC
    case "login":
        require_once CONTROLS . "user/login.php";
        break;
    case "yeucau":
        require_once CONTROLS . "yeucau/index.php";
        break;
    case "login_direct":
        require_once CONTROLS . "user/login_direct.php";
        break;
    case "check_sdt_egpp":
        require_once CONTROLS . "user/check_sdt_egpp.php";
        break;
    case "danhmuc":
        require_once CONTROLS . "danhmuc/index.php";
        break;
    case "hanghoa":
        require_once CONTROLS . "hanghoa/index.php";
        break;
    case "hangsx":
        require_once CONTROLS . "hangsx/index.php";
        break;
    case "banner":
        require_once CONTROLS . "banner/index.php";
        break;
    case "giohang":
        require_once CONTROLS . "giohang/index.php";
        break;
    case "dathang":
        require_once CONTROLS . "dathang/index.php";
        break;
    case "thanhtoan":
        require_once CONTROLS . "thanhtoan/index.php";
        break;
    case "xuatkho":
        require_once CONTROLS . "xuatkho/index.php";
        break;
    case "ecnhapxuat":
        require_once CONTROLS . "ecnhapxuat/index.php";
        break;
    case "mail":
        require_once CONTROLS . "mail/index.php";
        break;
    default:
        $filename = 'home';
        break;
}
