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
	$stmt->bind_param("i", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$current_password = $row['password'];

	// Check if form is submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {


		// Validate current password
		if ((string)$current_password != (string)$current_password_input) {
			$error = 'Incorrect current password.';
			echo $error;
			header('Location: login.php');
    			exit();
			// echo $current_password;
			// echo $current_password_input;
		} else {
			// Validate new password
			if ($new_password != $confirm_password) {
				$error = 'New password and confirmation do not match.';
				echo $error;
				header('Location: login.php');
    			exit();
			} else if (strlen($new_password) < 8) {
				$error = 'New password must be at least 8 characters long.';
				echo $error;
				header('Location: login.php');
    			exit();
			} else {
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

