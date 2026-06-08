<?php
session_start();
include "config.php";

$user_id = $_SESSION['id'];

/* ambil jumlah pesanan yang sudah diproses/selesai */
$q = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) as total
FROM pesanan
WHERE user_id='$user_id'
AND status!='Pending'
")
);

echo $q['total'];
?>