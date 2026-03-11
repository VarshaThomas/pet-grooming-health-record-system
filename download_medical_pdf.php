<?php

require_once 'vendor/autoload.php';
include 'config/db.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/* GET APPOINTMENT ID */

$appointment_id = intval($_GET['appointment_id'] ?? 0);

if(!$appointment_id){
die("Invalid request");
}

/* FETCH REPORT DATA */

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT r.*, p.pet_name, u.name owner_name, a.appointment_date
FROM tbl_vet_report r
JOIN tbl_appointment a ON r.appointment_id=a.appointment_id
JOIN tbl_pet p ON a.pet_id=p.pet_id
JOIN tbl_user u ON a.user_id=u.user_id
WHERE r.appointment_id='$appointment_id'
"));

if(!$data){
die("Report not found");
}

/* DOMPDF SETTINGS */

$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

/* HTML REPORT */

$html='

<style>

body{
font-family: DejaVu Sans, sans-serif;
font-size:13px;
color:#1b3a2f;
margin:0;
padding:0;
}

/* GREEN HOSPITAL HEADER */

.header{
background:#145a32;
color:white;
padding:18px;
text-align:center;
font-size:22px;
font-weight:bold;
letter-spacing:1px;
}

/* REPORT CARD */

.card{
border:1px solid #dfe6e9;
padding:20px;
margin-top:20px;
border-radius:6px;
}

/* SECTION TITLES */

.section-title{
font-size:16px;
color:#145a32;
font-weight:bold;
margin-top:15px;
border-bottom:2px solid #eaeaea;
padding-bottom:4px;
}

/* TABLE */

table{
width:100%;
margin-top:8px;
border-collapse:collapse;
}

td{
padding:6px;
}

/* DIAGNOSIS BOX */

.box{
background:#f3f9f5;
padding:12px;
border-left:5px solid #1e8449;
margin-top:8px;
}

/* SIGNATURE */

.signature{
margin-top:40px;
}

.doctor{
font-weight:bold;
margin-top:5px;
}

/* FOOTER */

.footer{
margin-top:40px;
font-size:11px;
text-align:center;
color:#555;
border-top:1px solid #ddd;
padding-top:10px;
}

</style>


<div class="header">
PetCare Veterinary Clinic
</div>

<div class="card">

<p><b>Generated On:</b> '.date("d M Y H:i:s").'</p>

<div class="section-title">Pet Information</div>

<table>

<tr>
<td width="30%"><b>Pet Name</b></td>
<td>: '.$data['pet_name'].'</td>
</tr>

<tr>
<td><b>Owner</b></td>
<td>: '.$data['owner_name'].'</td>
</tr>

<tr>
<td><b>Appointment Date</b></td>
<td>: '.$data['appointment_date'].'</td>
</tr>

</table>

<div class="section-title">Diagnosis</div>

<div class="box">
'.$data['diagnosis'].'
</div>

<div class="section-title">Prescription</div>

<div class="box">
'.$data['prescription'].'
</div>

<div class="signature">

<b>Veterinarian Signature</b><br><br>

_____________________________<br>

<div class="doctor">
Dr. Arjun Nair<br>
Senior Veterinary Surgeon
</div>

</div>

</div>

<div class="footer">

PetCare Veterinary Clinic<br>
24x7 Emergency Care<br>
Phone: +91 9876543210<br>
Email: petcare@clinic.com

</div>

';

/* GENERATE PDF */

$dompdf->loadHtml($html);

$dompdf->setPaper("A4","portrait");

$dompdf->render();

$dompdf->stream("Clinical_Report_".$data['pet_name'].".pdf",["Attachment"=>true]);

exit;

?>