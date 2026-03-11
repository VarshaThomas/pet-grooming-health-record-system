<!DOCTYPE html>
<html>
<head>
<title>Gallery | PetCare</title>

<link rel="stylesheet" href="css/home.css">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<style>

.gallery-wrapper{
padding:120px 10%;
background:#0f0f0f;
color:white;
}

.gallery-title{
text-align:center;
font-size:38px;
margin-bottom:60px;
color:#d4af37;
}

/* GOLD PREMIUM FRAME */

.masonry{
column-count:4;
column-gap:16px;
}

.masonry img{
position:relative;
border:2px solid rgba(212,175,55,0.3);
box-shadow:0 10px 25px rgba(0,0,0,.5);
width:100%;
margin-bottom:16px;
border-radius:14px;
transition:.35s;
}

.masonry img:hover{
transform:scale(1.06);
box-shadow:
0 15px 35px rgba(0,0,0,.8),
0 0 15px rgba(212,175,55,.5);
border-color:#d4af37;
}

@media(max-width:1000px){
.masonry{column-count:3}
}

@media(max-width:700px){
.masonry{column-count:2}
}

/* PREMIUM GALLERY UPGRADE */

.gallery-wrapper{
position:relative;
overflow:hidden;
}

/* GOLD BACKGROUND GLOW */

