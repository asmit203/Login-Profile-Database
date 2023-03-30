
<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Update user data in database
    $email = $_POST['email'];

    // If all validation passes, store the user data in the database
    require_once 'db_conn.php';

    $sql = "UPDATE users SET firstname='$fname', lastname='$lname' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // Check if update was successful
    header("Location: profile.php");
    // if ($result) {
    //     // Redirect to profile page
    //     exit;
    // } else {
    //     die("Error: " . mysqli_error($conn));
    // }

?>