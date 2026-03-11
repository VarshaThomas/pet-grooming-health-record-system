<?php
session_start();
include 'config/db.php';

/* AUTH */
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = intval($_SESSION['user_id']);
$pet_id  = intval($_GET['pet_id'] ?? 0);

if (!$pet_id) {
  die("Invalid pet");
}

/* SECURITY */
$pet = mysqli_fetch_assoc(
  mysqli_query($conn, "
    SELECT pet_name 
    FROM tbl_pet 
    WHERE pet_id=$pet_id AND user_id=$user_id
  ")
);

if (!$pet) {
  die("Pet not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Health Note</title>

<link rel="stylesheet" href="css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<a href="pet_profile.php?pet_id=<?=$pet_id?>" style="margin:24px 48px;display:inline-block">
  ← Back to <?=htmlspecialchars($pet['pet_name'])?>
</a>

<section class="section glass" style="max-width:540px;margin:0 auto">

<h2 style="margin-bottom:6px">📝 Add Health Note</h2>
<p class="muted" style="margin-bottom:20px">
  These notes help doctors & groomers understand your pet better
</p>

<form method="post" action="core/save_health_note.php">

  <textarea
    name="note"
    required
    rows="6"
    placeholder="Eg: Loss of appetite, limping, unusual behaviour..."
    style="
      width:100%;
      padding:16px;
      border-radius:16px;
      border:1px solid #ddd;
      font-family:Poppins;
      resize:none
    "
  ></textarea>

  <input type="hidden" name="pet_id" value="<?=$pet_id?>">

  <div style="margin-top:18px">
    <button
      style="
        background:#ffcc00;
        border:none;
        padding:12px 28px;
        border-radius:20px;
        font-weight:600;
        cursor:pointer
      "
    >
      Save Note
    </button>
  </div>

</form>

</section>

<footer class="footer glass" style="margin-top:60px">
  <span>© 2026 PetCare</span>
  <span>Health first. Always 🐾</span>
</footer>

</body>
</html>
