<?php
$filename = "user";
$action = '';
$action = $_GET['action2'];
switch ($action) {
    case 'info':
        $data = json_decode(file_get_contents('php://input'), true);
        $list = $db->info($data["msdv"], $data["msdn"]);
        header('Content-Type: application/json');
        header("HTTP/1.0 200 OK");
        echo json_encode($list) . "\n";
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
