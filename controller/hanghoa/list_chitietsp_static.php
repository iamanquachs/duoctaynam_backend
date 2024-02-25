<?php
$data = json_decode(file_get_contents('php://input'), true);
$CurPageURL =  $_SERVER['REQUEST_URI'];
$query = explode("?", $CurPageURL)[1];
$tenhh = explode('=', $query)[1];
$url = explode('.', $tenhh)[0];
$list = $db->list_chitietsp($url);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($list) . "\n";
