<?php

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $upassword = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Validate first name and last name fields
    if (empty($firstName) || empty($lastName)) {
        die("All fields are required");
    }

    // Validate email field
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Validate password field
    $uppercase = preg_match('@[A-Z]@', $upassword);
    $lowercase = preg_match('@[a-z]@', $upassword);
    $number    = preg_match('@[0-9]@', $upassword);

    if(!$uppercase || !$lowercase || !$number || strlen($upassword) < 8) {
        die("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number");
    }

    // Validate confirm password field
    if ($upassword !== $confirmPassword) {
        die("Passwords do not match");
    }

    require_once 'db_conn.php';
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<span style='color:red'>This Email already exists </span>";
        exit();
    }


    // require_once 'db_conn.php';
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $upassword);
    $stmt->execute();

    echo "User registered successfully";

    $stmt->close();
    $conn->close();
    header('Location: login.html');
    exit();
?>