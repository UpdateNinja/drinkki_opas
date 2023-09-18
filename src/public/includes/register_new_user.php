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

$data = json_decode(file_get_contents("php://input")); // Get JSON data from request

// Define the data to be inserted

$username = $conn->real_escape_string($data->username); // Replace with the desired username
$email = $conn->real_escape_string($data->email); // Replace with the desired username
$password = $conn->real_escape_string($data->password); // Replace with the desired username
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);



// Prepare the INSERT statement

$sql = "INSERT INTO users (username,email,password,hashedpassword) VALUES (?,?,?,?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameters and set their values
$stmt->bind_param("ssss",$username,$email,$password,$hashedPassword);

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