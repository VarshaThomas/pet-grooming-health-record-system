<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add New Pet</title>
<link rel="stylesheet" href="css/addpet-page.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="hearts"></div>

<div class="glass-card">

<h1>Add New Pet 🐾</h1>
<p class="sub">Complete medical & identity details</p>

<form action="core/save_pet.php" method="POST" enctype="multipart/form-data">

<div class="field">
<input type="text" name="pet_name" placeholder="Pet Name" required>
</div>

<div class="field">
<select name="species" required>
<option value="">Species</option>
<option value="Dog">Dog</option>
<option value="Cat">Cat</option>
</select>
</div>

<div class="field">
<input type="text" name="breed" placeholder="Breed" required>
</div>
<div class="field">
<select name="gender" required>
<option value="">Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>

<div class="field">
<select name="vaccination_status">
<option value="">Vaccination Status</option>
<option value="Vaccinated">Vaccinated</option>
<option value="Partially Vaccinated">Partially Vaccinated</option>
<option value="Pending">Pending</option>
</select>
</div>

<div class="field">
<input type="text" name="health_condition" placeholder="Health Condition (e.g. Healthy)">
</div>

<div class="field">
<select name="neutered">
<option value="">Neutered</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>

<div class="field">
<input type="text" name="color" placeholder="Pet Color">
</div>

<div class="field">
<input type="text" name="blood_group" placeholder="Blood Group (optional)">
</div>

<div class="field">
<input type="text" name="allergies" placeholder="Allergies (if any)">
</div>

<div class="field">
<input type="text" name="emergency_contact" placeholder="Emergency Contact">
</div>

<div class="field">
<input type="text" name="insurance_details" placeholder="Insurance Details (optional)">
</div>

<div class="field">
<label>Last Grooming Date</label>
<input type="date" name="last_grooming">
</div>

<div class="field">
<label class="dob-label">Date of Birth (Pet DOB)</label>
<input type="date" name="dob" id="dob" min="2020-01-01" required>
</div>

<div class="field">
<input type="number" name="age" id="age" placeholder="Age (Auto)" readonly>
</div>

<div class="field">
<input type="number" name="weight" id="weight" placeholder="Weight (kg)">
</div>

<div class="field">
<input type="number" name="height_cm" id="height" placeholder="Height (cm)">
</div>

<div class="field">
<input type="text" name="bmi" id="bmi" placeholder="BMI (Auto)" readonly>
</div>

<div class="field">
<input type="text" name="health_flag" id="health_flag" placeholder="Health Flag (Auto)" readonly>
</div>

<div class="field">
<input type="text" name="microchip_id" id="chip" placeholder="Microchip ID (Auto)" readonly>
</div>

<div class="field">
<input type="file" name="image" accept="image/*" required>
<img id="preview" class="preview-img">
</div>

<button type="submit">Submit for Approval</button>

</form>

<a href="pets.php" class="back">← Back to My Pets</a>

</div>

<script>

/* AUTO AGE */
document.getElementById("dob").addEventListener("change",function(){
let dob = new Date(this.value);
let today = new Date();
let age = today.getFullYear() - dob.getFullYear();
document.getElementById("age").value = age;
});

/* AUTO BMI + HEALTH FLAG */
function calculateBMI(){
let weight = parseFloat(document.getElementById("weight").value);
let height = parseFloat(document.getElementById("height").value);

if(weight && height){
let bmi = weight / ((height/100)*(height/100));
bmi = bmi.toFixed(2);
document.getElementById("bmi").value = bmi;

let flag = "Healthy";
if(bmi < 40) flag = "Underweight";
if(bmi > 80) flag = "Overweight";

document.getElementById("health_flag").value = flag;
}
}

document.getElementById("weight").addEventListener("input",calculateBMI);
document.getElementById("height").addEventListener("input",calculateBMI);

/* AUTO MICROCHIP */
document.getElementById("chip").value =
"MC-" + Math.floor(1000 + Math.random()*9000) + "-" + new Date().getFullYear();

/* IMAGE PREVIEW */
document.querySelector("input[type='file']").addEventListener("change",function(e){
const file = e.target.files[0];
if(file){
const reader = new FileReader();
reader.onload = function(ev){
const img = document.getElementById("preview");
img.src = ev.target.result;
img.style.display="block";
}
reader.readAsDataURL(file);
}
});

</script>

</body>
</html>