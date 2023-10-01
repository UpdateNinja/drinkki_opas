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
    die("Yhteysvirhe: " . $conn->connect_error);
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
    $error .="Käyttäjänimi on virheellinen <br>";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Sähköposti on virheellinen <br>";
}elseif (strlen($password) < 8) {
    $error .= "Salasanan pitää olla vähintään 8 merkkiä.";
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $error .= "Salasanan tulee sisältää iso kirjain, erikoismerkki ja numero.";
} elseif (preg_match('/\bsalasana\b/i', $password) || preg_match('/\b123\b/', $password)) {
    $error .= "Salasana sisältää yleisiä sanoja tai on heikko.";
} else {

    
        $query = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
    
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username,$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
    
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                
                if($row['username'] == $username){
                    $error .= $username . ' on jo käytössä.<br>';
                } elseif($row['email'] == $email){
                    $error .= $email . ' on jo käytössä.<br>';
                }
                

            }
            
        }

}

if (!empty($error)){
    echo $error;
}else{

// Prepare the INSERT statement

$sql = "INSERT INTO users (username,email,password,hashedpassword,activation_code,activation_expiry) VALUES (?,?,?,?,?,?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

$activation_code="asdasd";
$expiry = 1 * 24  * 60 * 60;

$activation_expiry = date('Y-m-d H:i:s',  time() + $expiry);

// Bind the parameters and set their values
$stmt->bind_param("ssssss",$username,$email,$password,$hashedPassword,$activation_code,$activation_expiry);

// Execute the statement
if ($stmt->execute()) {
    echo "Uusi käyttäjä rekisteröity.";
} else {
    echo "Virhe: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
}