.gallery-wrapper::before{
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

/* PINTEREST CARD STYLE */

.masonry img{
cursor:pointer;
border:1px solid rgba(212,175,55,.2);
box-shadow:0 15px 40px rgba(0,0,0,.7);
}

/* PREMIUM HOVER */

.masonry img:hover{
transform:scale(1.06);
box-shadow:
0 20px 60px rgba(0,0,0,.8),
0 0 20px rgba(212,175,55,.4);
}

/* GOLD BORDER ANIMATION */

.masonry img{
position:relative;
}

.masonry img::before{
content:"";
position:absolute;
inset:-2px;
border-radius:14px;
background:linear-gradient(
120deg,
transparent,
#d4af37,
transparent
);
background-size:300% 300%;
animation:goldBorder 8s linear infinite;
z-index:-1;
}

/* FLOATING GOLD PARTICLES */

.gold-dot{
position:absolute;
width:4px;
height:4px;
background:#d4af37;
border-radius:50%;
opacity:.6;
animation:goldFloat 10s linear infinite;
box-shadow:0 0 10px #d4af37,
0 0 20px #d4af37;
}

@keyframes goldFloat{
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

/* ---------- EXTRA PREMIUM UPGRADE ---------- */

/* smooth pinterest zoom */
.masonry img{
transition: transform .45s cubic-bezier(.2,.8,.2,1),
box-shadow .45s,
filter .45s;
}

.masonry img:hover{
transform:scale(1.08) translateY(-6px);
filter:brightness(1.05);
}

/* gold shine sweep */

.masonry img{
overflow:hidden;
}

.masonry img::after{
content:"";
position:absolute;
top:0;
left:-120%;
width:60%;
height:100%;
background:linear-gradient(
120deg,
transparent,
rgba(212,175,55,.45),
transparent
);
transform:skewX(-25deg);
transition:.8s;
}

.masonry img:hover::after{
left:140%;
}

/* premium floating glow orbs */

.gallery-wrapper::after{
content:"";
position:absolute;
width:500px;
height:500px;
background:radial-gradient(circle,#d4af3725,transparent 70%);
bottom:0;
right:0;
filter:blur(120px);
animation:goldMove2 22s infinite linear;
}

@keyframes goldMove2{
0%{transform:translate(0,0)}
50%{transform:translate(-150px,-120px)}
100%{transform:translate(0,0)}
}

/* stronger luxury depth */

.masonry img{
box-shadow:
0 10px 30px rgba(0,0,0,.7),
0 0 0 rgba(212,175,55,0);
}

.masonry img:hover{
box-shadow:
0 30px 80px rgba(0,0,0,.9),
0 0 25px rgba(212,175,55,.4);
}

/* lightbox animation */

@keyframes fadeIn{
from{opacity:0}
to{opacity:1}
}

/* PINTEREST HOVER OVERLAY */

.pet-card{
position:relative;
break-inside:avoid;
margin-bottom:18px;
}

.pet-card img{
width:100%;
display:block;
border-radius:14px;
height:auto;
object-fit:cover;
}

.pet-overlay{
position:absolute;
bottom:0;
left:0;
right:0;
padding:18px;
border-radius:0 0 14px 14px;
background:linear-gradient(
to top,
rgba(0,0,0,.85),
rgba(0,0,0,.4),
transparent
);
color:white;
opacity:0;
transform:translateY(15px);
transition:.35s;
font-size:14px;
}

.pet-card:hover .pet-overlay{
opacity:1;
transform:translateY(0);
}

.pet-overlay h3{
font-size:16px;
color:#d4af37;
margin-bottom:5px;
}

.pet-overlay span{
display:block;
font-size:13px;
opacity:.9;
}

/* GOLD TITLE GLOW */

.gallery-title{
text-shadow:
0 0 8px rgba(212,175,55,.6),
0 0 20px rgba(212,175,55,.4);
}
.pet-card:hover img{
transform:scale(1.05);
}

/* PINTEREST UNEVEN LAYOUT */

.pet-card:nth-child(3n) img{
height:420px;
object-fit:cover;
}

.pet-card:nth-child(4n) img{
height:300px;
object-fit:cover;
}

.pet-card:nth-child(5n) img{
height:500px;
object-fit:cover;
}

/* FOCUS EFFECT (dim other images) */

.masonry:hover .pet-card{
opacity:.55;
filter:blur(1px);
transition:.35s;
}

.masonry .pet-card:hover{
opacity:1;
filter:none;
transform:scale(1.06);
z-index:5;
}

.pet-card:hover{
box-shadow:
0 35px 90px rgba(0,0,0,.9),
0 0 30px rgba(212,175,55,.5);
}

/* SAAS CARD GLASS REFLECTION */

.pet-card{
position:relative;
}

.pet-card::after{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
border-radius:14px;
background:linear-gradient(
120deg,
rgba(255,255,255,.18),
transparent 30%,
transparent 70%,
rgba(255,255,255,.12)
);
pointer-events:none;
opacity:.35;
}

/* ULTRA SMOOTH SAAS HOVER */

.pet-card{
transition:
transform .55s cubic-bezier(.19,1,.22,1),
box-shadow .55s,
filter .55s;
}
/* DEPTH LAYER EFFECT */

.masonry{
perspective:1200px;
}

.pet-card:hover{
transform:
translateY(-10px)
scale(1.08)
translateZ(40px);
}

/* LUXURY SHADOW */

.pet-card{
box-shadow:
0 12px 35px rgba(0,0,0,.7),
0 0 0 rgba(212,175,55,0);
}

.pet-card:hover{
box-shadow:
0 40px 120px rgba(0,0,0,.95),
0 0 30px rgba(212,175,55,.35);
}

/* SUBTLE IMAGE BREATHING */

@keyframes cardFloat{
0%{transform:translateY(0)}
50%{transform:translateY(-3px)}
100%{transform:translateY(0)}
}

.pet-card{
animation:cardFloat 6s ease-in-out infinite;
}

/* PREMIUM OVERLAY GLOW */

.pet-overlay{
backdrop-filter:blur(6px);
border-top:1px solid rgba(212,175,55,.2);
box-shadow:inset 0 10px 30px rgba(0,0,0,.6);
}

/* =========================
   GOLD PARTICLE SYSTEM
========================= */

.gold-particle{
position:absolute;
width:4px;
height:4px;
background:#d4af37;
border-radius:50%;
pointer-events:none;

box-shadow:
0 0 6px #d4af37,
0 0 12px rgba(212,175,55,.8),
0 0 20px rgba(212,175,55,.6);

animation:particleFloat linear infinite;
opacity:.8;
}

@keyframes particleFloat{
0%{
transform:translateY(0) scale(.6);
opacity:0;
}

20%{
opacity:1;
}

100%{
transform:translateY(-300px) scale(1);
opacity:0;
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

<section class="gallery-wrapper">

<!-- GOLD FLOAT PARTICLES -->

<div class="gold-dot" style="left:15%;top:80%;animation-delay:0s"></div>
<div class="gold-dot" style="left:30%;top:90%;animation-delay:2s"></div>
<div class="gold-dot" style="left:50%;top:85%;animation-delay:4s"></div>
<div class="gold-dot" style="left:70%;top:95%;animation-delay:6s"></div>
<div class="gold-dot" style="left:85%;top:88%;animation-delay:3s"></div>

<h1 class="gallery-title">Our Grooming Gallery</h1>

<div class="masonry">

<?php

$names=[
"Tiger",
"Ruby",
"Shadow",
"Lucy",
"Oscar",
"Buddy",
"Molly",
"Zoro",
"Choco",
"Lilly",
"Scooby",
"Pinky",
"Bolt",
"Daisy",
"Neko"
];

for($i=1;$i<=15;$i++){

echo "
<div class='pet-card'>

<img src='images/pet$i.jpg' alt='{$names[$i-1]}'>

<div class='pet-overlay'>
<h3>{$names[$i-1]}</h3>
<span>⭐ 4.9 Rated</span>
<span>🛁 Luxury Grooming</span>
</div>

</div>
";

}
?>

</div>

</section>


<script>

/* IMAGE LIGHTBOX */

document.querySelectorAll(".masonry img").forEach(img=>{
img.addEventListener("click",()=>{

let overlay=document.createElement("div");
overlay.style.animation="fadeIn .35s ease";
overlay.style.position="fixed";
overlay.style.top="0";
overlay.style.left="0";
overlay.style.width="100%";
overlay.style.height="100%";
overlay.style.background="rgba(0,0,0,.9)";
overlay.style.display="flex";
overlay.style.alignItems="center";
overlay.style.justifyContent="center";
overlay.style.zIndex="9999";

let big=document.createElement("img");
big.src=img.src;
big.style.maxWidth="90%";
big.style.maxHeight="90%";
big.style.borderRadius="12px";
big.style.boxShadow="0 20px 80px rgba(0,0,0,.9)";

overlay.appendChild(big);

overlay.onclick=()=>overlay.remove();

document.body.appendChild(overlay);

});
});

</script>

<script>

/* GOLD PARTICLE GENERATOR */

const gallery = document.querySelector(".gallery-wrapper");

for(let i=0;i<35;i++){

let p = document.createElement("div");
p.className="gold-particle";

p.style.left = Math.random()*100+"%";
p.style.bottom = "-20px";

p.style.animationDuration = (8+Math.random()*8)+"s";
p.style.animationDelay = (Math.random()*10)+"s";

gallery.appendChild(p);

}
</script>
<script>
window.addEventListener("scroll",()=>{
document.querySelector(".topbar")
.classList.toggle("scrolled",window.scrollY>30);
});
</script>
</body>
</html>