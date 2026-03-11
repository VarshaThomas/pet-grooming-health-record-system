<!DOCTYPE html>
<html>
<head>
<title>Login – PetCare</title>
<link rel="stylesheet" href="css/auth.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<!-- floating pets -->
<img src="images/pet10.jpg" class="bg-pet bg1">
<img src="images/pet11.jpg" class="bg-pet bg2">
<img src="images/pet6.jpg"  class="bg-pet bg3">
<img src="images/pet7.jpg"  class="bg-pet bg4">

<div class="glass"></div>
<div class="light light1"></div>
<div class="light light2"></div>
<div class="light light3"></div>

<div class="love-float l1">❤</div>
<div class="love-float l2">🐾</div>
<div class="love-float l3">🐶</div>
<div class="love-float l4">❤</div>
<div class="love-float l5">🐾</div>
<div class="love-float l6">🐕</div>
<div class="love-float l7">❤</div>
<div class="love-float l8">🐾</div>
<div class="love-float l1">❤</div>
<div class="love-float l2">🐾</div>
<div class="love-float l3">🐶</div>
<div class="love-float l4">❤</div>
<div class="love-float l5">🐾</div>
<div class="love-float l6">🐕</div>
<div class="love-float l7">❤</div>
<div class="love-float l8">🐾</div>

<div class="login-wrap">

<div style="
background:#fff;
width:360px;
padding:45px;
border-radius:25px;
text-align:center;
box-shadow:0 30px 80px rgba(0,0,0,.15)
">

<h2>Welcome Back 🐾</h2>
<p style="opacity:.7">Login to manage your pets & appointments</p>

<form method="post" action="core/login_process.php">

<input type="email" name="email" placeholder="Email"
style="width:100%;padding:14px;border-radius:12px;border:1px solid #ddd;margin:12px 0">

<div class="password-field">

<input type="password" id="password" name="password" placeholder="Password"
style="width:100%;padding:14px;border-radius:12px;border:1px solid #ddd;margin:12px 0">

<span class="eye-toggle" onclick="togglePassword()">👁</span>

</div>
<button style="
width:100%;
padding:14px;
border:none;
border-radius:20px;
background:linear-gradient(135deg,#ff4d9a,#e11d74);
color:#fff;
font-weight:600;
margin-top:15px;
cursor:pointer;
box-shadow:0 10px 30px rgba(225,29,116,.45);
transition:all .25s ease"
onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 18px 40px rgba(225,29,116,.6)'"
onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 30px rgba(225,29,116,.45)'"
>Login</button>

<p style="margin-top:20px;font-size:14px">
New user? <a href="register.php">Create Account</a>
</p>

</form>
</div>
</div>

<script>
document.addEventListener("mousemove", e=>{
document.body.style.background =
`radial-gradient(circle at ${e.clientX}px ${e.clientY}px,
rgba(255,255,255,.25),
transparent 40%),
radial-gradient(circle at top left,#ffe3d1,#ffd6c2,#ffc1a6)`
})
</script>

<script>

const card = document.querySelector(".login-wrap > div");

card.addEventListener("mousemove", (e)=>{

const rect = card.getBoundingClientRect();

const x = e.clientX - rect.left;
const y = e.clientY - rect.top;

const centerX = rect.width / 2;
const centerY = rect.height / 2;

const rotateX = (y - centerY) / 12;
const rotateY = (centerX - x) / 12;

card.style.transform =
`rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

});

card.addEventListener("mouseleave", ()=>{
card.style.transform = "rotateX(0) rotateY(0)";
});

</script>

<script>

function togglePassword(){

const pass = document.getElementById("password");

if(pass.type === "password"){
pass.type = "text";
}else{
pass.type = "password";
}

}

</script>

</body>
</html>
