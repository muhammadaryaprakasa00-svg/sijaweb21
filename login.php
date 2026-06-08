<?php
session_start();
include "config.php";

$error="";

if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$q=mysqli_query($conn,"
SELECT * FROM users
WHERE username='$username'
AND password='$password'
");

if(mysqli_num_rows($q)>0){

$data=mysqli_fetch_assoc($q);

$_SESSION['id']=$data['id'];
$_SESSION['username']=$data['username'];
$_SESSION['role']=$data['role'];

if($data['role']=="admin"){
header("Location:admin/dashboard_admin.php");
}else{
header("Location:dashboard.php");
}
exit;

}else{
$error="Username atau Password salah";
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Login SIJAWEB</title>

<link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:
linear-gradient(
135deg,
#4facfe,
#00f2fe
);
font-family:Arial;
}

.login-box{

width:420px;
padding:40px;

background:
rgba(255,255,255,.18);

backdrop-filter:blur(20px);

border-radius:25px;

box-shadow:
0 8px 32px rgba(0,0,0,.15);

}

.logo{
font-size:38px;
font-weight:bold;
text-align:center;
margin-bottom:10px;
}

.subtitle{
text-align:center;
color:#333;
margin-bottom:30px;
}

.form-control{
height:55px;
border-radius:15px;
}

.btn-login{
height:55px;
border-radius:15px;
font-weight:bold;
font-size:18px;
}

.footer{
text-align:center;
margin-top:20px;
font-size:14px;
}

</style>
</head>
<body>


<div class="login-box">

<div class="logo">
SIJAWEB
</div>

<p class="subtitle">
Sistem Informasi Pelayanan Jasa
</p>


<?php if($error!=""){ ?>
<div class="alert alert-danger">
<?php echo $error;?>
</div>
<?php } ?>


<form method="POST">

<div class="mb-3">

<input
type="text"
name="username"
class="form-control"
placeholder="Username"
required>

</div>


<div class="mb-4">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>


<button
type="submit"
name="login"
class="
btn btn-primary
w-100
btn-login
">

Login

</button>

</form>


<div class="footer">
Belum punya akun?
<a href="register.php">
Daftar
</a>
</div>

</div>

</body>
</html>