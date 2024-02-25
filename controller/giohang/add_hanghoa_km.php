<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->delete_hanghoa_km($data['msdn']);
$list = $db->add_hanghoa_km($data['msdn']);
