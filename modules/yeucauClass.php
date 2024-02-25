<?php

class YeuCau extends database
{
    public function add_yeucau($msdv, $msdn, $tenhh, $tenhc, $hamluong, $nhasx, $ghichu)
    {
        $getall = $this->connect->prepare("INSERT yeucauhanghoa(lastmodify, msdv, msdn, tenhh, tenhc, hamluong, nhasx, ghichu) VALUES(NOW(), '$msdv', '$msdn', '$tenhh', '$tenhc', '$hamluong', '$nhasx', '$ghichu')");
        $getall->execute();
    }
    public function load_yeucau($msdv, $msdn)
    {
        $getall = $this->connect->prepare("SELECT rowid,DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio ,`url`, url_lastmodify, tenhh, tenhc, hamluong, nhasx, ghichu from yeucauhanghoa where msdv = '$msdv' and msdn = '$msdn' order by lastmodify desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_yeucau($rowid, $msdn, $msdv)
    {
        $getall = $this->connect->prepare("DELETE FROM yeucauhanghoa where rowid='$rowid' and msdn = '$msdn' and msdv = '$msdv' ");
        $getall->execute();
    }
}
