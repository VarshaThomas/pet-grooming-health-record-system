<?php include "config/db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>PetCare Feedback</title>
<link rel="stylesheet" href="css/home.css">
</head>

<body>

<header class="topbar">
<div class="logo">PetCare</div>
</header>

<section class="packages">

<h1>Customer Feedback</h1>

<form method="POST">

<input type="text" name="name" placeholder="Your Name" required>

<textarea name="message" placeholder="Write your feedback..." required></textarea>

<button type="submit" class="cta">Submit Feedback</button>

</form>

</section>

</body>
</html>

<?php

if(isset($_POST['name'])){

$name=$_POST['name'];
$msg=$_POST['message'];

mysqli_query($conn,"INSERT INTO tbl_service_feedback(name,message) VALUES('$name','$msg')");

echo "<script>alert('Thank you for feedback')</script>";

}
?>