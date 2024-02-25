<?php
$filename = 'check_sdt_egpp';
$data = json_decode(file_get_contents('php://input'), true);
$token = $data['token'];
//giải mã nè
$token = str_replace('.', '$', $token);
$token = str_replace('O', '.', $token);
$token = str_replace('$', 'O', $token);
$json_authorization = JWT::decode($token, sha1('TPS@1719'), true);
$data_encode =  json_encode($json_authorization);
$data_decode = json_decode($data_encode);
$msdv = $data_decode->msdv;
$msdn = $data_decode->msdn;
$tendv = $data_decode->tendv;
$dienthoai = $data_decode->dienthoai;
$tendaidien = $data_decode->tendaidien;
$diachi = $data_decode->diachi;
$msxa = $data_decode->msxa;


$token = array();
$token['msdv'] = $msdv;
$token['msdn'] = $msdn;
$token["tendv"] = $tendv;
$token["diachi"] = $diachi;
$token["msxa"] = $msxa;
$token["expired"] = time() + (60 * 60 * 24 * 365);
$jsonwebtoken = JWT::encode($token, sha1('TPS@1719'));

//mã hóa nè
$b = str_replace('O', '$', $jsonwebtoken);
$b = str_replace('.', 'O', $b);
$b = str_replace('$', '.', $b);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
$result = array(
    "code" => 200,
    'token' => $b,
    "msdv" => $msdv,
    "msdn" => $msdn,
    "tendv" => $tendv,
    "dienthoai" => $dienthoai,
    "tendaidien" => $tendaidien,
    "diachi" => $diachi,
    "msxa" => $msxa,
);
echo json_encode($result) . "\n";
