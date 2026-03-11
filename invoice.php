<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
  die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$bill_id = intval($_GET['bill_id'] ?? 0);

/* FETCH BILL */

$bill = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT 
b.bill_id,
b.amount,
b.bill_date,
a.appointment_date,
s.service_name,
p.pet_name,
u.name AS owner
FROM tbl_bill b
JOIN tbl_appointment a ON a.appointment_id = b.appointment_id
JOIN tbl_service s ON s.service_id = a.service_id
JOIN tbl_pet p ON p.pet_id = a.pet_id
JOIN tbl_user u ON u.user_id = a.user_id
WHERE b.bill_id = $bill_id
AND a.user_id = $user_id
"));

if (!$bill) {
  die("Invoice not found");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice #<?=$bill['bill_id']?></title>

<style>

body{
background:#f5f6fa;
font-family:Segoe UI;
padding:30px;
}

/* invoice container */

.invoice{
max-width:760px;
margin:auto;
background:white;
padding:40px;
border-radius:16px;
box-shadow:0 15px 45px rgba(0,0,0,.12);
}

/* header */

.invoice-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.logo img{
height:60px;
}

.invoice-title{
text-align:right;
}

.invoice-title h2{
margin:0;
font-size:26px;
}

.invoice-title small{
color:#777;
}

/* info grid */

.info-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:18px;
margin-top:20px;
margin-bottom:30px;
}

.info-box{
background:#fafafa;
padding:15px;
border-radius:10px;
font-size:14px;
}

.info-box b{
display:block;
margin-bottom:5px;
}

/* table */

table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

th{
background:#f4f4f4;
padding:12px;
text-align:left;
font-size:14px;
}

td{
padding:12px;
border-bottom:1px solid #eee;
}

/* total */

.total{
display:flex;
justify-content:flex-end;
margin-top:20px;
}

.total-box{
background:#fff4da;
padding:18px 24px;
border-radius:12px;
font-size:18px;
font-weight:600;
}

/* print button */

.print-btn{
margin-top:30px;
width:100%;
padding:14px;
background:#ff9900;
color:white;
border:none;
border-radius:10px;
font-size:16px;
font-weight:600;
cursor:pointer;
}

.print-btn:hover{
background:#ff7a00;
}

/* print mode */

@media print{

.print-btn{
display:none;
}

body{
background:white;
padding:0;
}

.invoice{
box-shadow:none;
}

}

</style>

</head>

<body>

<div class="invoice">

<!-- HEADER -->

<div class="invoice-header">

<div class="logo">
<img src="assets/logo/petcare.png">
</div>

<div class="invoice-title">
<h2>PetCare Invoice</h2>
<small>Invoice ID: <?=$bill['bill_id']?></small><br>
<small>Date: <?=$bill['bill_date']?></small>
</div>

</div>

<hr>

<!-- INFO -->

<div class="info-grid">

<div class="info-box">
<b>Owner</b>
<?=$bill['owner']?>
</div>

<div class="info-box">
<b>Pet Name</b>
<?=$bill['pet_name']?>
</div>

<div class="info-box">
<b>Appointment Date</b>
<?=$bill['appointment_date']?>
</div>

<div class="info-box">
<b>Service</b>
<?=$bill['service_name']?>
</div>

</div>

<!-- SERVICE TABLE -->

<table>

<tr>
<th>Service</th>
<th>Date</th>
<th>Price</th>
</tr>

<tr>
<td><?=$bill['service_name']?></td>
<td><?=$bill['appointment_date']?></td>
<td>INR <?=number_format($bill['amount'],2)?></td>
</tr>

</table>

<!-- TOTAL -->

<div class="total">

<div class="total-box">
Total Amount : INR <?=number_format($bill['amount'],2)?>
</div>

</div>

<button onclick="window.print()" class="print-btn">
🖨 Print / Save as PDF
</button>

</div>

</body>
</html>