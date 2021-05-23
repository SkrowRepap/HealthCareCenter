<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['patientID'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$ID = $_POST['patientID'];
	$Name = $_POST['name'];
	$Insurance = $_POST['Insurance'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM patients WHERE patientID='$ID'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO patients(patient_ID, name, insurance , password)
					VALUES ('$ID', '$Name', '$Insurance','$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$ID = "";
				$Name="";
				$Insurance = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			
			}
		} else {
			echo "<script>alert('Woops! ID Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<title>Health Care Center Register Form</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="PatientID" name="patientID" value="<?php echo $ID; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Name" name="name" value="<?php echo $Name; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder = "Insurance" name="Insurance" value="<?php echo $Insurance ?>"required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>