<?php
		// // Start a session
		// session_start();

		// // Check if the user is already logged in
		// if (isset($_SESSION['user_id'])) {
		// 	header("Location: profile.php?id=" . $_SESSION['user_id']);
		// 	exit();
		// }

		// // Check if the form has been submitted
		// if (isset($_POST['submit'])) {
		// 	// Retrieve the user data from the database
		// 	$servername =  "localhost";
        //     // $SESSION['email'] = $email;
		// 		echo "Login successful";
		// 		// Redirect to the profile page
		// 		// header("Location: profile.php?id=" . $userId);
		// 		exit();
		// 	} else {
		// 		// Display an error message
		// 		$errorMsg = "Invalid email or password";
		// 	}
        //     if (isset($errorMsg))
		// 		 {echo "<p style=color: red;>" . $errorMsg. "</p>";}
		// 	else
        //         {echo "<p style=color: green;>". "Login successful" ."</p>";}
	
		// 	// Close the database connection
		// 	$stmt->close();
		// 	$conn->close();
	

session_start(); 

include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($email)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['email'] = $row['email'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: profile.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}
		
	?> 