<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>Logout</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#667eea,#764ba2);
font-family:Arial;
color:white;
overflow:hidden;
}

/* card */
.box{
text-align:center;
background:rgba(255,255,255,.1);
padding:50px;
border-radius:25px;
backdrop-filter:blur(15px);
box-shadow:0 8px 30px rgba(0,0,0,.2);
animation:fadeIn 1s ease;
}

/* icon animasi */
.icon{
font-size:80px;
animation:pop 1s ease;
}

/* text */
h2{
margin-top:20px;
}

p{
opacity:.8;
}

/* animasi */
@keyframes fadeIn{
from{opacity:0;transform:translateY(30px);}
to{opacity:1;transform:translateY(0);}
}

@keyframes pop{
0%{transform:scale(0);}
100%{transform:scale(1);}
}

</style>

</head>
<body>

<div class="box">

<div class="icon">👋</div>

<h2>Terima Kasih!</h2>

<p>
Terima kasih telah menggunakan layanan SIJAWEB.<br>
Sampai jumpa kembali 😊
</p>

<p id="countdown">
Redirect ke login dalam 3 detik...
</p>

</div>

<script>

/* countdown realtime */
let detik=3;

let cd=document.getElementById("countdown");

let interval=setInterval(function(){

detik--;

cd.innerHTML=
"Redirect ke login dalam "+detik+" detik...";

if(detik==0){
clearInterval(interval);
window.location="login.php";
}

},1000);

</script>

</body>
</html>