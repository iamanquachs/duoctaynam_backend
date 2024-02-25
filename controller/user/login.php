<?php
require('modules/userClass.php');
$filename = 'login';
$db = new User();
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->dangnhap($data["user"], md5($data["pass"]));
if (count($list) === 1) {
    $token = array();
    foreach ($list as $r) {
        $token['msdv'] = $r->msdv;
        $token['msdn'] = $r->msdn;
        $token["tendv"] = $r->tendv;
        $token["expired"] = time() + (60 * 60 * 24 * 365);
    }
    $jsonwebtoken = JWT::encode($token, sha1('TPS@1719'));

    //mã hóa nè
    $b = str_replace('O', '$', $jsonwebtoken);
    $b = str_replace('.', 'O', $b);
    $b = str_replace('$', '.', $b);
    $result = array(
        "code" => 200,
        "token" => $b,
        "token_type" => "bearer",
        "expired" => $token["expired"],
        'data' => $list
    );
    header('Content-Type: application/json');
    header("HTTP/1.0 200 OK");
    echo json_encode($result) . "\n";
} else {
    $result = array(
        "code" => 401,
        "message" => "Tài khoản không tồn tại"
    );
    header('Content-Type: application/json');
    header("HTTP/1.0 401 Unauthorized");
    echo json_encode($result);
}
