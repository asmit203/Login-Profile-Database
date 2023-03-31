<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<style>
		body {
			background-color: #f0f0f0;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.3);
		}

		h1 {
			color: #333;
			font-size: 36px;
			margin-top: 0;
			margin-bottom: 20px;
		}

		p {
			color: #666;
			font-size: 18px;
			margin-top: 0;
			margin-bottom: 20px;
		}

		.field {
			margin-bottom: 10px;
		}

		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}

		.value {
			font-weight: normal;
		}

		.btn {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			border-radius: 4px;
			transition: background-color 0.3s ease;
			margin-top: 20px;
		}

		.btn:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<?php
		// Start session
		session_start();
		
		// Check if user is logged in
		if (!isset($_SESSION['email'])) {
			header("Location: login.html");
			exit;
		}
		
		// Include database connection file
		require_once 'db_conn.php';
		
		// Retrieve user data from database
		$email = $_SESSION['email'];
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		
		// Check if query was successful
		if (!$result) {
			die("Error: " . mysqli_error($conn));
		}
		
		// Retrieve user data
		$row = mysqli_fetch_assoc($result);
		$fname = $row['firstname'];
		$lname = $row['lastname'];
		$email = $row['email'];
		$_SESSION['email'] = $email;
		
		// Display user profile information
		// echo "<h1>Profile Page</h1>";
		// echo "<p><strong>Name:</strong> $fname</p>";
		// echo "<p><strong>Email:</strong> $email</p>";
		// echo "<p><a href='logout.php'>Logout</a></p>";
		
	?>

	<div class="container">
		<h1>Profile Page</h1>
		<div class="field">
			<label>First Name:</label>
			<span class="value"><?php echo $fname; ?></span>
		</div>
		<div class="field">
			<label>Last Name:</label>
			<span class="value"><?php echo $lname; ?></span>
		</div>
		<div class="field">
			<label>Email:</label>
			<span class="value"><?php echo $email; ?></span>
		</div>
		<a href="updatepr.php?id=<?php echo $email; ?>" class="btn">Edit Profile</a>
		<a href="logout.php" class="btn">Logout</a>
		<a href="profile_delete.html" class="btn">Delete Profile</a>
    </div>
    </body>
    </html>
	