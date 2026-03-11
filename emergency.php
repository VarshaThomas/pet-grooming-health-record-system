<link rel="stylesheet" href="css/forms.css">

<div class="form-box">
<form method="POST" action="add_appointment.php">
<h3>Emergency Registration</h3>

User ID
<input name="user_id" required>

Pet ID
<input name="pet_id" required>

Staff ID
<input name="staff_id" required>

Appointment Date
<input type="date" name="appointment_date" required>

<input type="hidden" name="visit_type" value="EMERGENCY">

<button>Register Emergency</button>
</form>
</div>
