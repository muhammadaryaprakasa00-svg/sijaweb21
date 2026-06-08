<?php
session_start();
include "config.php";

$user=$_SESSION['id'];

$jasa=$_POST['jasa'];
$harga=$_POST['harga'];

mysqli_query($conn,"
INSERT INTO pesanan
(
user_id,
jenis_jasa,
harga,
status,
pembayaran,
bukti
)

VALUES
(
'$user',
'$jasa',
'$harga',
'Pending',
'Belum Bayar',
''
)
");

header("Location:riwayat.php");
exit;
?>