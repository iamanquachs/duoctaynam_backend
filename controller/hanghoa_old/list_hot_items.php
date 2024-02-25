<?php
$data = json_decode(file_get_contents('php://input'), true);
$list_conlai = $db->list_hot_items_conlai($data["soluong"], $data["mshh"]);
$list = $db->list_hot_items($list_conlai);
header('Content-Type: application/json');
header("HTTP/1.0 200 OK");
echo json_encode($list) . "\n";
