<?php
session_start();
include 'config/db.php';

$id = (int)$_GET['id'];

$app = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT a.*, s.service_name, p.pet_name
FROM tbl_appointment a
LEFT JOIN tbl_service s ON a.service_id=s.service_id
LEFT JOIN tbl_pet p ON a.pet_id=p.pet_id
WHERE a.appointment_id='$id'
"));

if(!$app){
    die("Invalid appointment");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Appointment Confirmed</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>

body{
margin:0;
font-family:Poppins;
background:linear-gradient(135deg,#fff9e6,#ffe9a7);
display:flex;
align-items:center;
justify-content:center;
height:100vh;
}

.card{
background:#ffffff;
width:450px;
padding:40px;
border-radius:25px;
box-shadow:0 20px 50px rgba(0,0,0,0.1);
text-align:center;
animation:fadeUp 0.6s ease;
}

h2{
color:#c98a00;
margin-bottom:25px;
}

p{
margin:8px 0;
font-size:15px;
}

.btn{
display:inline-block;
margin-top:25px;
padding:12px 25px;
background:#ffb300;
color:#fff;
text-decoration:none;
border-radius:30px;
font-weight:600;
transition:0.3s;
}

.btn:hover{
background:#e09c00;
transform:translateY(-2px);
}

@keyframes fadeUp{
from{opacity:0;transform:translateY(30px);}
to{opacity:1;transform:translateY(0);}
}

</style>
</head>
<body>

<div class="card">
<h2>Appointment Reserved</h2>

<p><strong>Pet:</strong> <?= $app['pet_name'] ?></p>
<p><strong>Service:</strong> <?= $app['service_name'] ?></p>
<p><strong>Date:</strong> <?= $app['appointment_date'] ?></p>
<p><strong>Time:</strong> <?= $app['time_slot'] ?></p>
<p><strong>Status:</strong> <?= $app['status'] ?></p>

<a href="dashboard.php" class="btn">← Go to Dashboard</a>

</div>

</body>
</html>