<?php
require_once 'auth.php';
logoutUser();
header("Location: index.php");
exit();
?>