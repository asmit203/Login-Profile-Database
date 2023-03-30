<?php

// Database configuration
$host = "localhost"; // Change this to your host name
$user = "root"; // Change this to your MySQL user name
$password = "8918473362"; // Change this to your MySQL password
$database = "registration"; // Change this to your database name

// Establish database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
