<?php
// logout.php
require_once 'includes/auth_functions.php';

logoutUser();

// Redirect to home page or login page
header("Location: index.php");
exit();
?>