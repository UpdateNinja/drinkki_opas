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
$id = $conn->real_escape_string($data->id); // Replace with the desired ID
$rating = $conn->real_escape_string($data->rating); // Replace with the desired rating
$comment = $conn->real_escape_string($data->review_comment); // Replace with the desired comment
$username = $_SESSION['username'];

// Prepare the INSERT statement

$sql = "INSERT INTO reviews (drink_id, review_rating, review_comment, review_user) VALUES (?, ?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameters and set their values
$stmt->bind_param("iiss", $id, $rating, $comment, $username);

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