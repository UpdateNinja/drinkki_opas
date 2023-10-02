<?php
$servername = "drinkki_opas-db-1";
$username = "php_docker";
$password = "password";
$dbname = "php_docker";

$active = 1;

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['email']) && isset($_GET['activation_code'])) {
    $email = $_GET['email'];
    $providedactivation_code = $_GET['activation_code'];

    $sql = "SELECT activation_code FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();
        $storedActivationCodeHash = $row['activation_code'];

        if (password_verify($providedactivation_code, $storedActivationCodeHash)) {
            $updateSql = "UPDATE users set active = 1, activated_at = CURRENT_TIMESTAMP WHERE email = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("s", $email);
            $updateStmt->execute();

            if ($updateStmt->affected_rows === 1) {
                echo "Activation succesful. Your account is now active.";
            } else {
                echo "Activation faile. Please try again later.";
            }

        } else {
            echo "Invalid activation code.";
        }
    } else {
        "invalid email";
    }

    $conn->close();

} else {
    echo "Email or activation code not found in the URL";

}