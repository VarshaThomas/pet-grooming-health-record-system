<?php
$appointment_id = intval($_GET['appointment_id']);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/processing.css">
<script>
setTimeout(function(){
  window.location='payment_success.php?id=<?=$appointment_id?>';
},2000);
</script>
</head>
<body>

<div class="processing-wrap">
  <div class="spinner"></div>
  <h2>Processing Payment</h2>
  <p>Please do not close this page...</p>
</div>

</body>
</html>
