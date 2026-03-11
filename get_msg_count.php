<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
echo 0;
exit;
}

$user_id=$_SESSION['user_id'];

$q=mysqli_query($conn,"
SELECT COUNT(*) c
FROM tbl_messages
WHERE user_id='$user_id'
AND status='Unread'
");

$row=mysqli_fetch_assoc($q);

echo $row['c'];
?>