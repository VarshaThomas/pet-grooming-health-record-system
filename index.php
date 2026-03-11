
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PetCare – Professional Grooming</title>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/motion.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Great+Vibes&display=swap" rel="stylesheet">
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

<div class="hamburger">
<span></span>
<span></span>
<span></span>
</div>
</header>

<section class="hero">

<img src="images/cloud1.png" class="cloud c1">
<img src="images/cloud2.png" class="cloud c2">
<img src="images/cloud3.png" class="cloud c3">
<img src="images/cloud1.png" class="cloud c4">
<img src="images/cloud2.png" class="cloud c5">
<img src="images/cloud3.png" class="cloud c6">
<img src="images/cloud1.png" class="cloud c7">
<img src="images/cloud2.png" class="cloud c8">

<div class="orb o1"></div>
<div class="orb o2"></div>

<div class="home-love l4">❤</div>
<div class="pet-float pf1">🐶</div>
<div class="pet-float pf2">🐱</div>
<div class="pet-float pf3">🐾</div>

<div class="hero-overlay">
<h1>Premium Pet Grooming & Veterinary Care</h1>

<p class="hero-sub">
Where luxury meets love for your furry family.<br>
Certified groomers • Emergency support • Hygienic care • Home pickup
</p>

<div class="hero-features">
<span>✔ Certified Groomers</span>
<span>✔ Emergency Appointments</span>
<span>✔ Home Pickup</span>
<span>✔ Online Payments</span>
</div>

<a href="register.php" class="cta">Register Your Pet</a>
</div>

<div class="scroll-indicator"></div>
</section>

<section class="pinterest-services">

<h2>Luxury Grooming Services</h2>

<div class="pinterest-grid">

<div class="pin-card large">
<img src="assets/pets/pet21.jpg">
<div class="pin-info">
<h3>Premium Spa Bath</h3>
<p>Luxury cleansing and coat nourishment</p>
</div>
</div>

<div class="pin-card">
<img src="assets/pets/pet10.jpg">
<div class="pin-info">
<h3>Designer Haircut</h3>
</div>
</div>

<div class="pin-card">
<img src="assets/pets/pet19.jpg">
<div class="pin-info">
<h3>Veterinary Checkup</h3>
</div>
</div>

<div class="pin-card tall">
<img src="assets/pets/pet22.jpg">
<div class="pin-info">
<h3>Pet Massage Therapy</h3>
</div>
</div>

</div>
</section>

<section class="happy">
<h2>Our Happy Pets</h2>
<p class="happy-sub">Some of our adorable clients who enjoyed spa-grade grooming & premium care</p>

<div class="pet-grid">
<?php
$names=["Tiger","Ruby","Shadow","Lucy","Oscar","Buddy","Molly","Zoro","Choco","Lilly","Scooby","Pinky","Bolt","Daisy","Neko"];
$i=1;
foreach($names as $name){
?>
<div class="pet-card">
<img src="images/pet<?= $i ?>.jpg">
<div class="pet-info">
<h3><?= $name ?></h3>
<p>Luxury grooming • Deep care • Happy paws</p>
</div>
</div>
<?php $i++; } ?>
</div>
</section>

<section class="why">
<h2>Why Pet Parents Love PetCare</h2>
<p class="why-sub">
Because your pet deserves more than just grooming — they deserve love, safety, hygiene and comfort.
</p>

<div class="why-grid">
<div>🐾 10,000+ Happy Pets</div>
<div>⭐ 4.9 Star Rated on Google</div>
<div>🩺 24/7 Emergency Vet Support</div>
<div>🏠 Doorstep Home Visit Service</div>
</div>

<div class="why-desc">
<p>
PetCare is trusted by hundreds of families for professional pet grooming, spa treatments, vaccinations,
medical consultations and emergency care. We follow strict hygiene standards and only certified groomers
handle your furry companions.
</p>
<p>
From first-time puppy grooming to senior pet medical care, we deliver love, safety and comfort with
premium quality products and gentle hands.
</p>
</div>
</section>


<footer class="footer">
<div class="footer-grid">

<div>
<h3>PetCare</h3>
<p>Premium grooming, veterinary care and home visit services that make your pets feel safe, healthy and loved.</p>
</div>

<div>
<h4>Quick Links</h4>
<a href="index.php">Home</a>
<a href="book.php">Book Appointment</a>
<a href="services.php">Services</a>
<a href="contact.php">Contact</a>
</div>

<div>
<h4>Contact</h4>
<p>📞 +91 8848244142</p>
<p>📧 support@petcare.com</p>
<p>📍 Kochi, Kerala</p>
</div>
</div>

<div class="copyright">© 2026 PetCare. All Rights Reserved.</div>
</footer>

<script src="js/reveal.js"></script>
<script>

document.querySelectorAll(".pin-card").forEach(card=>{

card.addEventListener("mousemove",e=>{
const rect=card.getBoundingClientRect();
const x=e.clientX-rect.left;
const y=e.clientY-rect.top;

const rotateX=(y-rect.height/2)/12;
const rotateY=(rect.width/2-x)/12;

card.style.transform=`rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
});

card.addEventListener("mouseleave",()=>{
card.style.transform="rotateX(0) rotateY(0)";
});

});

</script>
<script>

document.querySelectorAll("nav a").forEach(link=>{
if(link.href===window.location.href){
link.classList.add("active");
}
});

</script>
<script>
window.addEventListener("scroll",()=>{
document.querySelector(".topbar")
.classList.toggle("scrolled",window.scrollY>30);
});
</script>


</body>
</html>
