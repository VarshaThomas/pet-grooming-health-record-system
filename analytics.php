<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

$stats = mysqli_fetch_assoc(mysqli_query($conn, "
  SELECT 
    COUNT(*) total,
    SUM(status='Completed') completed,
    SUM(status='Pending') pending
  FROM tbl_appointment
  WHERE user_id=$user_id
"));

$spent = mysqli_fetch_assoc(mysqli_query($conn, "
  SELECT IFNULL(SUM(b.amount),0) total_spent
  FROM tbl_bill b
  JOIN tbl_appointment a ON a.appointment_id=b.appointment_id
  WHERE a.user_id=$user_id
"));
?>

<!DOCTYPE html>
<html>
<head>
<title>My Analytics</title>
<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<a href="dashboard.php" style="margin:24px 48px;display:inline-block">← Back</a>

<h2 class="title">📊 My Analytics</h2>

<section class="stats">

  <div class="glass stat">
    <h2><?=$stats['total']?></h2>
    <span>Total Appointments</span>
  </div>

  <div class="glass stat">
    <h2><?=$stats['completed']?></h2>
    <span>Completed</span>
  </div>

  <div class="glass stat">
    <h2><?=$stats['pending']?></h2>
    <span>Pending</span>
  </div>

  <div class="glass stat">
    <h2>₹<?=$spent['total_spent']?></h2>
    <span>Total Spent</span>
  </div>

</section>

</body>
</html>
