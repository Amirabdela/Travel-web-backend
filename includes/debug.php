<?php
// includes/debug.php
function debugSession() {
    echo "<pre>Session Data:\n";
    print_r($_SESSION);
    echo "</pre>";
    
    echo "<p>Session ID: " . session_id() . "</p>";
    echo "<p>Session Status: " . session_status() . " (2 = PHP_SESSION_ACTIVE)</p>";
}
?>