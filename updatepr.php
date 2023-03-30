<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            background-color: #3b5998;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        
        form {
            background-color: #eee;
            border-radius: 5px;
            margin: 20px;
            padding: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        input[type=password] {
            border-radius: 3px;
            border: none;
            padding: 8px;
            width: 100%;
        }
        
        input[type=submit] {
            background-color: #3b5998;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Include database connection file
require_once 'db_conn.php';
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

		$user_id = $row['id'];
		$_SESSION["user_id"] = $row["id"];

// echo "<h1>Update Profile</h1>";
//     echo "<form action=\" update.php\" method=\"post\">";
//     echo "<label for=\"name\">First Name:</label>";
//     echo "<input type=\"text\" name=\"name\" id=\"fname\"value= \"$fname\" >";
//     echo "<br>";
//     echo "<label for=\"name\">Last Name:</label>";
//     echo "<input type=\"text\" name=\"name\" id= \"lname\" value=$lname>";
//     echo "<br>";
//     echo "<input type=\"submit\" name=\"submit\" value=\"Update\">";
//     echo "</form>";
//     echo "<div style=\"text-align:center;\">";
//     echo "<a href=\"updatepass.html?id=$email\">";
//     echo "<button style=\"background-color: #3b5998; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; font-size: 16px; cursor: pointer;\">";
//     echo "Update Password";
//     echo "</button>";
//     echo "</a>";
//     echo "</div>";
?>
<h1>Update Profile</h1>
 <form action="update.php" method="post">
     <label for="name">First Name:</label>
     <input type="text" name="fname" id="fname" value="<?php echo $fname?>" >
     <br>
     <label for="name">Last Name:</label>
     <input type="text" name="lname" id="lname" value="<?php echo $lname?>">
     <br>
     <label for="name">Email:</label>
     <input type="text" name="email" id="email" value="<?php echo $email?>" readonly>
     <br>
     <input type="submit" name="submit" value="Update">
 </form>
 <div style="text-align:center;">
     <a href="updatepass.html?id=<?php echo $email; ?>">
         <button style="background-color: #3b5998; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; font-size: 16px; cursor: pointer;">
             Update Password
         </button>
     </a> 
</div> 
</body>
</html>