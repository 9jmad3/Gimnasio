<?php
use Endroid\QrCode\QrCode;
$qrCode = new QrCode('http://localhost/gimnasio/index.php?c');
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();
?>