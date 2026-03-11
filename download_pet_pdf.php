<?php
session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'] ?? 0;
$pet_id  = intval($_GET['pet_id'] ?? 0);

$pet = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT * FROM tbl_pet
WHERE pet_id=$pet_id AND user_id=$user_id
")
);

if(!$pet){ die("Pet not found"); }

$image = $pet['image'] ?: 'default.jpg';
$image_path = "assets/pets/".$image;

/* ===== BMI Dynamic Logic ===== */

$bmi = floatval($pet['bmi'] ?? 0);

if($bmi < 40){
    $class = "under";
    $label = "Underweight";
}
elseif($bmi >= 40 && $bmi < 70){
    $class = "healthy";
    $label = "Healthy";
}
else{
    $class = "overweight";
    $label = "Overweight";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Pet Report</title>
<style>
body{font-family:Arial;padding:40px;}
.report{max-width:800px;margin:auto;}
.header{
display:flex;align-items:center;gap:30px;
border-bottom:2px solid #ffcc00;
padding-bottom:15px;margin-bottom:25px;
}
.header img{
width:120px;height:120px;
object-fit:cover;border-radius:50%;
}
.row{margin:8px 0;}
.badge{
display:inline-block;
padding:6px 14px;
border-radius:20px;
font-weight:bold;
color:white;
}
.healthy{background:#4CAF50;}
.under{background:#ff9800;}
.overweight{background:#f44336;}
@media print{button{display:none;}}
</style>
</head>
<body>

<button onclick="window.print()">Download PDF</button>

<div class="report">

<div class="header">
<img src="<?=$image_path?>">
<div>
<h2><?=$pet['pet_name']?> - Pet Profile</h2>
<div><?=$pet['species']?> • <?=$pet['gender']?> • <?=$pet['age']?> yrs</div>
</div>
</div>

<div class="row"><strong>Breed:</strong> <?=$pet['breed']?></div>
<div class="row"><strong>Weight:</strong> <?=$pet['weight']?> kg</div>
<div class="row"><strong>Height:</strong> <?=$pet['height_cm']?> cm</div>
<div class="row"><strong>Blood Group:</strong> <?=$pet['blood_group']?></div>
<div class="row"><strong>Microchip:</strong> <?=$pet['microchip_id']?></div>
<div class="row"><strong>Vaccination:</strong> <?=$pet['vaccination_status']?></div>
<div class="row"><strong>Allergies:</strong> <?=$pet['allergies']?></div>
<div class="row"><strong>Emergency:</strong> <?=$pet['emergency_contact']?></div>
<div class="row"><strong>Insurance:</strong> <?=$pet['insurance_details']?></div>
<div class="row"><strong>Registered:</strong> <?=date("d M Y",strtotime($pet['created_at']))?></div>

<div class="row">
<strong>BMI:</strong>
<span class="badge <?=$class?>">
<?=number_format($bmi,2)?> (<?=$label?>)
</span>
</div>

</div>

<script>
window.onload=function(){ window.print(); }
</script>

</body>
</html>