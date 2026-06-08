<?php
include "config.php";

$msg="";

if(isset($_POST['daftar'])){

$user=$_POST['username'];
$pass=$_POST['password'];
$confirm=$_POST['confirm'];

if($pass!=$confirm){

$msg="
<div class='alert alert-danger'>
Konfirmasi password tidak cocok
</div>";

}else{

$cek=mysqli_query(
$conn,
"SELECT * FROM users
WHERE username='$user'
");

if(mysqli_num_rows($cek)>0){

$msg="
<div class='alert alert-danger'>
Username sudah dipakai
</div>";

}else{

mysqli_query($conn,"
INSERT INTO users
VALUES(
NULL,
'$user',
'$pass',
'user'
)
");

$msg="
<div class='alert alert-success'>
Registrasi berhasil,
silakan login
</div>";

}

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register SIJAWEB</title>

<meta name="viewport"
content="width=device-width,initial-scale=1">

<link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
"
rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:
linear-gradient(
135deg,
#667eea,
#764ba2
);
font-family:Arial;
}

.register-box{

width:450px;
padding:40px;

background:
rgba(255,255,255,.18);

backdrop-filter:blur(20px);

border-radius:25px;

box-shadow:
0 8px 32px rgba(0,0,0,.2);

}

.logo{
font-size:38px;
font-weight:bold;
text-align:center;
margin-bottom:10px;
}

.sub{
text-align:center;
margin-bottom:30px;
}

.form-control{
height:55px;
border-radius:15px;
}

.btn-daftar{
height:55px;
border-radius:15px;
font-weight:bold;
font-size:18px;
}

.footer{
text-align:center;
margin-top:20px;
}

</style>

</head>
<body>

<div class="register-box">

<div style="
font-size:60px;
text-align:center;
">
📝
</div>

<div class="logo">
SIJAWEB
</div>

<p class="sub">
Buat akun baru
</p>

<?php echo $msg; ?>

<form method="POST">

<div class="mb-3">

<input
type="text"
name="username"
class="form-control"
placeholder="Username"
required>

</div>


<div class="mb-3">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>


<div class="mb-4">

<input
type="password"
name="confirm"
class="form-control"
placeholder="Konfirmasi Password"
required>

</div>


<button
type="submit"
name="daftar"
class="
btn btn-success
w-100
btn-daftar
">

Daftar

</button>

</form>


<div class="footer">
Sudah punya akun?

<a href="login.php">
Login
</a>

</div>

</div>

</body>
</html>