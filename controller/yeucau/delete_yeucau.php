<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->delete_yeucau($data['rowid'], $data['msdn'], $data['msdv']);
