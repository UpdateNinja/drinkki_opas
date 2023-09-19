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
$error = '';

// Define the data to be inserted

$username = $conn->real_escape_string($data->username); // Replace with the desired username
$email = $conn->real_escape_string($data->email); // Replace with the desired username
$password = $conn->real_escape_string($data->password); // Replace with the desired username
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$pattern = '/^[a-zA-Z0-9]{5,}$/';

if (!preg_match($pattern, $username)) {
    $error .="Username is invalid <br>";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Email is invalid <br>";

}

if (strlen($password) < 8) {
    $error .= "Password must be at least 8 characters long.";
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $error .= "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.";
} elseif (preg_match('/\bsalasana\b/i', $password) || preg_match('/\b123\b/', $password)) {
    $error .= "Password is too common or weak.";
} else {
    // Password is valid; proceed with registration
}

if (!empty($error)){
    echo $error;
}else{

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
}
