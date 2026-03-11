<!DOCTYPE html>
<html>
<head>
<title>Create Account – PetCare</title>
<link rel="stylesheet" href="css/auth.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<img src="images/pet10.jpg" class="bg-pet bg1">
<img src="images/pet11.jpg" class="bg-pet bg2">

<div class="glass"></div>
<div class="light light1"></div>
<div class="light light2"></div>

<div class="love-float l1">❤</div>
<div class="love-float l2">🐾</div>
<div class="love-float l3">🐶</div>
<div class="love-float l4">❤</div>

<div class="login-box">

<h2>Create Account 🐾</h2>
<p class="sub">Join PetCare and manage your furry family</p>

<form method="post" action="core/register_process.php">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="text" name="phone" placeholder="Phone Number" 
       pattern="[0-9]{10}" title="Enter 10 digit phone number" required>

<textarea name="address" placeholder="Address" rows="3" required></textarea>

<input type="password" name="password" placeholder="Create Password" required>

<input type="password" name="confirm_password" placeholder="Confirm Password" required>

<button>Create Account</button>

<p class="alt">
Already have an account? <a href="login.php">Login</a>
</p>

</form>

</div>


<div id="toast"></div>

<script>
function showToast(message,type="success"){
const toast=document.getElementById("toast");

toast.innerText=message;

toast.className="show "+type;

setTimeout(()=>{
toast.className="";
},3500);
}
</script>


</body>
</html>
