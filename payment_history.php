<?php
session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'];

$payments = mysqli_query($conn,"
SELECT 
a.appointment_id,
a.appointment_date,
p.payment_id,
p.amount,
p.payment_mode,
p.payment_status
FROM tbl_appointment a
LEFT JOIN tbl_payment p 
ON p.appointment_id = a.appointment_id
WHERE a.user_id=$user_id
AND a.status='Completed'
ORDER BY a.appointment_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment History</title>

<link rel="stylesheet" href="css/pastel-base.css">
<link rel="stylesheet" href="css/payment-history.css">

<style>

body{
padding:40px;
}

/* container */

.pay-history{
display:flex;
flex-direction:column;
gap:22px;
margin-top:25px;
}

/* card */

.pay-card{
display:flex;
justify-content:space-between;
align-items:center;
padding:28px 32px;
border-radius:20px;
transition:.2s;
}

.pay-card:hover{
transform:translateY(-2px);
box-shadow:0 8px 25px rgba(0,0,0,.08);
}

/* left */

.pay-card .left{
display:flex;
flex-direction:column;
gap:6px;
}

.pay-card h4{
font-size:18px;
font-weight:600;
margin:0;
}

.pay-card small{
opacity:.7;
font-size:14px;
}

/* right */

.pay-card .right{
display:flex;
align-items:center;
gap:20px;
}

/* amount */

.amount{
font-size:20px;
font-weight:700;
}

/* status badge */

.badge{
padding:6px 14px;
border-radius:18px;
font-size:13px;
font-weight:600;
}

.badge.pending{
background:#ffe7b3;
color:#8a5a00;
}

.badge.paid{
background:#d7f2df;
color:#166534;
}

/* pay button */

.pay-btn{
background:#ff9800;
color:white;
padding:12px 22px;
border-radius:12px;
font-size:15px;
font-weight:600;
text-decoration:none;
transition:.25s;
}

.pay-btn:hover{
background:#ff7a00;
transform:translateY(-1px);
box-shadow:0 6px 18px rgba(0,0,0,.15);
}

/* invoice button */

.invoice-btn{
background:#4f7cff;
color:white;
padding:12px 22px;
border-radius:12px;
font-size:15px;
font-weight:600;
text-decoration:none;
transition:.25s;
}

.invoice-btn:hover{
background:#2f5bea;
transform:translateY(-1px);
box-shadow:0 6px 18px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<h2 class="title">💳 Payment History</h2>

<div class="section glass pay-history">

<?php while($p=mysqli_fetch_assoc($payments)){ ?>

<div class="pay-card glass">

<div class="left">
<h4><?=htmlspecialchars($p['appointment_date'])?></h4>
<small><?=htmlspecialchars($p['payment_mode'] ?: 'Pending Payment')?></small>
</div>

<div class="right">

<div class="amount">
💰 ₹<?= $p['amount'] ?? '0' ?>
</div>

<?php if(($p['payment_status'] ?? 'Pending')=='Paid'){ ?>

<span class="badge paid">Paid</span>

<a href="invoice_download.php?id=<?=$p['payment_id']?>" class="invoice-btn">
📄 Invoice
</a>

<?php } else { ?>

<span class="badge pending">Pending</span>

<a href="paynow.php?appointment_id=<?=$p['appointment_id']?>" class="pay-btn">
💳 Pay Now
</a>

<?php } ?>

</div>

</div>

<?php } ?>

</div>

</body>
</html>