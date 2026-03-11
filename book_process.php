<?php
include 'config/db.php';
include 'core/slot_engine.php';
include 'core/leave_engine.php';
include 'core/booking_guard.php';


$pet=$_POST['pet_id'];
$service=$_POST['service_id'];
$date=$_POST['date'];
$slot=$_POST['slot'];
$emergency=$_POST['emergency'] ?? 0;
$user_id=1;

preventPastBooking($date);

if(!slotAvailable($conn,$date,$slot)){
    die("Slot Full");
}

$staffQuery=mysqli_query($conn,"
SELECT staff_id
FROM tbl_availability
WHERE available_date='$date'
ORDER BY
(SELECT COUNT(*) 
 FROM tbl_appointment 
 WHERE staff_id=tbl_availability.staff_id
 AND appointment_date='$date')
ASC
LIMIT 1
");

$staff_id=NULL;
$status='Pending';

if(mysqli_num_rows($staffQuery)>0){

    $row=mysqli_fetch_assoc($staffQuery);
    $candidate=$row['staff_id'];

    if(!isOnApprovedLeave($conn,$candidate,$date)
       && preventHeavyLoad($conn,$candidate,$date)){
        $staff_id=$candidate;
        $status='Scheduled';
    }
}

mysqli_query($conn,"
INSERT INTO tbl_appointment
(user_id,pet_id,staff_id,service_id,appointment_date,time_slot,emergency,status)
VALUES('$user_id','$pet','$staff_id','$service','$date','$slot','$emergency','$status')
");

if($staff_id){
    mysqli_query($conn,"
    INSERT INTO tbl_notification(staff_id,message,status,created_at)
    VALUES('$staff_id','New appointment assigned','Unread',NOW())
    ");
}

mysqli_query($conn,"
INSERT INTO tbl_admin_notification(message,status,created_at)
VALUES('New appointment booked','Unread',NOW())
");

header("Location: appointments.php");
exit();
?>