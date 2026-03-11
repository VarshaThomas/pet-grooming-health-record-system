<!DOCTYPE html>
<html>
<head>
<title>About | PetCare</title>
<link rel="stylesheet" href="css/home.css">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

<style>

.about-section{
padding:120px 12%;
background:white;
}

.about-title{
font-size:40px;
text-align:center;
margin-bottom:40px;
color:#d4af37;
}

.about-grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:60px;
align-items:center;
}

.about-text p{
line-height:1.8;
margin-bottom:18px;
color:#444;
}

.about-img img{
width:100%;
border-radius:16px;
}

.stats{
margin-top:70px;
display:flex;
justify-content:center;
gap:60px;
text-align:center;
}

.stat h2{
font-size:32px;
color:#d4af37;
}

.stat p{
color:#666;
}

</style>
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

<section class="about-section">

<h1 class="about-title">About PetCare</h1>

<div class="about-grid">

<div class="about-text">

<p>
PetCare is a premium pet grooming and veterinary care center dedicated to the health,
comfort, and happiness of your pets.
</p>

<p>
Our team includes certified groomers, veterinary professionals,
and animal care specialists who understand the unique needs of every pet.
</p>

<p>
We combine modern grooming techniques, medical care, and compassionate handling
to create a safe and relaxing experience for your furry companions.
</p>

<p>
From luxury spa grooming to professional veterinary consultations,
PetCare provides complete wellness solutions under one roof.
</p>

</div>

<div class="about-img">
<img src="images/pet10.jpg">
</div>

</div>

<div class="stats">

<div class="stat">
<h2>10,000+</h2>
<p>Pets Groomed</p>
</div>

<div class="stat">
<h2>5+</h2>
<p>Years Experience</p>
</div>

<div class="stat">
<h2>98%</h2>
<p>Happy Customers</p>
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