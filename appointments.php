<?php
session_start();
include "config/db.php";

$user = $_SESSION['user_id'];

$appointments = mysqli_query($conn,"
SELECT a.*, s.service_name
FROM tbl_appointment a
JOIN tbl_service s ON a.service_id = s.service_id
WHERE a.pet_id IN (
    SELECT pet_id FROM tbl_pet WHERE user_id='$user'
)
ORDER BY a.appointment_date DESC
");

/* Cancel Logic */
if(isset($_GET['cancel'])){
    $id = (int)$_GET['cancel'];

    $check = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT appointment_date FROM tbl_appointment
    WHERE appointment_id='$id'
    "));

    if(strtotime($check['appointment_date']) - time() > 86400){
        mysqli_query($conn,"
        UPDATE tbl_appointment
        SET status='Cancelled'
        WHERE appointment_id='$id'
        ");
        header("Location: appointments.php");
        exit;
    } else {
        echo "<script>alert('Cancellation allowed only 24 hours before appointment');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>My Appointments</title>
<link rel="stylesheet" href="css/glass-base.css">
<link rel="stylesheet" href="css/timeline.css">
</head>
<body>

<h2 style="padding:40px">📅 My Appointments</h2>

<div class="timeline">
<?php while($a = mysqli_fetch_assoc($appointments)){ ?>
  <div class="event glass">
    <h3><?= $a['service_name'] ?></h3>
    <p><?= $a['appointment_date'] ?> • <?= $a['time_slot'] ?></p>
    <span class="badge"><?= $a['status'] ?></span>

    <?php if($a['status'] != 'Cancelled'){ ?>
        <a href="appointments.php?cancel=<?= $a['appointment_id'] ?>"
           style="color:red;font-size:13px;">Cancel</a>
    <?php } ?>
  </div>
<?php } ?>
</div>

</body>
</html>