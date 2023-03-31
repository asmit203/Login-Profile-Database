
<?php

	// Get form data
	$email = $_POST['email'];
    session_start();
    $actual_email =  $_SESSION['email'];
    echo $actual_email;
    echo $email;
    if((string)$email == (string)$actual_email)
    {
        require_once 'db_conn.php';
    $sql = "DELETE FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    header('Location: index.php');
    exit;
    }
    else
    {
        echo "Email does not match";
        // header('Location: login.html');
        // exit;
    }

    session_destroy();
    
    ?>
