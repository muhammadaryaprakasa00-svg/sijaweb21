<?php
session_start();
include "config.php";

if(!isset($_SESSION['username'])){
header("Location:login.php");
exit;
}

$id=$_GET['id'];

$data=mysqli_fetch_array(
mysqli_query($conn,"
SELECT * FROM pesanan
WHERE id_pesan='$id'
")
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Pembayaran</title>

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
box-shadow:0 4px 20px rgba(0,0,0,.1);
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

.card-box{
background:white;
padding:30px;
border-radius:25px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
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
<a href="riwayat.php">🧾 Riwayat</a>
<a href="logout.php">🚪 Logout</a>
</div>
</div>

<!-- MAIN -->
<div class="main">

<div class="card-box">

<h3>Pembayaran</h3>
<hr>

<p><b>Jasa:</b> <?= $data['jenis_jasa'];?></p>
<p><b>Harga:</b> Rp <?= number_format($data['harga']);?></p>

<hr>

<form action="proses_bayar.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $data['id_pesan'];?>">

<!-- PILIH METODE -->
<div class="mb-3">
<label>Pilih Metode Pembayaran</label>

<select name="metode" id="metode" class="form-control" required>
<option value="">-- Pilih Metode --</option>
<option value="Cash">💵 Cash</option>
<option value="Dana">💳 Dana</option>
<option value="Gopay">📱 Gopay</option>
<option value="BCA">🏦 BCA</option>
<option value="BRI">🏦 BRI</option>
</select>
</div>

<!-- INFO -->
<div id="infoBayar" class="alert alert-info d-none"></div>

<!-- UPLOAD -->
<div class="mb-3" id="uploadBox" style="display:none;">
<label>Upload Bukti Transfer</label>
<input type="file" name="bukti" class="form-control">
</div>

<button class="btn btn-primary w-100">
Kirim Pembayaran
</button>

</form>

</div>

</div>

<!-- SCRIPT (WAJIB DI BAWAH) -->
<script>

const metode = document.getElementById("metode");
const upload = document.getElementById("uploadBox");
const info = document.getElementById("infoBayar");

metode.addEventListener("change", function(){

let m = this.value;

upload.style.display = "none";
info.classList.remove("d-none");

if(m=="Cash"){
info.innerHTML="💵 Bayar langsung ke admin saat layanan selesai.";
}
else if(m=="Dana"){
info.innerHTML="Dana: 08123456789 a/n SIJAWEB";
upload.style.display="block";
}
else if(m=="Gopay"){
info.innerHTML="Gopay: 08123456789 a/n SIJAWEB";
upload.style.display="block";
}
else if(m=="BCA"){
info.innerHTML="BCA: 123456789 a/n SIJAWEB";
upload.style.display="block";
}
else if(m=="BRI"){
info.innerHTML="BRI: 987654321 a/n SIJAWEB";
upload.style.display="block";
}

});

</script>

</body>
</html>