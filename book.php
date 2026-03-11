<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}

include "config/db.php";

$services = mysqli_query($conn,"
    SELECT service_id, service_name, category 
    FROM tbl_service
");

if($_SESSION['user_id'] == 0){
    $pets = mysqli_query($conn,"SELECT pet_id, pet_name, species FROM tbl_pet");
} else {
    $uid = (int)$_SESSION['user_id'];
    $pets = mysqli_query($conn,"
        SELECT pet_id, pet_name, species 
        FROM tbl_pet 
        WHERE user_id = $uid
    ");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Appointment</title>
<link rel="stylesheet" href="css/book.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
.invalid-date {
    border:2px solid red !important;
    background:#ffe6e6 !important;
}

.emergency-btn{
width:100%;
background:#ff3b3b;
color:white;
border:none;
padding:12px;
border-radius:20px;
margin-bottom:10px;
font-weight:600;
cursor:pointer;
transition:0.3s;
}

/* hover effect */
.emergency-btn:hover{
background:#e02929;
}

/* AFTER CLICK */
.emergency-btn.active{
background:#ffb3b3;
color:#800000;
cursor:not-allowed;
}
</style>
</head>
<body>

<img src="images/pet10.jpg" class="bg-pet b1">
<img src="images/pet11.jpg" class="bg-pet b2">
<img src="images/pet7.jpg"  class="bg-pet b3">

<div class="glass"></div>

<div class="book-wrap">
<div class="book-card">

<h2>Book Appointment</h2>

<form action="core/save_booking.php" method="POST">

<select name="pet_id" id="petSelect" required>
<option value="">Select Pet</option>
<?php while($p=mysqli_fetch_assoc($pets)){ ?>
<option 
value="<?= $p['pet_id'] ?>" 
data-species="<?= strtolower($p['species']) ?>">
<?= $p['pet_name'] ?>
</option>
<?php } ?>
</select>

<select id="categorySelect" required>
<option value="">Select Type</option>
<option value="Medical">Medical</option>
<option value="Grooming">Grooming</option>
</select>

<select name="service_id" id="serviceSelect" required>
<option value="">Select Service</option>
<?php while($s=mysqli_fetch_assoc($services)){ ?>
<option 
value="<?= $s['service_id'] ?>" 
data-category="<?= $s['category'] ?>">
<?= $s['service_name'] ?>
</option>
<?php } ?>
</select>

<!-- NEW VACCINE SELECT (Only appears if Vaccination selected) -->
<select name="vaccine_name" id="vaccineSelect" style="display:none;">
<option value="">Select Vaccine</option>
<option value="Rabies" data-species="both">Rabies</option>
<option value="DHPP" data-species="dog">DHPP (Dog)</option>
<option value="Parvo" data-species="dog">Parvo (Dog)</option>
<option value="Distemper" data-species="dog">Distemper (Dog)</option>
<option value="FVRCP" data-species="cat">FVRCP (Cat)</option>
<option value="Booster" data-species="both">Booster</option>
</select>

<input type="date"
id="appointmentDate"
name="appointment_date"
min="<?= date('Y-m-d') ?>"
required>

<select name="time_slot" required>
<option value="">Select Slot</option>
<option>09:00 - 10:00</option>
<option>10:00 - 11:00</option>
<option>11:00 - 12:00</option>
<option>12:00 - 01:00</option>
<option>02:00 - 03:00</option>
<option>03:00 - 04:00</option>
<option>04:00 - 05:00</option>
<option>05:00 - 06:00</option>
</select>

<input type="hidden" name="emergency" id="emergencyFlag" value="0">
<button type="button" id="emergencyBtn" class="emergency-btn">
🚨 Emergency Booking
</button>

<button>Book Now</button>
</form>
</div>
</div>

<script src="js/book.js"></script>

</body>
</html>