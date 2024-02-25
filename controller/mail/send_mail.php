<?php
require 'vendor/PHPMailer/PHPMailerAutoload.php';
$data = json_decode(file_get_contents('php://input'), true);

$hoten = $data['hoten'];
$dienthoai = $data['dienthoai'];
$ghichu = $data['ghichu'];
$loai = $data['loai'];

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'tpsoftct@gmail.com';
$mail->Password = 'ycmllwhglcvepayz';
$mail->setFrom('tpsoftct@gmail.com', 'TPSOFT');
$mail->isHTML(true);
$mail->addReplyTo('tpsoftct@gmail.com');    
$mail->CharSet = 'UTF-8';
$mail->addAddress("tpsoftct@gmail.com");
$mail->Subject = 'Yêu cầu tư vấn';
$content = <<<EOF
<html>
<body>
<div style="text-align:center">
</div>
<h3>Họ tên: $hoten</h3>
<h3>Số điện thoại: $dienthoai</h3>
<h3>Nội dung: $ghichu</h3>
<h3>Loại: $loai</h3>
</div>  
</body>
</html>
EOF;
$header = "From: tpsoftct@gmail.com \r\n";
$header .= "Content-type:text/html; charset=utf-8 \r\n";
$mail->Body = $content;
$mail->send();
