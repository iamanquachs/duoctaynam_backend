<?php

class DanhMuc extends database
{
    //lấy danh mục phân loại
    public function listdanhmuc($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai,tenloai, dieukien2 from dmphanloai where phanloai = '$phanloai' ORDER BY dieukien1;
        UPDATE ctkm_line SET hieuluc='0' WHERE hieuluc='1';
        UPDATE ctkm_line SET hieuluc = '1'  WHERE  CURDATE() BETWEEN tungay AND denngay;");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //lấy danh mục phân loại
    public function listdanhmuc_nuocsx()
    {
        $getall = $this->connect->prepare("SELECT  b.tenloai, b.msloai  FROM hosohanghoa a INNER JOIN dmphanloai b ON a.country = b.msloai where b.phanloai='country' and a.trangthai = 1 GROUP BY a.country order by b.dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //lấy danh mục phân loại
    public function listdanhmuc_nhasx()
    {
        $getall = $this->connect->prepare("SELECT  b.tenloai, b.msloai  FROM hosohanghoa a INNER JOIN dmphanloai b ON a.producer = b.msloai where b.phanloai='producer' and a.trangthai = 1 GROUP BY a.producer order by b.dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //lấy danh mục nhóm sản phẩm
    public function listdanhmuc_nhom($phanloai)
    {
        $getall = $this->connect->prepare("SELECT a.groupproduct, b.tenloai, b.msloai  FROM hosohanghoa a INNER JOIN dmphanloai b ON a.groupproduct = b.msloai where a.trangthai = 1 GROUP BY a.groupproduct order by b.dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function sodienthoai($phanloai)
    {
        $getall = $this->connect->prepare("SELECT tenloai from dmphanloai where phanloai = '$phanloai'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Check msdn khi đăng nhập bằng số điện thoại
    public function check_msdn($msdn)
    {
        $getall = $this->connect->prepare("SELECT  msdv, sodienthoai, tenkhachhang, diachi, maxa from thongtinnhanhang where sodienthoai = '$msdn' group BY sodienthoai ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
