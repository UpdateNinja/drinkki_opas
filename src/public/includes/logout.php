<?php
session_start();
session_unset();
session_destroy();

// Check if a redirect URL was provided as a query parameter
if (isset($_GET['redirect'])) {
    $redirectURL = urldecode($_GET['redirect']);
    header("Location: $redirectURL");
} else {
    // If no redirect URL is provided, you can redirect to a default page
    header("Location: ../index.php");
}

exit();
?>