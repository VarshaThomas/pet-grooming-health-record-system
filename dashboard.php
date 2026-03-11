<?php
session_start();
include 'config/db.php';


if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id   = $_SESSION['user_id'];

/* AUTO REMINDER CHECK */

$reminders = mysqli_query($conn,"
SELECT appointment_id,appointment_date
FROM tbl_appointment
WHERE user_id=$user_id
AND status='Approved'
");

while($r=mysqli_fetch_assoc($reminders)){

$appt = strtotime($r['appointment_date']);
$now = time();

if($appt - $now <= 86400 && $appt - $now > 0){

mysqli_query($conn,"
INSERT INTO tbl_alert_queue(user_id,alert_type,status)
VALUES(
'$user_id',
'Reminder: Appointment tomorrow (".$r['appointment_date'].")',
'pending'
)
");

}

}
$user_name = $_SESSION['user_name'] ?? 'Pet Parent';

/* TIP */
$tips = [
  "Hydration is key for pet health.",
  "Regular grooming reduces stress.",
  "Vaccinations save future costs.",
  "Daily walks improve mental health."
];
$tip = $tips[array_rand($tips)];

/* COUNTS */
$pet_count = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT COUNT(*) c FROM tbl_pet WHERE user_id=$user_id AND approved=1")
)['c'] ?? 0;

$app_count = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT COUNT(*) c FROM tbl_appointment WHERE user_id=$user_id")
)['c'] ?? 0;

