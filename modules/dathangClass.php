<?php

class DatHang extends database
{
    public function dathangline_add($msdv, $msdn, $mshh, $tenhh, $dvt, $msnpp, $thuesuat, $soluong,  $gianhap, $mshhnpp, $pttichluy, $giaban, $ptgiam, $msctkm)
    {


        $getall = $this->connect->prepare("INSERT INTO dathangline(rowid_tonkho,lastmodify,msdv, msdn,ngay, mshh, tenhh, 
        dvt, msnpp,thuesuat,ptgiam,msctkm, soluong, gianhap, giagoc,
        giaban, thanhtien, thanhtienvat,
        time_xacnhan,mshhnpp, pttichluy )
        VALUE( 0,NOW(),'$msdv', '$msdn',CURRENT_DATE, '$mshh', '$tenhh',
        '$dvt', '$msnpp','$thuesuat', $ptgiam, '$msctkm', $soluong, '$gianhap', $giaban,
        $giaban - ($giaban * $ptgiam / 100 ), 
        ($soluong * ($giaban - ($giaban * $ptgiam / 100 ))), 
        ($soluong * ($giaban - ($giaban * $ptgiam / 100 ))), 
        '', '$mshhnpp', '$pttichluy')
        ");
        $getall->execute();
    }
    public function ktr_giaban($mshh, $soluong)
    {
        $getall = $this->connect->prepare("SELECT ifnull( if($soluong > (select sl_banden FROM hoso_giaban WHERE mshh='$mshh' AND khoa = 0 ORDER BY sl_banden DESC LIMIT 1),
        (select giabanvat FROM hoso_giaban WHERE mshh='$mshh' AND khoa = 0 ORDER BY sl_banden DESC LIMIT 1) ,
        (select giabanvat FROM hoso_giaban WHERE mshh='$mshh' AND khoa = 0 AND $soluong BETWEEN sl_bantu AND sl_banden) 
        ) , 0) AS giaban
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function dathangline_delete($rowid, $msdn)
    {
        $getall = $this->connect->prepare("DELETE FROM  dathangline WHERE rowid ='$rowid' ");
        $getall->execute();
    }
    public function list_kt_mshh_dathangline($msdn, $mshh)
    {
        $getall = $this->connect->prepare("SELECT soluong FROM dathangline WHERE msdn='$msdn' and mshh='$mshh' AND trangthaidonhang=0 and soct=''");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Update số lượng trong giỏ hàng
    public function update_dathangline($msdn, $mshh, $soluong, $giaban,  $ptgiam)
    {
        $getall = $this->connect->prepare("UPDATE dathangline a 
         SET a.lastmodify=NOW(), a.ngay= CURRENT_DATE, a.soluong = '$soluong' ,a.giagoc= $giaban,a.ptgiam='$ptgiam', a.giaban=$giaban - ($giaban * $ptgiam / 100 ),
          a.thanhtien= ($soluong * ($giaban - ($giaban * $ptgiam / 100 ))),
         a.thanhtienvat=($soluong * ($giaban - ($giaban * $ptgiam / 100 )))
         WHERE a.msdn='$msdn' AND a.mshh='$mshh' 
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
    }
    //Update đã thanh toán từ xuatlkho qua dathang
    public function update_dathangheader_xuatkhoheader()
    {
        $getall = $this->connect->prepare("UPDATE dathangheader a INNER JOIN xuatkhoheader b ON a.soct=b.soctdh SET a.dathanhtoan = b.dathanhtoan, a.loaithanhtoan = b.nganquy, a.mathamchieutt=b.sophieuthu;");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
    }
    public function listdathanghead($mskh, $value_filter, $value_tungay, $value_denngay, $thanhtoan, $trangthai)
    {
        $filter = '';
        if ($value_filter != '') {
            $filter = $filter . "and sohd like '%$value_filter%'";
        }
        if ($thanhtoan == '0') {
            $filter = $filter . "and tongcongvat = dathanhtoan ";
        }
        if ($thanhtoan == '1') {
            $filter = $filter . "and tongcongvat > dathanhtoan";
        }
        if ($trangthai != '') {
            $filter = $filter . "and trangthaidonhang = '$trangthai'";
        }
        $getall = $this->connect->prepare("SELECT msdn, DATE_FORMAT(lastmodify, '%H:%i %d/%m/%Y')ngay , soct, sohd, tongcongvat, if(dathanhtoan = tongcongvat, 1, 0) as dathanhtoan, trangthaidonhang  AS trangthai , DATE_FORMAT(time_xacnhan, '%H:%i %d/%m/%Y')time_xacnhan, DATE_FORMAT(time_giao, '%H:%i %d/%m/%Y')time_giao, DATE_FORMAT(time_nhan, '%H:%i %d/%m/%Y')time_nhan, DATE_FORMAT(time_huy, '%H:%i %d/%m/%Y')time_huy FROM dathangheader WHERE mskh='$mskh' $filter and ngay between '$value_tungay' and '$value_denngay' order by rowid desc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function get_chuathanhtoan($mskh)
    {
        $getall = $this->connect->prepare("SELECT SUM(tongcongvat - dathanhtoan)chuathanhtoan FROM dathangheader WHERE mskh='$mskh' and trangthaidonhang < 5");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function get_chitiet_tichluy($mskh)
    {
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(a.lastmodify, '%H:%i %d/%m/%Y')ngay, b.sohd, round(a.sotien)sotien FROM tien_tichluy a INNER JOIN xuatkhoheader b ON a.soct = b.soctdh WHERE a.mskh='$mskh' order by a.rowid ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function listdathangline($soct)
    {
        $getall = $this->connect->prepare("SELECT msdn, tenhh,dvt, soct, soluong, thanhtienvat, giaban, (thanhtienvat * pttichluy / 100)tientichluy FROM dathangline WHERE soct='$soct' and loaixuat='XBB'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_chitiet_thuchi_history($soct)
    {
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(lastmodify, '%H:%i %d/%m/%Y')ngay , sotien,nganquy,msnhanvien, tennhanvien FROM thuchi WHERE soct_donhang='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_qr_thanhtoan($soct)
    {
        $getall = $this->connect->prepare("SELECT qrthanhtoan FROM xuatkhoheader WHERE soctdh='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_sct_thuchi($soct)
    {
        $getall = $this->connect->prepare("SELECT soct FROM xuatkhoheader WHERE soctdh='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function update_trangthaithanhtoan($soct)
    {
        $getall = $this->connect->prepare("UPDATE dathangheader SET trangthaithanhtoan='1' where soct='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
    }
}
