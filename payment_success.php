<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);

/* Update appointment */
mysqli_query($conn,"
    UPDATE tbl_appointment
    SET status='Completed'
    WHERE appointment_id=$id
");

/* Update payment */
mysqli_query($conn,"
    UPDATE tbl_payment
    SET payment_status='Paid',
        payment_date=NOW()
    WHERE appointment_id=$id
");
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/payment-success.css">

<style>

body{
margin:0;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#f6f2e8,#f1ede3);
font-family:Segoe UI;
}

/* wrapper */

.success-wrapper{
background:white;
padding:60px;
width:420px;
text-align:center;
border-radius:24px;
box-shadow:0 30px 70px rgba(0,0,0,.12);
animation:pop 0.6s ease;
position:relative;
overflow:hidden;
}

/* pop animation */

@keyframes pop{
0%{
transform:scale(.85);
opacity:0;
}
100%{
transform:scale(1);
opacity:1;
}
}

/* checkmark */

.checkmark{
width:90px;
height:90px;
background:#28a745;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:45px;
color:white;
margin:0 auto 20px auto;
animation:successPulse 1.5s infinite;
}

/* pulse animation */

@keyframes successPulse{

0%{
box-shadow:0 0 0 0 rgba(40,167,69,.6);
}

70%{
box-shadow:0 0 0 18px rgba(40,167,69,0);
}

100%{
box-shadow:0 0 0 0 rgba(40,167,69,0);
}

}

h2{
margin-bottom:10px;
font-size:26px;
}

p{
color:#666;
margin-bottom:35px;
}

/* button */

.done-btn{
display:inline-block;
background:#f5c400;
color:#000;
padding:16px 34px;
border-radius:30px;
text-decoration:none;
font-weight:600;
transition:.3s;
}

.done-btn:hover{
background:#ffb300;
transform:translateY(-2px);
box-shadow:0 10px 25px rgba(0,0,0,.15);
}

/* decorative glow */

.success-wrapper::before{
content:"";
position:absolute;
top:-120px;
right:-120px;
width:240px;
height:240px;
background:#f5c400;
opacity:.08;
border-radius:50%;
}

.success-wrapper::after{
content:"";
position:absolute;
bottom:-120px;
left:-120px;
width:240px;
height:240px;
background:#28a745;
opacity:.08;
border-radius:50%;
}

</style>

</head>

<body>

<div class="success-wrapper">

  <div class="checkmark">
      ✓
  </div>

  <h2>Payment Successful</h2>
  <p>Your appointment has been Completed.</p>

  <a href="dashboard.php" class="done-btn">
      Back to Dashboard
  </a>

</div>

</body>
</html>