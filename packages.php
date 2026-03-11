<!DOCTYPE html>
<html>
<head>
<title>Pet Grooming Packages</title>
<link rel="stylesheet" href="css/home.css">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

<header class="topbar">
<div class="logo">PetCare</div>

<nav>
<a href="index.php">Home</a>
<a href="services.php">Services</a>
<a href="packages.php">Packages</a>
<a href="gallery.php">Gallery</a>
<a href="about.php">About</a>
<a href="contact.php">Contact</a>
<a class="login-btn" href="login.php">Login</a>
</nav>
</header>

<section class="packages-page">

<h1>Our Grooming Packages</h1>

<div class="package-grid">

<div class="package-card">
<h3>Basic Groom</h3>
<p>Bath + Nail Trim</p>
<div class="package-price">₹499</div>
</div>

<div class="package-card">
<h3>Premium Spa</h3>
<p>Bath + Haircut + Massage</p>
<div class="package-price">₹999</div>
</div>

<div class="package-card">
<h3>Elite Groom</h3>
<p>Full Spa + Styling</p>
<div class="package-price">₹1499</div>
</div>

<div class="package-card">
<h3>Luxury Package</h3>
<p>Spa + Styling + Vet Check</p>
<div class="package-price">₹2499</div>
</div>

</div>

</section>
<script>
window.addEventListener("scroll",()=>{
document.querySelector(".topbar")
.classList.toggle("scrolled",window.scrollY>30);
});
</script>
</body>
</html>