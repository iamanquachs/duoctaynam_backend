<?php

class HangSX extends database
{
    public function list($loai)
    {
        $getall = $this->connect->prepare("SELECT b.msloai,b.tenloai from hosohanghoa a inner join dmphanloai b on a.producer = b.msloai where b.phanloai = 'producer' and a.trangthai=1 GROUP BY b.msloai order by b.dieukien1 ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
