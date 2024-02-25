<?php

class User extends database
{
    public function dangnhap($user, $pass)
    {
        $getall = $this->connect->prepare("SELECT msdv,msdn,tendv,tennguoidaidien,dienthoai,diachi,email FROM hosodonvi WHERE msdn = '$user' AND matkhau = '$pass'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function check_user_again($msdv, $msdn)
    {
        $getall = $this->connect->prepare("SELECT rowid FROM hosodonvi WHERE msdv = '$msdv' AND msdn = '$msdn'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function info($msdv, $msdn)
    {
        $getall = $this->connect->prepare("SELECT msdv,msdn,tendv,diachi,dienthoai,matkhau FROM hosodonvi WHERE msdv = '$msdv' AND msdn = '$msdn'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
