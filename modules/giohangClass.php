<?php

class GioHang extends database
{
    public function listgiohang($msdn)
    {
        $getall = $this->connect->prepare("SELECT a.rowid,a.msdv,a.msdn,a.ngay, a.soct,a.mshh,a.tenhh, a.dvt, a.msnpp, a.soluong, a.gianhap, a.giagoc, a.giaban, a.thuesuat, a.thanhtien,
        a.thanhtienvat,a.trangthaidonhang, b.path_image,a.ptgiam,  a.spctkm
               from dathangline a INNER JOIN hosohanghoa b ON a.mshh= b.mshh  WHERE a.msdn = '$msdn' AND a.soct='' order by a.rowid desc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    public function cart_delete_all($msdn)
    {
        $getall = $this->connect->prepare("DELETE FROM  dathangline WHERE msdn ='$msdn' and soct=''");
        $getall->execute();
    }
    public function listthongtinnhanhang($msdv)
    {
        $getall = $this->connect->prepare("SELECT masonguoinhan, hotennguoinhan, sodienthoai,diachi,macdinh FROM thongtinnhanhang WHERE msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function listchitietthongtinnhanhang($masonguoinhan, $msdv)
    {
        if ($masonguoinhan == '') {
            $query = "macdinh='1'";
        } else {
            $query = "masonguoinhan='$masonguoinhan'";
        }
        $getall = $this->connect->prepare("SELECT masonguoinhan, hotennguoinhan, sodienthoai,diachi FROM thongtinnhanhang WHERE msdv='$msdv' AND $query");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_thongtinnhanhang($msdv, $tenkhachhang, $masonguoinhan, $hotennguoinhan, $sodienthoai, $diachi, $tinh, $huyen, $xa, $maxa, $trangthaiadd, $chinh, $tuoino, $dinhmucno)
    {
        if ($tinh != '') {
            $groupdiachi = "$diachi, $xa, $huyen, $tinh";
            $trangthai = $trangthaiadd;
        } else {
            $groupdiachi = "$diachi";
            $trangthai = $trangthaiadd;
        }

        $getall = $this->connect->prepare("INSERT INTO thongtinnhanhang (lastmodify,msdv,tenkhachhang, masonguoinhan, hotennguoinhan, sodienthoai, diachi,maxa, macdinh,chinh, tuoino, dinhmucno) VALUES (NOW(),'$msdv','$tenkhachhang','$masonguoinhan','$hotennguoinhan','$sodienthoai','$groupdiachi','$maxa','$trangthai','$chinh', '$tuoino', '$dinhmucno')");
        $getall->execute();
    }
    //Lấy danh mục tỉnh
    public function _Get_ListTinh()
    {
        $getall = $this->connect->prepare("SELECT matinh,tentinh  FROM dmtinh group by tentinh order by tentinh asc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy danh mục huyện
    public function _Get_ListHuyen($matinh)
    {

        $getall = $this->connect->prepare("SELECT mahuyen,tenhuyen  FROM dmtinh where matinh='$matinh' group by tenhuyen order by tenhuyen asc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy danh mục xã
    public function _Get_ListXa($mahuyen)
    {
        $getall = $this->connect->prepare("SELECT maxa,tenxa  FROM dmtinh where mahuyen='$mahuyen' group by tenxa  order by tenxa asc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy địa chỉ từ danh mục xã
    public function Load_DiaChi($maxa)
    {
        $getall = $this->connect->prepare("SELECT  tenxa,tenhuyen,tentinh  FROM dmtinh where maxa='$maxa'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy list voucher
    public function List_Voucher($mskh)
    {
        $getall = $this->connect->prepare("SELECT mavoucher, concat(tenvoucher, ', ' ,REPLACE(FORMAT(sotien,0),',','.'),', thời hạn ', DATE_FORMAT(thoihan,'%d/%m/%y')) as tenvoucher, sotien, mabaomat,loai,trangthai FROM hosovoucher where mskh='$mskh' and trangthai='0' AND thoihan >= NOW()");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy tiền tích lũy
    public function load_tien_tichluy($mskh)
    {
        $getall = $this->connect->prepare("SELECT ifnull(sum(round(sotien)) ,0)sotien from tien_tichluy where  mskh='$mskh' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Delete Thông Tin
    public function deleteThongTin($masonguoinhan)
    {
        $getall = $this->connect->prepare("DELETE FROM  thongtinnhanhang WHERE masonguoinhan='$masonguoinhan' and macdinh='0' and chinh='0'");
        $getall->execute();
    }
    //edit Thông Tin mặc định
    public function editThongTin($masonguoinhan, $msdv)
    {
        $getall = $this->connect->prepare("UPDATE  thongtinnhanhang set macdinh='0' WHERE msdv='$msdv'; UPDATE  thongtinnhanhang set macdinh='1' WHERE masonguoinhan='$masonguoinhan'");
        $getall->execute();
    }

    //! Kiểm tra hàng hóa được tặng
    public function delete_hanghoa_km($msdn)
    {
        $getall = $this->connect->prepare("DELETE FROM `dathangline` WHERE msdn = '$msdn' AND soct='' and spctkm = '1'
        ");
        $getall->execute();
    }
    //! tự động add hàng hóa khuyến mãi
    public function add_hanghoa_km($msdn)
    {
        $getall = $this->connect->prepare("INSERT INTO `dathangline`(lastmodify, `msdv`, `msdn`, `ngay`, `soct`, `mshh`, `tenhh`, `dvt`, `msnpp`, `mshhnpp`, `soluong`, `gianhap`, `giagoc`, `ptgiam`, `msctkm`, `giaban`, `thuesuat`, `thanhtien`, `thanhtienvat`, `trangthaidonhang`, `msnvxn`, `loaixuat`, `pttichluy`, `spctkm`)
        SELECT  NOW(),'', '$msdn', CURRENT_DATE(), '', a.mshh, b.tenhh, b.dvtmin, b.msnpp, b.mshhnpp, 
        FLOOR(c.soluong/a.sl_mua) * a.sl_tang as soluong,
        b.gianhapvat, d.giabanvat, a.ptgiam, a.msctkm, 
        d.giabanvat - (d.giabanvat  *a.ptgiam / 100) giaban_moi	,
        b.thuesuat, 
        (FLOOR(c.soluong/a.sl_mua) * a.sl_tang) * (d.giabanvat - (d.giabanvat *a.ptgiam / 100)) as thanhtien, 
        (FLOOR(c.soluong/a.sl_mua) * a.sl_tang) * (d.giabanvat - (d.giabanvat *a.ptgiam / 100))as thanhtienvat, '0', '', if(a.ptgiam = 100 , 'XKM' , 'XBB') loaixuat, '0','1'
        From ctkm_line a 
        INNER JOIN hosohanghoa b on a.mshh = b.mshh
        INNER JOIN dathangline c on c.mshh = a.mshh_mua and c.soluong >= a.sl_mua
        INNER JOIN hoso_giaban d on d.mshh = b.mshh  AND FLOOR(c.soluong/a.sl_mua) * a.sl_tang >= d.sl_bantu AND FLOOR(c.soluong/a.sl_mua) * a.sl_tang <= d.sl_banden
        WHERE  a.tungay <= CURRENT_DATE() AND a.denngay >= CURRENT_DATE() 
        AND a.loaikm = '2' AND c.msdn = '$msdn' and c.soct = '' and a.hieuluc='1';
        ");
        $getall->execute();
    }
}
