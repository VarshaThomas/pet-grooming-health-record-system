<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}

$user_id = $_SESSION['user_id'];
$id = intval($_GET['id'] ?? 0);

if(!$id){
header("Location: cancel_result.php?status=invalid");
exit;
}

/* FETCH APPOINTMENT */

$app = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM tbl_appointment
WHERE appointment_id=$id
"));

if(!$app){
header("Location: cancel_result.php?status=invalid");
exit;
}


/* VERIFY PET BELONGS TO USER */

$pet = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM tbl_pet
WHERE pet_id=".$app['pet_id']."
AND user_id=$user_id
"));

if(!$pet){
header("Location: cancel_result.php?status=invalid");
exit;
}

/* ONLY APPROVED CAN CANCEL */

if($app['status'] != 'Approved'){
header("Location: cancel_result.php?status=closed");
exit;
}

/* 24 HOUR RULE */

$slot_parts = explode('-', $app['time_slot']);
$slot_start = trim($slot_parts[0]);

$appt_time = strtotime($app['appointment_date'].' '.$slot_start);
$cancel_deadline = $appt_time - 86400;

if(time() > $cancel_deadline){
header("Location: cancel_result.php?status=closed");
exit;
}

/* CANCEL APPOINTMENT */

mysqli_query($conn,"
UPDATE tbl_appointment
SET status='Cancelled',
cancelled=1
WHERE appointment_id=$id
");

/* CREATE MESSAGE */

mysqli_query($conn,"
INSERT INTO tbl_messages(user_id,title,message)
VALUES(
'$user_id',
'Appointment Cancelled',
'Your appointment on ".$app['appointment_date']." was cancelled successfully.'
)
");

header("Location: cancel_result.php?status=success");
exit;
?>