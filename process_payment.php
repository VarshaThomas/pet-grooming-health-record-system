<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['user_id'])){
  die("Unauthorized");
}

$appointment_id = intval($_POST['appointment_id']);
$user_id = $_SESSION['user_id'];
$amount = floatval($_POST['amount']);
$mode = $_POST['mode'];

/* Insert payment */
$txn = ($mode=='Online') ? 'UPI'.rand(10000,99999) : NULL;

mysqli_query($conn,"
  UPDATE tbl_payment
  SET payment_status='Paid',
      payment_mode='$mode',
      transaction_id='$txn',
      payment_date=NOW()
  WHERE appointment_id=$appointment_id
");

/* Update appointment */
mysqli_query($conn,"
  UPDATE tbl_appointment
  SET payment_status='Paid'
  WHERE appointment_id=$appointment_id
");

header("Location: payment_success.php?id=$appointment_id");
exit;
