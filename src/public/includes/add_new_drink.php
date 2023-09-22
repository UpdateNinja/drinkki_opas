<?php


$uploadedFilePath = $_SESSION['uploadedFilePath']; // Get the uploaded file path
// Use $uploadedFilePath in your SQL query or other operations

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

$drinkname = $conn->real_escape_string($data->name); // Replace with the desired username
$drink_descr = $conn->real_escape_string($data->descr); // Replace with the desired username

$image_url = $uploadedFilePath;



// Prepare the INSERT statement

$sql = "INSERT INTO php_docker_table (image_url,drink_name,descr) VALUES (?,?,?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the parameters and set their values
$stmt->bind_param("sss",$image_url,$drinkname,$drink_descr);

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