<?php
session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'] ?? 0;

/* ===== DASHBOARD STATS ===== */

$total_pets = mysqli_fetch_row(
  mysqli_query($conn,"
    SELECT COUNT(*) 
    FROM tbl_pet 
    WHERE user_id=$user_id
  ")
)[0];

$total_appointments = mysqli_fetch_row(
  mysqli_query($conn,"
    SELECT COUNT(*) 
    FROM tbl_appointment a
    JOIN tbl_pet p ON a.pet_id=p.pet_id
    WHERE p.user_id=$user_id
  ")
)[0];

$total_vaccines = mysqli_fetch_row(
  mysqli_query($conn,"
    SELECT COUNT(*) 
    FROM tbl_vaccination v
    JOIN tbl_pet p ON v.pet_id=p.pet_id
    WHERE p.user_id=$user_id
  ")
)[0];

$total_grooming = mysqli_fetch_row(
  mysqli_query($conn,"
    SELECT COUNT(*) 
    FROM tbl_grooming_record g
    JOIN tbl_pet p ON g.pet_id=p.pet_id
    WHERE p.user_id=$user_id
  ")
)[0];
$pet_id = intval($_GET['pet_id'] ?? 0);

$pet = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT * FROM tbl_pet
WHERE pet_id=$pet_id AND user_id=$user_id
")
);

if(!$pet){ die("Pet not found"); }

if($_SERVER['REQUEST_METHOD']=="POST"){

$pet_name = mysqli_real_escape_string($conn,$_POST['pet_name']);
$breed = mysqli_real_escape_string($conn,$_POST['breed']);
$weight = mysqli_real_escape_string($conn,$_POST['weight']);
$color = mysqli_real_escape_string($conn,$_POST['color']);

mysqli_query($conn,"
UPDATE tbl_pet SET
pet_name='$pet_name',
breed='$breed',
weight='$weight',
color='$color'
WHERE pet_id=$pet_id AND user_id=$user_id
");

header("Location: pet_profile.php?pet_id=".$pet_id);
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pet</title>
<link rel="stylesheet" href="css/pet-profile.css">

<style>

/* ===== SaaS Form Panel ===== */

.edit-pet-card{
max-width:640px;
margin:80px auto;
background:rgba(255,255,255,.85);
padding:42px 48px;
border-radius:28px;
backdrop-filter:blur(10px);
box-shadow:
0 25px 60px rgba(0,0,0,.12),
0 2px 4px rgba(0,0,0,.06);
border:1px solid rgba(0,0,0,.06);
}

/* title */

.edit-pet-card h2{
font-size:26px;
margin-bottom:25px;
letter-spacing:.4px;
}

/* form rows */

.form-group{
margin-bottom:20px;
display:flex;
flex-direction:column;
}

/* labels */

.form-group label{
font-size:14px;
font-weight:600;
margin-bottom:6px;
color:#555;
}

/* inputs */

.form-group input{
padding:12px 14px;
border-radius:10px;
border:1px solid #ddd;
font-size:15px;
transition:.25s;
background:white;
}

/* input focus */

.form-group input:focus{
outline:none;
border-color:#ffcc00;
box-shadow:0 0 0 4px rgba(255,204,0,.2);
}

/* button */

.save-btn{
margin-top:10px;
background:linear-gradient(135deg,#ffcc00,#f4b400);
border:none;
padding:12px 30px;
border-radius:22px;
font-weight:600;
cursor:pointer;
box-shadow:0 8px 18px rgba(255,204,0,.45);
transition:.25s;
}

/* button hover */

.save-btn:hover{
transform:translateY(-2px);
box-shadow:0 12px 28px rgba(255,204,0,.55);
}

/* responsive */

@media(max-width:600px){

.edit-pet-card{
margin:40px 20px;
padding:30px;
}

}

/* ===== Dashboard Stats ===== */

.stats-grid{
max-width:900px;
margin:40px auto 10px auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:18px;
}

.stat-card{
background:rgba(255,255,255,.85);
border-radius:18px;
padding:18px 20px;
backdrop-filter:blur(6px);
box-shadow:
0 12px 30px rgba(0,0,0,.08),
0 2px 4px rgba(0,0,0,.05);
border:1px solid rgba(0,0,0,.05);
transition:.25s;
}

.stat-card:hover{
transform:translateY(-3px);
box-shadow:0 18px 40px rgba(0,0,0,.12);
}

.stat-title{
font-size:13px;
color:#777;
margin-bottom:6px;
}

.stat-value{
font-size:26px;
font-weight:700;
color:#222;
}

/* back link */

.back-dashboard{
display:inline-block;
margin:30px 40px 10px;
text-decoration:none;
color:#444;
font-weight:500;
}

.back-dashboard:hover{
color:#000;
}

</style>
</head>


<body>

<a href="dashboard.php" class="back-dashboard">
← Back to Dashboard
</a>

<div class="stats-grid">

<div class="stat-card">
<div class="stat-title">Total Pets</div>
<div class="stat-value counter" data-count="<?=$total_pets?>">0</div>
</div>
<div class="stat-card">
<div class="stat-title">Appointments</div>
<div class="stat-value counter" data-count="<?=$total_appointments?>">0</div>
</div>

<div class="stat-card">
<div class="stat-title">Vaccinations</div>
<div class="stat-value counter" data-count="<?=$total_vaccines?>">0</div>
</div>

<div class="stat-card">
<div class="stat-title">Groomings</div>
<div class="stat-value counter" data-count="<?=$total_grooming?>">0</div>
</div>

</div>

<div class="edit-pet-card">

<h2>Edit Pet</h2>

<form method="POST">

<div class="form-group">
<label>Name</label>
<input type="text" name="pet_name" value="<?=$pet['pet_name']?>" required>
</div>

<div style="margin-bottom:15px;">
<label>Breed</label>
<input type="text" name="breed" value="<?=$pet['breed']?>">
</div>

<div style="margin-bottom:15px;">
<label>Weight</label>
<input type="text" name="weight" value="<?=$pet['weight']?>">
</div>

<div style="margin-bottom:15px;">
<label>Color</label>
<input type="text" name="color" value="<?=$pet['color']?>">
</div>

<button type="submit" class="save-btn">
Save Changes
</button>

</form>

</div>


<script>

document.querySelectorAll('.counter').forEach(counter => {

let target = +counter.getAttribute('data-count');
let count = 0;
let speed = target / 40;

let update = () => {

count += speed;

if(count < target){
counter.innerText = Math.floor(count);
requestAnimationFrame(update);
}else{
counter.innerText = target;
}

};

update();

});

</script>


</body>
</html>