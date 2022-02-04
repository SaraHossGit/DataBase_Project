<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['CusID'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$CusFirstName = $_POST['First_Name'];
	$CusLastName = $_POST['Last_Name'];
	$CusEmailAddress = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM CUSTOMER WHERE CusEmailAddress ='$CusEmailAddress'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO CUSTOMER (CusFirstName, CusLastName, CusEmailAddress, CusEncryptedPass, CusRole)
					VALUES ('$CusFirstName', '$CusLastName', '$CusEmailAddress', '$password', 0)";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$CusFirstName = "";
				$CusLastName = "";
				$CusEmailAddress  = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				header("Location: /DataBase_Project/login/index.php");
			} else {
				//echo $result;
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
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

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form - Pure Coding</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="First Name" name="First_Name" value="<?php echo $CusFirstName; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Last Name" name="Last_Name" value="<?php echo $CusLastName; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $CusEmailAddress; ?>" required>
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
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>