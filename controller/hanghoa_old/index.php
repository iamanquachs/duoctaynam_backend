<?php
require('modules/hanghoaClass.php');
$db = new Hanghoa();
$filename = 'hanghoa';
$action = '';
$action = $_GET['action'];
switch ($action) {
    case 'list':
        require('list.php');
        break;
    case 'listchitietsp':
        require('list_chitietsp.php');
        break;
    case 'listchitietsp_static':
        require('list_chitietsp_static.php');
        break;
    case 'list_sanphamcungnhom':
        require('list_sanphamcungnhom.php');
        break;
    case 'listtheonhom':
        require('list_hanghoa_theonhom.php');
        break;
    case 'list_hanghoa_noibat':
        require('list_hanghoa_noibat.php');
        break;
    case 'list_toanbo_hanghoa_theonhom':
        require('list_toanbo_hanghoa_theonhom.php');
        break;
    case 'listmotasp':
        require('list_motasp.php');
        break;
    case 'list_search':
        require('list_search.php');
        break;
    case 'list_filter':
        require('list_filter.php');
        break;
    case 'list_toanbo_sanpham':
        require('list_toanbo_sanpham.php');
        break;
    case 'list_hot_items':
        require('list_hot_items.php');
        break;
    case 'post_luotxem':
        require('post_luotxem.php');
        break;
    case 'get_tim':
        require('get_tim.php');
        break;
    case 'update_tim':
        require('update_tim.php');
        break;
    case 'list_all_hanghoa':
        require('list_all_hanghoa.php');
        break;
    case 'list_chitietsp_url':
        require('list_chitietsp_url.php');
        break;
    case 'load_hosogiaban':
        require('load_hosogiaban.php');
        break;
    case 'load_giaban_chitu':
        require('load_giaban_chitu.php');
        break;
    case 'delete':
        require('delete.php');
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
