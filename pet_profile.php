<?php
session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'] ?? 0;
$pet_id  = intval($_GET['pet_id'] ?? 0);

if(!$pet_id){ die("Invalid pet"); }

$pet = mysqli_fetch_assoc(
  mysqli_query($conn,"
    SELECT * FROM tbl_pet
    WHERE pet_id=$pet_id AND user_id=$user_id
  ")
);

if(!$pet){ die("Pet not found"); }

$appointments = mysqli_query($conn,"
  SELECT * FROM tbl_appointment
  WHERE pet_id=$pet_id
  ORDER BY appointment_date DESC
");

$health = mysqli_query($conn,"
  SELECT r.*, a.appointment_date
  FROM tbl_vet_report r
  JOIN tbl_appointment a ON a.appointment_id=r.appointment_id
  WHERE a.pet_id=$pet_id
  ORDER BY r.report_id DESC
");

$payments = mysqli_query($conn,"
SELECT p.*
FROM tbl_payment p
JOIN tbl_appointment a ON a.appointment_id=p.appointment_id
WHERE a.pet_id=$pet_id
ORDER BY p.payment_date DESC
");

$grooming = mysqli_query($conn,"
SELECT *
FROM tbl_grooming_record
WHERE pet_id=$pet_id
AND status='Completed'
ORDER BY groom_date DESC
");

$vaccines = mysqli_query($conn,"
SELECT *
FROM tbl_vaccination
WHERE pet_id='$pet_id'
ORDER BY given_date DESC
");



$latest_vaccine = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM tbl_vaccination
WHERE pet_id='$pet_id'
ORDER BY given_date DESC
LIMIT 1
"));

/* ================= BMI BADGE LOGIC (DYNAMIC) ================= */

$bmi = floatval($pet['bmi'] ?? 0);

if($bmi < 40){
    $health_flag = "Underweight";
    $bmiClass = "bmi-under";
}
elseif($bmi >= 40 && $bmi < 70){
    $health_flag = "Healthy";
    $bmiClass = "bmi-healthy";
}
else{
    $health_flag = "Overweight";
    $bmiClass = "bmi-overweight";
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?=htmlspecialchars($pet['pet_name'])?> | Pet Profile</title>
<link rel="stylesheet" href="css/pet-profile.css">
</head>
<body>

<a href="dashboard.php" class="back-link">← Back to Dashboard</a>

<section class="pet-profile-card">

<?php $img = $pet['image'] ?: 'default.jpg'; ?>
<img src="assets/pets/<?=htmlspecialchars($img)?>" class="avatar">

<h2><?=htmlspecialchars($pet['pet_name'])?></h2>

<p class="meta">
<?=htmlspecialchars($pet['species'])?> •
<?=htmlspecialchars($pet['gender'])?> •
<?=htmlspecialchars($pet['age'])?> yrs
</p>

<span class="status"><?=htmlspecialchars($pet['status'])?></span>

<p class="registered">
Registered on <?=date("d M Y",strtotime($pet['created_at']))?>
</p>

<div class="actions">
<a href="edit_pet.php?pet_id=<?=$pet_id?>" class="action-btn">Edit</a>
<a href="download_pet_pdf.php?pet_id=<?=$pet_id?>" class="action-btn download-btn">Download PDF</a>
<a href="add_health_note.php?pet_id=<?=$pet_id?>" class="action-btn">+ Add Health Note</a>
</div>

</section>

<div class="tabs">
<button class="tab active" onclick="switchTab(event,'overview')">Overview</button>
<button class="tab" onclick="switchTab(event,'appointments')">Appointments</button>
<button class="tab" onclick="switchTab(event,'health')">Health</button>
<button class="tab" onclick="switchTab(event,'grooming')">Grooming</button>
<button class="tab" onclick="switchTab(event,'payments')">Payments</button>
<button class="tab" onclick="switchTab(event,'timeline')">Timeline</button>
</div>

<section class="content">

<!-- OVERVIEW -->
<div id="overview" class="tab-content active">
<div class="card-grid">

<?php
$fields = [
"Breed"=>$pet['breed'],
"Weight"=>$pet['weight']." kg",
"Blood Group"=>$pet['blood_group'],
"Vaccination"=>$pet['vaccination_status'],
"Microchip"=>$pet['microchip_id'],
"Allergies"=>$pet['allergies'],
"Emergency"=>$pet['emergency_contact'],
"Insurance"=>$pet['insurance_details'],
"BMI"=>"<span class='bmi-badge $bmiClass'>".number_format($bmi,2)." ($health_flag)</span>"
];

foreach($fields as $label=>$value){
?>
<div class="info-card">
<div class="label"><?=$label?></div>
<div class="value"><?=$value ?: '-'?></div>
</div>
<?php } ?>

</div>
</div>

<!-- APPOINTMENTS -->
<div id="appointments" class="tab-content">
<?php
while($a=mysqli_fetch_assoc($appointments)){
?>
<div class="row-card">

<div><?=$a['appointment_date']?></div>

<div><?=$a['status']?></div>

<?php
$slot_parts = explode('-', $a['time_slot']);
$slot_start = trim($slot_parts[0]);

$appt_time = strtotime($a['appointment_date'].' '.$slot_start);
$cancel_deadline = $appt_time - 86400;
if($a['status']=='Approved' && time() < $cancel_deadline){
?>

<a href="cancel_appointment.php?id=<?=$a['appointment_id']?>"
class="cancel-btn"
onclick="return confirm('Cancel this appointment?')">
Cancel Appointment
</a>

<?php } ?>

</div>
<?php } ?>
</div>

<!-- HEALTH -->
<div id="health" class="tab-content">
<?php if(mysqli_num_rows($health)==0){ ?>
<div class="empty">No health reports</div>
<?php } else { while($h=mysqli_fetch_assoc($health)){ ?>
<div class="row-card medical-report">

<div class="report-date">
<?=$h['appointment_date']?>
</div>

<div class="report-section diagnosis-box">

<div class="report-title">
Diagnosis
</div>

<div class="report-content">
<?=nl2br(htmlspecialchars($h['diagnosis']))?>
</div>

</div>

<div class="report-section prescription-box">

<div class="report-title">
Prescription
</div>

<div class="report-content">
<?=nl2br(htmlspecialchars($h['prescription']))?>
</div>

</div>

<a href="download_medical_pdf.php?appointment_id=<?=$h['appointment_id']?>"
class="download-report-btn">
⬇ Download Medical Report
</a>
</div>
<?php }} ?>

<hr style="margin:25px 0">

<h3>Vaccination History</h3>

<?php if(mysqli_num_rows($vaccines)==0){ ?>

<div class="empty">No vaccination records</div>

<?php } else { while($v=mysqli_fetch_assoc($vaccines)){ ?>

<div class="row-card column">

<strong><?=htmlspecialchars($v['vaccine_name'])?></strong>

<p>
<b>Given Date:</b>
<?=htmlspecialchars($v['given_date'])?>
</p>

<?php if(!empty($v['next_due_date'])){ ?>
<p>
<b>Next Due:</b>
<?=htmlspecialchars($v['next_due_date'])?>
</p>
<?php } ?>

</div>

<?php }} ?>
</div>



<!-- GROOMING -->
<div id="grooming" class="tab-content">

<?php if(mysqli_num_rows($grooming)==0){ ?>

<div class="empty">No grooming records</div>

<?php } else { ?>

<?php while($g = mysqli_fetch_assoc($grooming)){ ?>

<div class="groom-report">

<div class="groom-header">

<div class="groom-date">
<?=htmlspecialchars($g['groom_date'])?>
</div>

<div class="groom-badge">
GROOMING REPORT
</div>

</div>


<div class="groom-grid">

<div class="groom-item">
<span class="g-label">Service :</span>
<span class="g-value"><?=htmlspecialchars($g['services'])?></span>
</div>

<div class="groom-item">
<span class="g-label">Notes :</span>
<span class="g-value"><?=htmlspecialchars($g['notes'] ?: 'None')?></span>
</div>

<div class="groom-item">
<span class="g-label">Observation :</span>
<span class="g-value"><?=htmlspecialchars($g['special_observation'] ?: 'None')?></span>
</div>

</div>


<?php if(!empty($g['before_image']) || !empty($g['after_image'])){ ?>

<div class="groom-images">

<?php if(!empty($g['before_image'])){ ?>
<div class="groom-img">
<span>Before</span>
<img src="assets/grooming/<?=htmlspecialchars($g['before_image'])?>">
</div>
<?php } ?>

<?php if(!empty($g['after_image'])){ ?>
<div class="groom-img">
<span>After</span>
<img src="assets/grooming/<?=htmlspecialchars($g['after_image'])?>">
</div>
<?php } ?>

</div>

<?php } ?>

</div>

<?php } ?>

<?php } ?>

</div>


<!-- PAYMENTS -->
<div id="payments" class="tab-content">

<?php if(mysqli_num_rows($payments)==0){ ?>

<div class="empty">No payments</div>

<?php } else { while($p=mysqli_fetch_assoc($payments)){ ?>

<div class="payment-pro-card">

<div class="pay-icon">

<?php if($p['payment_mode']=='Online'){ ?>
💳
<?php } else { ?>
💵
<?php } ?>

</div>

<div class="pay-info">

<div class="pay-amount">
₹<?=number_format($p['amount'],2)?>
</div>

<div class="pay-mode">
<?=$p['payment_mode']?> Payment
</div>

<div class="pay-date">
<?=date("d M Y",strtotime($p['payment_date']))?>
</div>

</div>

<div class="pay-actions">

<span class="pay-status <?=$p['payment_status']=='Paid'?'paid':'pending'?>">
<?=$p['payment_status']?>
</span>

<a href="invoice_download.php?id=<?=$p['payment_id']?>" class="invoice-btn-pro">
Invoice
</a>

</div>

</div>

<?php }} ?>

</div>

<!-- TIMELINE -->
<div id="timeline" class="tab-content">
<?php
$timeline = mysqli_query($conn,"
SELECT appointment_date as date, status as event
FROM tbl_appointment WHERE pet_id=$pet_id

UNION

SELECT a.appointment_date as date, 'Health Report'
FROM tbl_vet_report r
JOIN tbl_appointment a ON r.appointment_id=a.appointment_id
WHERE a.pet_id=$pet_id

UNION

SELECT groom_date as date, 'Grooming Completed'
FROM tbl_grooming_record
WHERE pet_id=$pet_id

UNION

SELECT given_date as date,
CONCAT(vaccine_name,' Vaccination')
FROM tbl_vaccination
WHERE pet_id=$pet_id

ORDER BY date DESC
");

while($t=mysqli_fetch_assoc($timeline)){

$class="appointment";

if(strpos($t['event'],"Vaccination")!==false) $class="vaccination";
elseif($t['event']=="Health Report") $class="health";
elseif($t['event']=="Grooming Completed") $class="grooming";

?>

<div class="timeline-card <?=$class?>">

<div class="dot"></div>

<div>
<strong><?=$t['date']?></strong>
<p><?=$t['event']?></p>
</div>

</div>

<?php } ?>
</div>

</section>

<script>
function switchTab(e,id){
document.querySelectorAll(".tab").forEach(t=>t.classList.remove("active"));
document.querySelectorAll(".tab-content").forEach(c=>c.classList.remove("active"));
e.target.classList.add("active");
document.getElementById(id).classList.add("active");
}
</script>

</body>
</html>