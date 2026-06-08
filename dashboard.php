<?php
session_start();
include "config.php";

if(!isset($_SESSION['username'])){
header("Location:login.php");
exit;
}

$user_id=$_SESSION['id'];
$username=$_SESSION['username'];

/* statistik */
$total=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) jml
FROM pesanan
WHERE user_id='$user_id'
")
);

$pending=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) jml
FROM pesanan
WHERE user_id='$user_id'
AND status='Pending'
")
);

$diproses=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) jml
FROM pesanan
WHERE user_id='$user_id'
AND status='Diproses'
")
);

$selesai=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) jml
FROM pesanan
WHERE user_id='$user_id'
AND status='Selesai'
")
);

/* pesanan terbaru */
$data=mysqli_query($conn,"
SELECT * FROM pesanan
WHERE user_id='$user_id'
ORDER BY id_pesan DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard User</title>

<meta name="viewport" content="width=device-width,initial-scale=1">

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

.card-box{
background:white;
padding:25px;
border-radius:25px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.top-card{
background:linear-gradient(135deg,#667eea,#764ba2);
padding:35px;
border-radius:30px;
color:white;
margin-bottom:20px;
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

<a href="#">🏠 Dashboard</a>
<a href="pesanan.php">📦 Buat Pesanan</a>
<a href="riwayat.php">🧾 Riwayat</a>
<a href="logout.php">🚪 Logout</a>

</div>

</div>

<!-- MAIN -->
<div class="main">

<div class="top-card">

<h2>Halo, <?= $username;?> 👋</h2>
<p>Selamat datang di layanan SIJAWEB</p>

</div>

<!-- STAT -->
<div class="row">

<div class="col-md-3">
<div class="card-box">
<h6>Total Pesanan</h6>
<h2><?= $total['jml'];?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h6>Pending</h6>
<h2><?= $pending['jml'];?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h6>Diproses</h6>
<h2><?= $diproses['jml'];?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h6>Selesai</h6>
<h2><?= $selesai['jml'];?></h2>
</div>
</div>

</div>

<!-- TABEL -->
<div class="row mt-4">

<div class="col-md-8">

<div class="card-box">

<h4>Pesanan Terbaru</h4>
<hr>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Jasa</th>
<th>Status</th>
</tr>

<?php while($d=mysqli_fetch_array($data)){ ?>

<tr>

<td><?= $d['id_pesan'];?></td>
<td><?= $d['jenis_jasa'];?></td>

<td>
<?php
if($d['status']=="Pending"){
echo "<span class='badge bg-danger'>Pending</span>";
}elseif($d['status']=="Diproses"){
echo "<span class='badge bg-warning'>Diproses</span>";
}else{
echo "<span class='badge bg-success'>Selesai</span>";
}
?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<!-- QUICK MENU -->
<div class="col-md-4">

<div class="card-box">

<h4>Quick Menu</h4>

<a href="pesanan.php"
class="btn btn-primary w-100 mb-3">
Pesan Jasa
</a>

<a href="riwayat.php"
class="btn btn-success w-100">
Lihat Riwayat
</a>

</div>

</div>

</div>

</div>
<script>

let lastStatus = 0;

setInterval(function(){

fetch('cek_status_user.php')
.then(res => res.text())
.then(total => {

if(total > lastStatus){

alert("🎉 Pesanan kamu sudah dikonfirmasi admin!");

/* optional sound */
let audio = new Audio('notif.mp3');
audio.play();

}

lastStatus = total;

});

},5000); // tiap 5 detik

</script>
</body>
</html>
