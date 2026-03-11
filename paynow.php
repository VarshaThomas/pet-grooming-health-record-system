<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}

$appointment_id = intval($_GET['appointment_id'] ?? 0);
$user_id = $_SESSION['user_id'];

/* Fetch appointment */

$app = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM tbl_appointment
WHERE appointment_id=$appointment_id
AND user_id=$user_id
"));

if(!$app){
die("Invalid appointment.");
}

/* Fetch payment */

$pay = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM tbl_payment
WHERE appointment_id=$appointment_id
"));

if(!$pay){

/* get service price */

$service = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT s.price
FROM tbl_service s
JOIN tbl_appointment a ON a.service_id=s.service_id
WHERE a.appointment_id=$appointment_id
"));

$amount = $service['price'] ?? 0;

/* create payment row */

mysqli_query($conn,"
INSERT INTO tbl_payment
(appointment_id,user_id,amount,payment_status)
VALUES
('$appointment_id','$user_id','$amount','Pending')
");

/* fetch again */

$pay = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM tbl_payment
WHERE appointment_id=$appointment_id
"));

}

$amount = $pay['amount'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Pay Now | PetCare</title>

<link rel="stylesheet" href="css/pastel-base.css">

<style>

body{
display:flex;
justify-content:center;
align-items:center;
height:100vh;
background:linear-gradient(135deg,#fff7e8,#f7f4ef);
font-family:Segoe UI;
}

.pay-box{
width:440px;
padding:45px;
border-radius:22px;
background:white;
box-shadow:0 25px 60px rgba(0,0,0,.12);
position:relative;
overflow:hidden;
}

.pay-box:before{
content:"";
position:absolute;
top:-60px;
right:-60px;
width:180px;
height:180px;
background:#ff9900;
opacity:.1;
border-radius:50%;
}

.pay-box h2{
margin-bottom:20px;
font-size:22px;
font-weight:600;
}

.pay-box p{
margin:12px 0;
font-size:15px;
}

.toggle{
display:flex;
gap:25px;
margin-top:20px;
font-size:15px;
}

.toggle label{
display:flex;
align-items:center;
gap:8px;
cursor:pointer;
}

.online-box{
margin-top:18px;
}

.online-box input{
width:100%;
padding:12px;
margin-top:10px;
border-radius:10px;
border:1px solid #e4e4e4;
font-size:14px;
}

.online-box input:focus{
outline:none;
border-color:#ff9900;
box-shadow:0 0 0 2px rgba(255,153,0,.2);
}

.pay-btn{
margin-top:28px;
width:100%;
background:#ff9900;
color:white;
padding:16px;
border:none;
border-radius:12px;
font-size:17px;
font-weight:600;
cursor:pointer;
transition:.25s;
}

.pay-btn:hover{
background:#ff7a00;
transform:translateY(-2px);
box-shadow:0 10px 25px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="pay-box">

<h2>💳 Secure Payment</h2>

<p><b>Appointment Date:</b> <?=htmlspecialchars($app['appointment_date'])?></p>

<p><b>Amount:</b> ₹<?=$amount?></p>

<form method="post" action="process_payment.php">

<input type="hidden" name="appointment_id" value="<?=$appointment_id?>">
<input type="hidden" name="amount" value="<?=$amount?>">

<div class="toggle">

<label>
<input type="radio" name="mode" value="Cash" checked>
💵 Cash
</label>

<label>
<input type="radio" name="mode" value="Online">
💳 Online
</label>

</div>

<div class="online-box" style="display:none;">
<input type="text" id="upi_card" name="upi_card" placeholder="UPI ID / Card Number">

<input type="text" id="expiry_cvv" name="expiry_cvv" placeholder="Expiry (MM/YY) / CVV">
</div>

<button class="pay-btn">
Pay Now
</button>

</form>

</div>

<script>

document.querySelectorAll('input[name=mode]').forEach(r=>{

r.onchange=()=>{

document.querySelector('.online-box').style.display =
r.value==='Online' ? 'block':'none';

}

});

document.querySelector("form").onsubmit=function(){

let mode=document.querySelector('input[name=mode]:checked').value;

if(mode==="Online"){

let card=document.getElementById("upi_card").value.trim();
let expcvv=document.getElementById("expiry_cvv").value.trim();

/* UPI regex */

let upi=/^[a-zA-Z0-9.\-_]{2,}@[a-zA-Z]{2,}$/;

/* card regex */

let cardno=/^\d{13,19}$/;

/* expiry + cvv */

let exp=/^(0[1-9]|1[0-2])\/\d{2}$/;
let cvv=/^\d{3,4}$/;

/* split expiry/cvv */

let parts=expcvv.split(" ");

if(card===""){
alert("Enter UPI ID or Card Number");
return false;
}

if(!upi.test(card) && !cardno.test(card)){
alert("Enter valid UPI ID or Card Number");
return false;
}

if(parts.length!=2){
alert("Enter Expiry and CVV like: 08/28 123");
return false;
}

if(!exp.test(parts[0])){
alert("Expiry must be in MM/YY format");
return false;
}

if(!cvv.test(parts[1])){
alert("Invalid CVV");
return false;
}

}

return true;

};

</script>

</body>
</html>