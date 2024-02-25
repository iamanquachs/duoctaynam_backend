<?php
$data = json_decode(file_get_contents('php://input'), true);
$list = $db->add_yeucau($data['msdv'], $data['msdn'], $data['tenhh'], $data['tenhc'], $data['hamluong'], $data['nhasx'], $data['ghichu']);
