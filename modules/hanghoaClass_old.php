<?php

class Hanghoa extends database
{

    //todo toàn bộ Sản phẩm 
    public function list_toanbo_sanpham($offset_tu, $offset_den)
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, ifnull(e.msctkm, '')msctkm, ifnull(e.tenctkm,'') tenctkm ,ifnull(e.mshh_mua, 0)mshh_mua, ifnull(e.loaikm,'')AS loaikm, a.pttichluy, a.tim_start+a.tim as tim,
					 ifnull(CONCAT((SELECT REPLACE(FORMAT(giabanvat  , 'vn_VN'),',','.')  FROM hoso_giaban WHERE mshh= a.mshh AND khoa=0  ORDER BY giabanvat LIMIT 1), ' - ', 
					 (SELECT REPLACE(FORMAT(giabanvat  , 'vn_VN'),',','.')  FROM hoso_giaban WHERE mshh= a.mshh AND khoa=0  ORDER BY giabanvat desc LIMIT 1),'/', a.dvtmin),'') AS chitu
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer' 
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 limit $offset_tu, $offset_den");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo Sản phẩm giá tốt
    public function list($groupproduct, $offset, $limit)
    {
        $msnhom_q = $limit_q = "";
        if ($groupproduct) {
            $msnhom_q = " AND a.groupproduct = '$groupproduct' ";
        }
        if ($offset) {
            $limit_q = " LIMIT $offset,$limit ";
        }
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 
					 " . $msnhom_q . $limit_q . "");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_hanghoa_noibat()
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 and a.group_sp = 1 LIMIT 10 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_all_hanghoa()
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.mshhncc,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,a.sodangky,a.tenhoatchat,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_hot_items_conlai($soluong, $mshh)
    {
        if ($mshh != "") {
            $order = '';
            $mshhNew = explode(',', $mshh);
            for ($i = 0; $i < count($mshhNew); $i++) {
                if ($mshhNew[$i] != '') {
                    $order .= " AND mshh !='" . $mshhNew[$i] . "'";
                }
            }
        } else {
            $order = '';
        }
        $getall = $this->connect->prepare("SELECT mshh FROM hosohanghoa WHERE trangthai = 1" . $order . " ORDER BY giabanmin asc LIMIT $soluong");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_hot_items($list_conlai)
    {
        if ($list_conlai > 0) {
            $order = '';
            foreach ($list_conlai as $r) {
                $order .= "," . "'" . $r->mshh . "'";
            };
        };
        $getall = $this->connect->prepare("SELECT a.mshh,a.mshhncc,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 AND a.mshh IN(" . ltrim($order, ',') . ")
					 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_sanphamcungnhom($value_msnhom, $tru_hanghoa)
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi,a.standard, a.quycach,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 AND a.groupproduct ='$value_msnhom' and a.url !='$tru_hanghoa' LIMIT 10
					 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_chitietsp($url)
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.path_image_child,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp,a.tenhoatchat,a.quycach,c.tenloai as country,a.dvtmax,a.slquydoi,a.standard,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer' 
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 and a.url='$url'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }


    public function list_chitietsp_static($url)
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.path_image_child,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp,a.tenhoatchat,a.quycach,c.tenloai as country,a.dvtmax,a.slquydoi,a.standard,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam , e.msctkm, e.tenctkm, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1 and a.url='$url'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //! List chi tiết url
    public function list_chitietsp_url()
    {
        $getall = $this->connect->prepare("SELECT `url` from hosohanghoa");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_motasp($mshh)
    {

        $getall = $this->connect->prepare("SELECT chidinh, chongchidinh, lieudung, tacdungphu, thantrong, tuongtacthuoc, baoquan from motahanghoa  where mshh='$mshh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_hanghoa_theonhom($value_msnhom)
    {

        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'   WHERE b.dieukien2 = '$value_msnhom' and a.trangthai = 1 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_toanbo_hanghoa_theonhom($value_msnhom)
    {

        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'  WHERE b.dieukien2 = '$value_msnhom' and a.trangthai = 1 order by a.giabanmin");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_search($value)
    {
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'  where a.trangthai = 1 and (a.tenhh LIKE '%$value%' or a.tenhoatchat LIKE '%$value%') order by a.tenhh");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_filter($data)
    {
        $producer = " ";
        $standard = " ";
        $country = " ";
        if (count($data['producer']) > 0) {
            $msnhasx_arr = implode(",", $data['producer']);
            $producer = " AND a.producer IN($msnhasx_arr) ";
        }
        if (count($data['standard']) > 0) {
            $tieuchuan_arr = implode(",", $data['standard']);
            $standard = " AND a.standard IN($tieuchuan_arr) ";
        }
        if (count($data['country']) > 0) {
            $nuoc_arr = implode(",", $data['country']);
            $country = " AND a.country IN($nuoc_arr) ";
        }
        if (count($data['groupproduct']) > 0) {
            $nhom_arr = implode(",", $data['groupproduct']);
            $nhom = " AND a.groupproduct IN($nhom_arr) ";
        }
        $getall = $this->connect->prepare("SELECT a.mshh,a.tenhh,a.path_image,a.url,a.url_image,a.groupproduct,a.thuesuat,a.producer,a.msnpp,a.mshhnpp, c.tenloai as country,a.dvtmax,a.slquydoi, a.quycach,a.standard,a.tenhoatchat,a.giabanmax,a.dvtmin,
        if(a.bantheodon='1',' | Bán theo đơn','') as theodon,
                a.giabanmin,a.hamluong,(a.giabanmin*a.ptgiagoc)/100+a.giabanmin as giabangoc ,d.tenloai as tennhasx,b.tenloai as tennhom,
					 ifnull(e.ptgiam ,0)ptgiam, e.msctkm, e.tenctkm , ifnull(e.mshh_mua, 0)mshh_mua, e.loaikm, a.pttichluy, a.tim_start+a.tim as tim, b.dieukien2
					 from hosohanghoa a 
					 INNER JOIN dmphanloai b ON  a.groupproduct = b.msloai and b.phanloai='groupproduct' 
					 inner join dmphanloai c on a.country = c.msloai and c.phanloai='country'
					 inner join dmphanloai d on a.producer = d.msloai  and d.phanloai='producer'  
					 left join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)  AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1'
					 WHERE a.trangthai = 1  " . $producer . $standard . $country . $nhom . "");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo post lượt xen sản phẩm
    public function post_luotxem($msdn, $ipthietbi, $thietbi, $mshh, $tim)
    {
        $getall = $this->connect->prepare("INSERT INTO luotxemsanpham(lastmodify,msdn, ipthietbi, thietbi,mshh, tim)
       VALUES (NOW(),'$msdn','$ipthietbi','$thietbi','$mshh','$tim')");
        $getall->execute();
    }
    //todo get tim
    public function get_tim($mshh)
    {
        $getall = $this->connect->prepare("SELECT tim, tim_start+tim as tim_all from hosohanghoa where mshh='$mshh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo update tim
    public function update_tim($mshh, $timnew)
    {
        $getall = $this->connect->prepare("UPDATE hosohanghoa set tim = '$timnew' WHERE mshh='$mshh'");
        $getall->execute();
    }

    //todo load giá bán chỉ từ 
    public function load_giaban_chitu($mshh)
    {
        $getall = $this->connect->prepare("SELECT if((giabanvat ) =(SELECT giabanvat  FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat desc LIMIT 1),
        CONCAT(REPLACE(FORMAT(giabanvat  , 'vn_VN'),',','.'),'/', dvt_ban ),
        CONCAT(REPLACE(FORMAT(giabanvat  , 'vn_VN'),',','.'), ' - ',(SELECT REPLACE(FORMAT(giabanvat  , 'vn_VN'),',','.') FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat desc LIMIT 1),'/', dvt_ban) 
        ) AS chitu, concat(dvt_ban,' ', slquydoi, ' ', dvt_egpp) AS quycach
        FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat LIMIT 1
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo load hosogiaban
    public function load_hosogiaban($mshh)
    {
        $getall = $this->connect->prepare("SELECT
        CONCAT(a.sl_bantu ,' - ',a.sl_banden) sl_tuden,a.sl_bantu, a.sl_banden,  a.dvt_ban, a.giabanvat - (a.giabanvat * ifnull(e.ptgiam ,0) / 100 ) as giaban, a.giabanvat as giagoc
        FROM hoso_giaban a LEFT join ctkm_line e on a.mshh = e.mshh AND CURRENT_DATE BETWEEN IFNULL( e.tungay,CURRENT_DATE)
          AND IFNULL(e.denngay, CURRENT_DATE) AND e.khoa = 0 and e.hieuluc='1' WHERE  a.mshh='$mshh' and a.khoa='0' and max = 0 ORDER BY a.giabanvat");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
