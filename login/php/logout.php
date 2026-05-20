<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Prevent browser from caching the previous page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect with a logout message
echo "<script>
    alert('Logged Out!');
    window.location.href = '../index.php?message=loggedout';
</script>";
exit();
?>
