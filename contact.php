<?php
include 'config/db.php';

if(isset($_POST['email'])){

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

mysqli_query($conn,"
INSERT INTO contact_messages(name,email,message)
VALUES('$name','$email','$message')
");

}
?>
<!DOCTYPE html>
<html>
<head>

<title>Contact | PetCare</title>
<link rel="stylesheet" href="css/home.css">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<style>

.contact-section{
background:#0f0f0f;
min-height:100vh;
padding:120px 10%;
display:flex;
justify-content:center;
align-items:center;
}

.contact-section::before{
content:"";
position:absolute;
width:600px;
height:600px;
background:radial-gradient(circle,#d4af3730,transparent 70%);
top:20%;
left:20%;
filter:blur(120px);
animation:goldMove 18s infinite linear;
}

@keyframes goldMove{
0%{transform:translate(0,0)}
50%{transform:translate(200px,120px)}
100%{transform:translate(0,0)}
}

.contact-card{
background:white;
padding:60px;
border-radius:18px;
width:420px;
text-align:center;
box-shadow:0 20px 60px rgba(0,0,0,.3);
backdrop-filter: blur(6px);
border:1px solid rgba(212,175,55,0.25);
}

.contact-card h1{
margin-bottom:15px;
color:#d4af37;
}

.contact-card input,
.contact-card textarea{
width:100%;
padding:14px;
margin-top:15px;
border-radius:8px;
border:1px solid #ddd;
font-family:Poppins;
}

.contact-card button{
margin-top:20px;
background:#d4af37;
border:none;
padding:14px 30px;
border-radius:30px;
cursor:pointer;
}

.contact-info{
margin-top:30px;
color:#666;
}

.pet-float{
position:absolute;
width:130px;
border-radius:16px;
overflow:hidden;
box-shadow:0 10px 40px rgba(0,0,0,.6);
filter:blur(1px);
opacity:.7;
animation:floatPet 10s ease-in-out infinite;
}

.pet-float img{
width:100%;
height:100%;
object-fit:cover;
}

@keyframes floatPet{
0%{transform:translateY(0)}
50%{transform:translateY(-25px)}
100%{transform:translateY(0)}
}

.heart{
position:absolute;
color:#d4af37;
font-size:14px;
opacity:.7;
animation:heartFloat 8s linear infinite;
}

@keyframes heartFloat{
0%{
transform:translateY(0);
opacity:0;
}
50%{
opacity:1;
}
100%{
transform:translateY(-200px);
opacity:0;
}
}

/* CURSOR GOLD PARTICLES */

.gold-particle{
position:fixed;
width:6px;
height:6px;
background:#d4af37;
border-radius:50%;
pointer-events:none;
box-shadow:0 0 10px #d4af37, 0 0 20px #d4af3750;
animation:fadeParticle 1.2s ease-out forwards;
z-index:9999;
}

@keyframes fadeParticle{
0%{
opacity:1;
transform:scale(1);
}
100%{
opacity:0;
transform:scale(.2) translateY(-20px);
}
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

<section class="contact-section">

<!-- FLOATING PET CARDS -->

<div class="pet-float" style="left:8%;top:200px;">
<img src="images/pet3.jpg">
</div>

<div class="pet-float" style="right:8%;top:260px;">
<img src="images/pet4.jpg">
</div>

<div class="pet-float" style="left:12%;bottom:120px;">
<img src="images/pet10.jpg">
</div>

<div class="pet-float" style="right:12%;bottom:160px;">
<img src="images/pet11.jpg">
</div>


<!-- FLOATING HEARTS -->

<div class="heart" style="left:15%;top:70%;">❤</div>
<div class="heart" style="left:85%;top:60%;animation-delay:2s;">❤</div>
<div class="heart" style="left:30%;top:80%;animation-delay:4s;">❤</div>
<div class="heart" style="left:70%;top:75%;animation-delay:6s;">❤</div>

<div class="contact-card">

<h1>Contact Us</h1>

<p>We'd love to hear from you.</p>

<form method="POST">

<input type="text" name="name" placeholder="Your Name">

<input type="email" name="email" placeholder="Email">

<textarea name="message" rows="4" placeholder="Message"></textarea>

<button>Send Message</button>

</form>

<div class="contact-info">

<p>📞 +91 8848244142</p>

<p>📧 support@petcare.com</p>

<p>📍 Kochi, Kerala</p>

</div>

</div>

</section>


<script>

/* GOLDEN CURSOR PARTICLE TRAIL */

document.addEventListener("mousemove", function(e){

const particle=document.createElement("div");
particle.className="gold-particle";

particle.style.left=e.clientX+"px";
particle.style.top=e.clientY+"px";

document.body.appendChild(particle);

setTimeout(()=>{
particle.remove();
},1200);

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