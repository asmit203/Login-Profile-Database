<?php

	// Get form data
	$current_password_input = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];
	$opass = $_POST['current_password'];
	$npass = $_POST['new_password'];
	$cnpass = $_POST['confirm_password'];
	$email = $_POST['email'];
	
	// Connect to database
	require_once 'db_conn.php';


	// Get current password from database
	$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$current_password = $row['password'];

	// Check if form is submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {


		// Validate current password
		if ($current_password != $current_password_input) {
			$error = 'Incorrect current password.';
			echo $error;
			header('Location: login.html');
    			exit();
			// echo $current_password;
			// echo $current_password_input;
		} else {
			// Validate new password
			if ($new_password != $confirm_password) {
				$error = 'New password and confirmation do not match.';
				echo $error;
				header('Location: login.html');
    			exit();
			} else if (strlen($new_password) < 8) {
				$error = 'New password must be at least 8 characters long.';
				echo $error;
				header('Location: login.htmlp');
    			exit();
			} else {
				$uppercase = preg_match('@[A-Z]@', $new_password);
    			$lowercase = preg_match('@[a-z]@', $new_password);
    			$number    = preg_match('@[0-9]@', $new_password);
				if(!$uppercase || !$lowercase || !$number || strlen($upassword) < 8) {
					die("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number");
				}
				// Update password in database
				require_once 'db_conn.php';
				$sql = "UPDATE users SET password='$npass' WHERE email='$email'";
    			$result = mysqli_query($conn, $sql);

				// Redirect to profile page
				header('Location: profile.php');
				exit;
			}
		}
}