$spent = mysqli_fetch_assoc(
  mysqli_query($conn,"
    SELECT IFNULL(SUM(amount),0) total
    FROM tbl_payment
    WHERE user_id=$user_id AND payment_status='Paid'
  ")
)['total'] ?? 0;

/* PETS */
$pets = mysqli_query($conn,"
  SELECT * FROM tbl_pet
  WHERE user_id=$user_id AND approved=1
");

/* APPOINTMENTS – NO created_at */
$apps = mysqli_query($conn,"
  SELECT * FROM tbl_appointment
  WHERE user_id=$user_id
  ORDER BY appointment_date DESC
  LIMIT 5
");

/* CALENDAR EVENTS */
$calendar_apps = mysqli_query($conn,"
SELECT appointment_date
FROM tbl_appointment
WHERE user_id=$user_id
");

/* ALERTS – SAFE */
$alerts = mysqli_query($conn,"
  SELECT * FROM tbl_alert_queue
  WHERE user_id=$user_id AND status='pending'
  ORDER BY alert_id DESC
");

/* SIMPLE AI INSIGHT */

$insight = "";

$q = mysqli_query($conn,"
SELECT pet_name, MAX(appointment_date) last_visit
FROM tbl_pet p
LEFT JOIN tbl_appointment a ON p.pet_id=a.pet_id
WHERE p.user_id=$user_id
GROUP BY p.pet_id
LIMIT 1
");

if($row=mysqli_fetch_assoc($q)){
$days = (time() - strtotime($row['last_visit']))/86400;

if($days > 30){
$insight = $row['pet_name']." may need grooming soon.";
}
}

$messages=mysqli_query($conn,"
SELECT COUNT(*) c
FROM tbl_messages
WHERE user_id='".$_SESSION['user_id']."'
AND status='Unread'
");


$msg=mysqli_fetch_assoc($messages)['c'];

$reminder = mysqli_query($conn,"
SELECT pet_name,next_vaccination_date
FROM tbl_pet
WHERE user_id='$user_id'
AND next_vaccination_date <= DATE_ADD(CURDATE(),INTERVAL 7 DAY)
");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard | PetCare</title>
<link rel="stylesheet" href="css/pastel-base.css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/customer-premium.css">

</head>

<body>
  <img src="images/pet10.jpg" class="bg-img bg1">
  <img src="images/pet11.jpg" class="bg-img bg2">
  <img src="assets/pets/pet4.jpg" class="bg-float bg1">
  <img src="assets/pets/pet12.jpg" class="bg-float bg2">



<header class="topbar glass">

<div class="logo">🐾 PetCare</div>

<nav class="tabs">
<a class="active">Dashboard</a>
<a href="pets.php">My Pets</a>
<a href="book.php">Book</a>
<a href="messages.php" class="<?= $msg>0 ? 'msg-alert' : '' ?>">
📩 Messages
<?php if($msg>0){ ?>
<span id="msgCount" class="msg-badge"><?= $msg ?></span>
<?php } ?>
</a>
<a href="payment_history.php">Payments</a>
</nav>

<div class="user-box">
<div class="avatar">
<?= strtoupper(substr($user_name,0,1)) ?>
</div>
<span class="username"><?=htmlspecialchars($user_name)?></span>
<a href="logout.php" class="logout-btn">Logout</a>
</div>

</header>

<div class="tip glass">
  💡 <b>Pet Care Tip:</b> <?=htmlspecialchars($tip)?>
</div>

<section class="hero glass">
  <h1>Hello, <?=htmlspecialchars($user_name)?> 👋</h1>
  <p>Your pets’ world, beautifully organized.</p>
  <div class="actions">
    <a href="add_pet.php" class="btn">➕ Add Pet</a>
    <a href="book.php" class="btn">📅 Book Appointment</a>
  </div>
</section>

<?php if($insight!=""){ ?>

<div class="tip glass">
🧠 <b>AI Insight:</b> <?=htmlspecialchars($insight)?>
</div>

<?php } ?>

<section class="stats">
  <div class="stat glass">
   <h2 class="count"><?=$pet_count?></h2>
    <span>Pets</span>
  </div>
  <div class="stat glass">
    <h2 class="count"><?=$app_count?></h2>
    <span>Appointments</span>
  </div>
  <div class="stat glass">
    <h2 class="count"><?=$spent?></h2>
    <span>Total Spent</span>
  </div>
</section>
<section class="section glass chart-box">
  <h2 class="title">📊 Spending Overview</h2>

  <div class="chart-container">
    <canvas id="spendingChart"></canvas>
  </div>
</section>


<?php if(mysqli_num_rows($alerts)>0){ ?>
<section class="alerts">
  <?php while($a=mysqli_fetch_assoc($alerts)){ ?>
    <div class="alert glass">
      🔔 <?=htmlspecialchars($a['alert_type'])?>
    </div>
  <?php } ?>
</section>
<?php } ?>

<h2 class="title">🐶 Your Pets</h2>
<section class="section glass">
<?php if(mysqli_num_rows($pets)==0){ ?>
  <div class="empty">
    No pets yet<br>
    <a href="add_pet.php">➕ Add your first pet</a>
  </div>
<?php } else { ?>
  <div class="pet-grid">
  <?php while($p=mysqli_fetch_assoc($pets)){ ?>
    <a href="pet_profile.php?pet_id=<?=$p['pet_id']?>" class="pet-card glass">
  <img 
    src="assets/pets/<?=htmlspecialchars($p['image'] ?: 'default.jpg')?>"
    alt="Pet image"
  >
  <h3><?=htmlspecialchars($p['pet_name'])?></h3>
  <small><?=htmlspecialchars($p['species'])?></small>
</a>

  <?php } ?>
  </div>
<?php } ?>
</section>

<h2 class="title">📅 Upcoming Appointments</h2>

<section class="calendar-box glass">

<h3>Appointment Calendar</h3>

<div id="calendar"></div>

</section>

<?php mysqli_data_seek($apps,0); ?>

<section class="timeline glass">

<h3>Recent Activity</h3>

<div class="timeline-line">

<?php
mysqli_data_seek($apps,0);
while($ap=mysqli_fetch_assoc($apps)){
?>

<div class="timeline-item">

<div class="timeline-dot"></div>

<div class="timeline-content">
<b><?=htmlspecialchars($ap['appointment_date'])?></b><br>
Appointment <?=htmlspecialchars($ap['status'])?>
</div>

</div>

<?php } ?>

</div>
</section>


<h3 class="title">📋 Appointment Status</h3>

<?php mysqli_data_seek($apps,0); ?>

<section class="section glass">

<?php if(mysqli_num_rows($apps)==0){ ?>

<div class="empty">No appointments yet</div>

<?php } else { ?>

<?php while($ap=mysqli_fetch_assoc($apps)){ ?>



<div class="appointment glass" style="display:flex;align-items:center;justify-content:space-between;gap:20px;">

<div>
<b><?=htmlspecialchars($ap['appointment_date'])?></b>

<div class="progress">
<div class="progress-bar <?=strtolower($ap['status'])?>"></div>
</div>
</div>

<span class="badge <?=strtolower($ap['status'])?>">
<?=htmlspecialchars($ap['status'])?>
</span>

<?php
$payQuery = mysqli_query($conn,"
SELECT payment_status
FROM tbl_payment
WHERE appointment_id=".$ap['appointment_id']."
LIMIT 1
");

$pay = mysqli_fetch_assoc($payQuery);

$payment_status = $pay['payment_status'] ?? 'Pending';

if($ap['status']=='Completed' && $payment_status!='Paid'){
?>

<a href="paynow.php?appointment_id=<?=$ap['appointment_id']?>" class="pay-btn">
💳 Pay Now
</a>

<?php } ?>

</div>

<?php } ?>

<?php } ?>

</section>

<footer class="footer glass">
  <span>© 2026 PetCare</span>
  <span>Made with ❤️ for pet parents</span>
</footer>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('spendingChart'), {
  type: 'doughnut',
  data: {
    labels: ['Paid', 'Refunded'],
    datasets: [{
      data: [
        <?=mysqli_fetch_assoc(mysqli_query($conn,"
          SELECT COUNT(*) c FROM tbl_payment
          WHERE user_id=$user_id AND payment_status='Paid'
        "))['c'] ?? 0?>,
        <?=mysqli_fetch_assoc(mysqli_query($conn,"
          SELECT COUNT(*) c FROM tbl_payment
          WHERE user_id=$user_id AND refund_status=1
        "))['c'] ?? 0?>
      ],
      backgroundColor: ['#ffcc00','#ff6b6b']
    }]
  }
});
</script>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {

initialView: 'dayGridMonth',

height:420,

validRange:{
start:new Date()
},

selectable:false,

events:[

<?php
mysqli_data_seek($apps,0);
while($ap=mysqli_fetch_assoc($calendar_apps)){
?>

{
title: "Appointment",
start: "<?=$ap['appointment_date']?>",
color:"#ff9900"
},

<?php } ?>

]

});

calendar.render();

});

</script>

<script>

document.querySelectorAll(".count").forEach(el => {

let target = parseInt(el.innerText);
let count = 0;
let speed = target / 40;

let update = () => {

count += speed;

if(count < target){
el.innerText = Math.floor(count);
requestAnimationFrame(update);
}else{
el.innerText = target;
}

};

update();

});

</script>
<?php if($msg>0){ ?>
alert("You have <?= $msg ?> new message(s)");
<?php } ?>

<script>

function checkMessages(){

fetch("get_msg_count.php")
.then(res => res.text())
.then(count => {

let badge = document.getElementById("msgCount");

if(!badge){
return;
}

count = parseInt(count);

if(count > 0){
badge.innerText = count;
badge.style.display = "inline-block";
}else{
badge.style.display = "none";
}

});

}

/* check every 5 seconds */

setInterval(checkMessages,5000);

</script>
</body>
</html>
