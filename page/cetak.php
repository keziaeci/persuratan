<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$id = $_GET["id"];
$srt = query("SELECT * FROM disposisi WHERE id = $id")[0];

$kpd = $srt["diteruskan_kepada"];
$guru = $srt["nama_guru"];
if($kpd == "Tidak ada"){
    $kpd = $guru;
}

$mpdf = new \Mpdf\Mpdf(['format' => [165,215]]);
$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/print.css">
  <title>Print</title>
<body>
<div class="main">
  <h3>Lembar Disposisi</h3>
 
    <div class="container">
    <hr>
      <div id="div1">
        <p>Surat Dari : '.$srt["asal_surat"].'</p>
        <p>Nomor Surat : '.$srt["nomor_surat"].'</p>
        <p>Tanggal Surat : '.date("d-m-Y", strtotime($srt["tanggal_surat"])) .'</p>
      </div>
      <div id="div2">
        <p>Diterima Tanggal : '.date("d-m-Y", strtotime($srt["tanggal_terima"])).'</p>
        <p>Nomor Agenda : '.$srt["nomor_agenda"].'</p>
        <p>Sifat : '.$srt["sifat"].'</p>
      </div>
    <hr>
    </div>
    <p id="p1">Perihal : '.$srt["perihal"].'</p>
    
    <div class="container">
    <hr>
      <div id="div1">
        <p>Diteruskan Kepada : <br>'. $kpd .'</p>
      </div>
      <div id="div2">
        <p>Dengan hormat harap : '.$srt["diperuntukan"].'</p>
      </div>
      <hr>
      <div id="div3">
        <p id="p2">Semarang, '.$srt["tanggal_ditulis"].'</p>
        <img src="../assets/img/ttd.jpg" width="200px">
      </div>
      </div>
    </div>
</div>
';

$html .= '</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Lembar Disposisi.pdf', 'I');


?>