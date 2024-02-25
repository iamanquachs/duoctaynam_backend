<?php
$filename = 'mail';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'send_mail':
        require('send_mail.php');
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
