<?php
include 'config/db.php';
mysqli_query($conn,"DELETE FROM tbl_pet WHERE pet_id=".$_GET['id']);
header("Location:pets.php");
?>
