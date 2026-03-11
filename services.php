<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Services | PetCare</title>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/services.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

<header class="topbar">

<div class="logo">PetCare</div>

<nav>
<a href="index.php">Home</a>
<a class="active" href="services.php">Services</a>
<a href="packages.php">Packages</a>
<a href="gallery.php">Gallery</a>
<a href="about.php">About</a>
<a href="contact.php">Contact</a>
<a class="login-btn" href="login.php">Login</a>
</nav>

<div class="hamburger">
<span></span>
<span></span>
<span></span>
</div>

</header>

<section class="services">

<div class="paw-snow"></div>
<h1>Premium Services 🐾</h1>
<p class="sub">Luxury grooming, medical care & comfort — all under one roof</p>

<div class="service-grid">

<div class="glass-card">
<img src="images/services/grooming.jpg">
<h3>Full Grooming</h3>
<p>Bath • Haircut • Nail trim • Ear cleaning</p>
</div>

<div class="glass-card">
<img src="images/services/vet.jpg">
<h3>Veterinary Care</h3>
<p>Health checkups • Vaccination • Consultation</p>
</div>

<div class="glass-card">
<img src="images/services/emergency.jpg">
<h3>Emergency Support</h3>
<p>24/7 emergency response for critical care</p>
</div>

<div class="glass-card">
<img src="images/services/pickup.jpg">
<h3>Home Pickup</h3>
<p>Safe doorstep pickup & drop service</p>
</div>


<div class="glass-card">
<img src="images/services/spa.jpg">
<h3>Spa & Relax</h3>
<p>Massage • Aromatherapy • Stress relief</p>
</div>

<div class="glass-card">
<img src="images/services/boarding.jpg">
<h3>Pet Boarding</h3>
<p>Clean,safe & monitored boarding facility</p>
</div>

</div>
</section>

<script src="js/glass.js"></script>
<script>
window.addEventListener("scroll",()=>{
document.querySelector(".topbar")
.classList.toggle("scrolled",window.scrollY>30);
});
</script>
</body>
</html>
