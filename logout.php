<?php
// Start session
session_start();

// Unset session variables
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to login page
header("Location: login.html");
exit;
?>
