<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}

$user_id=$_SESSION['user_id'];

/* FETCH MESSAGES */

$msg=mysqli_query($conn,"
SELECT *
FROM tbl_messages
WHERE user_id='$user_id'
ORDER BY created_at DESC
");

/* AUTO MARK AS READ */

mysqli_query($conn,"
UPDATE tbl_messages
SET status='Read'
WHERE user_id='$user_id'
AND status='Unread'
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Messages | PetCare</title>

<link rel="stylesheet" href="css/pastel-base.css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/customer-premium.css">

<style>

.page{
max-width:900px;
margin:auto;
padding:40px 20px;
}

.page h1{
margin-bottom:25px;
font-size:28px;
}

.msg-card{

padding:22px;
margin-bottom:18px;
border-radius:18px;
background:white;
box-shadow:0 10px 30px rgba(0,0,0,.08);
transition:.25s;
border-left:6px solid #ffcc00;
}

.msg-card:hover{
transform:translateY(-3px);
}

.msg-card.unread{
border-left:6px solid #ff5e5e;
background:#fff7f7;
}

.msg-title{
font-size:18px;
font-weight:600;
margin-bottom:8px;
}

.msg-text{
font-size:15px;
opacity:.85;
line-height:1.5;
}

.msg-time{
font-size:12px;
opacity:.6;
margin-top:10px;
}

.empty-box{

padding:60px;
text-align:center;
border-radius:20px;
background:white;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.empty-box h3{
margin-bottom:10px;
}

.back-btn{

display:inline-block;
margin-top:30px;
padding:10px 20px;
border-radius:20px;
background:#ffcc00;
color:black;
text-decoration:none;
font-weight:600;
}

</style>

</head>

<body>

<div class="page">

<h1>📩 My Messages</h1>

<?php if(mysqli_num_rows($msg)==0){ ?>

<div class="empty-box">

<h3>No Messages Yet</h3>
<p>Your notifications will appear here.</p>

<a href="dashboard.php" class="back-btn">
⬅ Back to Dashboard
</a>

</div>

<?php } ?>

<?php while($m=mysqli_fetch_assoc($msg)){ ?>

<div class="msg-card <?= $m['status']=='Unread' ? 'unread':'' ?>">

<div class="msg-title">
<?= htmlspecialchars($m['title']) ?>
</div>

<div class="msg-text">
<?= htmlspecialchars($m['message']) ?>
</div>

<div class="msg-time">

<?php
$date = date("d M Y h:i A",strtotime($m['created_at']));
echo $date;
?>

</div>

</div>

<?php } ?>

<a href="dashboard.php" class="back-btn">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>