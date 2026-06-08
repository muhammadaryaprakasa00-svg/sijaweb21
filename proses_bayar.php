<?php
include "config.php";

$id=$_POST['id'];
$metode=$_POST['metode'];

$bukti="";

/* kalau ada upload */
if(isset($_FILES['bukti']) && $_FILES['bukti']['name']!=""){

$nama=$_FILES['bukti']['name'];
$tmp=$_FILES['bukti']['tmp_name'];

move_uploaded_file($tmp,"bukti/".$nama);

$bukti=$nama;
}

/* kondisi */
if($metode=="Cash"){

mysqli_query($conn,"
UPDATE pesanan SET
metode='$metode',
pembayaran='Menunggu'
WHERE id_pesan='$id'
");

}else{

mysqli_query($conn,"
UPDATE pesanan SET
metode='$metode',
pembayaran='Menunggu Konfirmasi',
bukti='$bukti'
WHERE id_pesan='$id'
");

}

header("Location:riwayat.php");
?>