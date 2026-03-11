<?php
$status = $_GET['status'] ?? 'success';

$title = "Appointment Cancelled";
$msg = "Your appointment scheduled on <b>$date</b> has been cancelled succesfully.";
$emoji = "😢";
$color = "#ff4d4d";

if($status=="closed"){
$title = "Cancellation Window Closed";
$msg = "This appointment cannot be cancelled because it is less than 24 hours away.";
$emoji = "⏰";
$color = "#ff9900";
}

if($status=="invalid"){
$title = "Invalid Appointment";
$msg = "This appointment does not exist or access denied.";
$emoji = "⚠️";
$color = "#666";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>PetCare</title>

<style>

body{
margin:0;
height:100vh;
display:flex;
align-items:center;
justify-content:center;
font-family:'Segoe UI',sans-serif;
background:linear-gradient(135deg,#fff7e6,#f4efe6);
}

.wrapper{
text-align:center;
}

.card{
width:460px;
background:white;
padding:55px;
border-radius:24px;
box-shadow:0 30px 70px rgba(0,0,0,.15);
position:relative;
overflow:hidden;
}

.card:before{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:6px;
background:<?= $color ?>;
}

.emoji{
font-size:70px;
margin-bottom:10px;
}

h2{
margin:10px 0;
font-size:26px;
}

p{
color:#666;
margin-bottom:35px;
line-height:1.6;
}

.actions{
display:flex;
justify-content:center;
gap:15px;
}

.btn{
padding:14px 28px;
border-radius:12px;
text-decoration:none;
font-weight:600;
transition:.25s;
}

.primary{
background:#ff9900;
color:white;
}

.primary:hover{
background:#ff7a00;
transform:translateY(-2px);
box-shadow:0 8px 18px rgba(0,0,0,.15);
}

.secondary{
background:#e8e8e8;
color:#333;
}

.secondary:hover{
background:#dcdcdc;
}

</style>

</head>

<body>

<div class="wrapper">

<div class="card">

<div class="emoji"><?= $emoji ?></div>

<h2><?= $title ?></h2>

<p><?= $msg ?></p>

<div class="actions">

<a href="dashboard.php" class="btn primary">
Back to Dashboard
</a>

<a href="pets.php" class="btn secondary">
My Pets
</a>

</div>

</div>

</div>

</body>
</html>