<?php

class Banner extends database
{
    public function load_banner()
    {
        $getall = $this->connect->prepare("SELECT lastmodify,vitri_header, vitri, url_image, path_image, path_pdf from banner_line WHERE trangthai=0");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
