<?php
session_start();
include "config.php";

if(!isset($_SESSION['username'])){
header("Location:login.php");
exit;
}

$user_id=$_SESSION['id'];

$data=mysqli_query($conn,"
SELECT * FROM pesanan
WHERE user_id='$user_id'
ORDER BY id_pesan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat Pesanan</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
font-family:Arial;
background:#eef2ff;
}

/* sidebar */
.sidebar{
position:fixed;
left:0;
top:0;
width:260px;
height:100%;
background:linear-gradient(180deg,#4facfe,#00c6ff);
padding:30px 20px;
box-shadow:4px 0 20px rgba(0,0,0,.1);
}

.logo{
color:white;
font-size:28px;
font-weight:bold;
text-align:center;
margin-bottom:40px;
}

.menu a{
display:block;
padding:15px;
margin-bottom:15px;
text-decoration:none;
background:rgba(255,255,255,.2);
color:white;
border-radius:15px;
font-weight:bold;
}

.menu a:hover{
background:white;
color:#2196f3;
}

/* main */
.main{
margin-left:280px;
padding:40px;
}

/* card */
.order-card{
background:white;
padding:25px;
border-radius:20px;
margin-bottom:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.badge{
padding:8px 12px;
border-radius:10px;
}

</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo">SIJAWEB</div>

<div class="menu">
<a href="dashboard.php">🏠 Dashboard</a>
<a href="pesanan.php">📦 Buat Pesanan</a>
<a href="#">🧾 Riwayat</a>
<a href="logout.php">🚪 Logout</a>
</div>

</div>

<!-- MAIN -->
<div class="main">

<h3>Riwayat Pesanan</h3>
<p>Daftar pesanan kamu</p>

<?php while($d=mysqli_fetch_array($data)){ ?>

<div class="order-card">

<h5><?= $d['jenis_jasa'];?></h5>

<p>Harga: Rp <?= number_format($d['harga']);?></p>

<p>Status:
<?php
if($d['status']=="Pending"){
echo "<span class='badge bg-danger'>Pending</span>";
}elseif($d['status']=="Diproses"){
echo "<span class='badge bg-warning'>Diproses</span>";
}else{
echo "<span class='badge bg-success'>Selesai</span>";
}
?>
</p>

<p>Pembayaran:
<?php
$p=$d['pembayaran'] ?? 'Belum Bayar';

if($p=="Belum Bayar"){
echo "<span class='badge bg-secondary'>Belum Bayar</span>";
}elseif($p=="Menunggu Konfirmasi"){
echo "<span class='badge bg-warning'>Menunggu</span>";
}else{
echo "<span class='badge bg-success'>Lunas</span>";
}
?>
</p>

<!-- tombol -->
<?php if($p=="Belum Bayar"){ ?>

<a href="pembayaran.php?id=<?= $d['id_pesan'];?>"
class="btn btn-primary mt-2">
Bayar Sekarang
</a>

<?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>