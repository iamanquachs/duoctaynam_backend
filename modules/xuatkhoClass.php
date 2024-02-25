<?php

class XuatKho extends database
{
    public function listxuatkhoHeader($mskh, $sohd)
    {
        $getall = $this->connect->prepare("SELECT msdv,soct,ngayhd,tongcongvat,mskh,tenkhachhang FROM xuatkhoheader where mskh='$mskh' and sohd='$sohd'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function listxuatkhoLine($msdv, $soct)
    {
        $getall = $this->connect->prepare("SELECT a.lastmodify, a.mskho, a.msnpp, a.mshhnpp, a.ngay, a.soct, a.mshh, a.tenhh, a.ngaysx, a.solo, a.handung, a.gianhapvat, a.giagoc, a.ptgiam, a.giaban,
        a.thuesuat, a.thanhtien, a.thanhtienvat,a.soluong, a.dvt, b.slquydoi, b.dvt_egpp
           FROM xuatkholine a INNER JOIN hoso_giaban b ON a.mshh=b.mshh  WHERE a.msdv='$msdv' and a.soct='$soct' AND a.soluong BETWEEN b.sl_bantu AND b.sl_banden");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
