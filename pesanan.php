<?php
session_start();
include "config.php";

if(!isset($_SESSION['username'])){
header("Location:login.php");
exit;
}

/* ambil layanan */
$layanan=mysqli_query($conn,"SELECT * FROM layanan");
?>

<!DOCTYPE html>
<html>
<head>
<title>Buat Pesanan</title>

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

.card-box{
background:white;
padding:30px;
border-radius:25px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.form-control{
height:55px;
border-radius:15px;
}

.btn{
height:50px;
border-radius:15px;
}

</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo">SIJAWEB</div>

<div class="menu">
<a href="dashboard.php">🏠 Dashboard</a>
<a href="#">📦 Buat Pesanan</a>
<a href="riwayat.php">🧾 Riwayat</a>
<a href="logout.php">🚪 Logout</a>
</div>

</div>

<!-- MAIN -->
<div class="main">

<div class="card-box">

<h3>Buat Pesanan</h3>
<p>Pilih layanan yang kamu butuhkan</p>
<hr>

<form action="proses_pesan.php" method="POST">

<!-- pilih jasa -->
<div class="mb-3">

<label>Pilih Layanan</label>

<select
name="jasa"
class="form-control"
id="jasa"
required
>

<option value="">-- Pilih Layanan --</option>

<?php while($d=mysqli_fetch_array($layanan)){ ?>

<option
value="<?= $d['nama_jasa'];?>"
data-harga="<?= $d['harga'];?>"
>
<?= $d['nama_jasa'];?> - Rp <?= $d['harga'];?>
</option>

<?php } ?>

</select>

</div>

<!-- harga otomatis -->
<div class="mb-3">

<label>Harga</label>

<input
type="text"
name="harga"
id="harga"
class="form-control"
readonly
placeholder="Harga otomatis muncul">

</div>

<button
type="submit"
class="btn btn-primary w-100">
Pesan Sekarang
</button>

</form>

</div>

</div>

<!-- SCRIPT AUTO HARGA -->
<script>

const jasa =
document.getElementById("jasa");

const harga =
document.getElementById("harga");

jasa.addEventListener(
"change",
function(){

let selected =
this.options[
this.selectedIndex
];

harga.value =
selected.getAttribute("data-harga");

}
);

</script>

</body>
</html>