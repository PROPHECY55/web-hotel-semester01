<?php
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

header("Location: ../index.php?page=home&message=logout_success");
exit();