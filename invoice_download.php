<?php
session_start();
require_once("core/fpdf.php");
include "config/db.php";

if(!isset($_SESSION['user_id'])){
    exit("Unauthorized");
}

$payment_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT p.*, a.appointment_date
    FROM tbl_payment p
    JOIN tbl_appointment a ON a.appointment_id=p.appointment_id
    WHERE p.payment_id=$payment_id
    AND p.user_id=$user_id
"));

if(!$data){
    exit("Invoice not found");
}

$pdf = new FPDF();
$pdf->AddPage();

/* ===== LOGO ===== */

$pdf->Image('assets/logo/petcare.png',10,10,40);

/* ===== HEADER ===== */

$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,15,'PetCare Invoice',0,1,'R');

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,6,'Invoice ID: '.$data['payment_id'],0,1,'R');
$pdf->Cell(0,6,'Payment Date: '.$data['payment_date'],0,1,'R');

$pdf->Ln(10);

/* ===== CUSTOMER DETAILS BOX ===== */

$pdf->SetFillColor(245,245,245);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'Appointment Details',0,1,'L',true);

$pdf->SetFont('Arial','',11);

$pdf->Cell(95,8,'Appointment Date:',1,0);
$pdf->Cell(95,8,$data['appointment_date'],1,1);

$pdf->Cell(95,8,'Payment Mode:',1,0);
$pdf->Cell(95,8,$data['payment_mode'],1,1);

$pdf->Cell(95,8,'Payment Status:',1,0);
$pdf->Cell(95,8,$data['payment_status'],1,1);

$pdf->Ln(10);

/* ===== SERVICE TABLE ===== */

$pdf->SetFont('Arial','B',12);

$pdf->SetFillColor(230,230,230);

$pdf->Cell(120,10,'Description',1,0,'C',true);
$pdf->Cell(70,10,'Amount',1,1,'C',true);

$pdf->SetFont('Arial','',12);

$pdf->Cell(120,10,'PetCare Service',1,0);
$pdf->Cell(70,10,'INR '.number_format($data['amount'],2),1,1,'R');

$pdf->Ln(5);

/* ===== TOTAL BOX ===== */

$pdf->SetFont('Arial','B',14);

$pdf->Cell(120,12,'Total Paid',1,0,'R');
$pdf->Cell(70,12,'INR '.number_format($data['amount'],2),1,1,'R');

$pdf->Ln(20);

/* ===== FOOTER ===== */

$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,6,'Thank you for choosing PetCare!',0,1,'C');
$pdf->Cell(0,6,'This is a system generated invoice.',0,1,'C');

$pdf->Output();
?>