<?php
session_start();
include 'config/db.php';

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];

/* FETCH PETS */
$pets = mysqli_query(
    $conn,
    "SELECT * FROM tbl_pet 
     WHERE user_id=$user_id 
     AND approved=1
     ORDER BY pet_id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Pets</title>

<link rel="stylesheet" href="css/pets-ui.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="pet-container">

<?php if (mysqli_num_rows($pets) == 0) { ?>
  <div class="pet-card">
    <div class="pet-info">
      <h3>No pets yet 🐾</h3>
      <p>Add your first pet to get started</p>
    </div>
  </div>
<?php } ?>

<?php while ($p = mysqli_fetch_assoc($pets)) {
    $image = !empty($p['image']) ? $p['image'] : 'default.jpg';
?>
  <div class="pet-card">
    <img src="assets/pets/<?= htmlspecialchars($image) ?>" alt="Pet image">

    <div class="pet-info">
      <h3><?= htmlspecialchars($p['pet_name']) ?></h3>
      <p><?= htmlspecialchars($p['species']) ?> • <?= htmlspecialchars($p['gender']) ?></p>
      <p>Age: <?= htmlspecialchars($p['age']) ?> years</p>
    </div>
  </div>
<?php } ?>

<a href="add_pet.php">➕ Add Pet</a>

</div>

<script src="js/pets-ui.js"></script>
</body>
</html>
