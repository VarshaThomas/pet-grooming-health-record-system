<?php
include "config/db.php";

$uid = $_POST['user_id'];
$pid = $_POST['pet_id'];
$sid = $_POST['staff_id'];
$date = $_POST['appointment_date'];
$type = $_POST['visit_type'];

$sql = "INSERT INTO tbl_appointment 
(user_id,pet_id,staff_id,appointment_date,status,visit_type,cancelled)
VALUES ('$uid','$pid','$sid','$date','Pending','$type',0)";

if(mysqli_query($conn,$sql)){
   echo "Appointment Booked Successfully";
}else{
   echo "Booking Failed : Daily limit reached";
}
?>
