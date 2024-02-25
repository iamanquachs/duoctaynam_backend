<?php

class ECNhapXuat extends database
{
    public function ecnhapxuat_add($msdv, $tendv, $mshh, $tenhh, $tenhc, $gianhap, $slnhap,  $giaban, $slban, $msncc, $tenncc)
    {
        $getall = $this->connect->prepare("INSERT INTO `ectheodoinhapxuat`(`lastmodify`, `msdv`, `tendv`,  `mshh`, `tenhh`, `tenhc`, `gianhap`, `slnhap`, `giaban`, `slban`, `msncc`,`tenncc`) VALUES (NOW(),'$msdv', '$tendv', '$mshh', '$tenhh', '$tenhc', '$gianhap','$slnhap', '$giaban', '$slban', '$msncc', '$tenncc')");
        $getall->execute();
    }
}
