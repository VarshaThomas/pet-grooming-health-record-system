<?php
include "config/db.php";
$id=$_GET['id'];

mysqli_query($conn,"UPDATE tbl_appointment SET cancelled=1,status='Cancelled' WHERE appointment_id=$id");
mysqli_query($conn,"UPDATE tbl_payment SET payment_status='Refunded' WHERE appointment_id=$id");

header("Location: dashboard.php");
