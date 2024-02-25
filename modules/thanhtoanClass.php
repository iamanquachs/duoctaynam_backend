<?php

class ThanhToan extends database
{
    //todo thanh toán update line = 1
    public function update_line_1($msdn, $soct, $rowid)
    {
        $getall = $this->connect->prepare("UPDATE dathangline set  soct = '$soct' where msdn = '$msdn' and rowid = '$rowid'");
        $getall->execute();
    }
    //todo sau khi dathang add dathangheader
    public function dathangheader_add($msdv, $msdn, $mskh, $tenkhachhang, $tendaidien, $dienthoai, $diachi, $soct, $mavoucher, $sotienvoucher, $thanhtienvat)
    {
        $getall = $this->connect->prepare("INSERT INTO dathangheader(lastmodify,msdv,msdn,mskh, tenkhachhang, tendaidien, dienthoai, diachi, ngay,soct , mavoucher, sotienvoucher,tongcongvat,trangthaidonhang)
       VALUES (NOW(),'$msdv','$msdn','$mskh', '$tenkhachhang', '$tendaidien', '$dienthoai', '$diachi', CURRENT_DATE,'$soct','$mavoucher','$sotienvoucher','$thanhtienvat','0')");
        $getall->execute();
    }
    public function dathangline_add_voucher($msdv, $msdn,  $soct, $mavoucher, $sotienvoucher, $tenvoucher, $loai)
    {
        $getall = $this->connect->prepare("INSERT INTO dathangline(rowid_tonkho,lastmodify,msdv, msdn,ngay,soct, mshh, tenhh, dvt, msnpp,thuesuat,ptgiam, soluong, gianhap, giagoc,  giaban, thanhtien, thanhtienvat,time_xacnhan,loaixuat ) VALUES (0,NOW(),'$msdv', '$msdn',CURRENT_DATE,'$soct', '$mavoucher', '$tenvoucher','Lần', 'DTN',0, 0, '1', 0, 0, '-$sotienvoucher', '-$sotienvoucher', '-$sotienvoucher',now(),'$loai')");
        $getall->execute();
    }
    //todo thanh toán update trạng thái voucher = 1
    public function update_voucher($mavoucher, $mskh)
    {
        $getall = $this->connect->prepare("UPDATE hosovoucher set  trangthai = '1' where mavoucher = '$mavoucher' and mskh = '$mskh'");
        $getall->execute();
    }
    public function add_tientichluy($msdv, $msdn,  $sotien, $mskh, $soct)
    {
        $getall = $this->connect->prepare("INSERT INTO tien_tichluy(lastmodify, msdv, msdn, sotien, mskh, soct) VALUES (NOW(),'$msdv', '$msdn',  round('$sotien'), '$mskh', '$soct')
        ");
        $getall->execute();
    }
    //todo lấy thành tiền đưa vào page thanh tiền  
    public function get_thanhtien($soct)
    {
        $getall = $this->connect->prepare("SELECT tongcongvat FROM dathangheader WHERE soct='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
