<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$staffQuery = mysqli_query($conn,"
SELECT staff_id FROM tbl_staff WHERE user_id='$user_id'
");

$staffRow = mysqli_fetch_assoc($staffQuery);
$staff_id = $staffRow['staff_id'];

$check = mysqli_query($conn,"
SELECT * FROM tbl_notification
WHERE staff_id='$staff_id'
AND status='Unread'
");

if(mysqli_num_rows($check) > 0){
echo "new";
}
?>