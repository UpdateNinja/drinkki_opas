<?php
session_start();
$servername = "drinkki_opas-db-1";
$username = "php_docker";
$password = "password";
$dbname = "php_docker";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Prepare the INSERT statement

$username = "testaaja5";
$active = 1;

$sql = "UPDATE users set active = ?, activated_at = CURRENT_TIMESTAMP where username=?";

// Create a prepared statement
$stmt = $conn->prepare($sql);

$stmt->bind_param("is", $active, $username);

// Execute the statement
if ($stmt->execute()) {
    echo "New record inserted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>