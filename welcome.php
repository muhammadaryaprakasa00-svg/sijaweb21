<?php
session_start();

if(!isset($_SESSION['username'])){
header("Location:login.php");
exit;
}

$username=$_SESSION['username'];
$redirect=$_SESSION['redirect'] ?? "dashboard.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#4facfe,#00f2fe);
font-family:Arial;
color:white;
overflow:hidden;
}

/* box */
.box{
text-align:center;
background:rgba(255,255,255,.1);
padding:50px;
border-radius:25px;
backdrop-filter:blur(15px);
box-shadow:0 8px 30px rgba(0,0,0,.2);
animation:fadeIn 1s ease;
}

/* text animasi */
h1{
font-size:40px;
animation:slideUp 1s ease;
}

p{
opacity:.8;
}

/* loader */
.loader{
margin-top:20px;
border:5px solid rgba(255,255,255,.3);
border-top:5px solid white;
border-radius:50%;
width:40px;
height:40px;
animation:spin 1s linear infinite;
margin-left:auto;
margin-right:auto;
}

/* animasi */
@keyframes spin{
0%{transform:rotate(0);}
100%{transform:rotate(360deg);}
}

@keyframes fadeIn{
from{opacity:0;}
to{opacity:1;}
}

@keyframes slideUp{
from{transform:translateY(30px);}
to{transform:translateY(0);}
}

</style>

</head>
<body>

<div class="box">

<h1>
Selamat Datang, <?= $username;?> 👋
</h1>

<p>
Sedang menyiapkan dashboard kamu...
</p>

<div class="loader"></div>

</div>

<script>

/* redirect otomatis */
setTimeout(function(){
window.location="<?= $redirect;?>";
},2500);

</script>

</body>
</html>