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
$password = $conn->real_escape_string($data->password); // Replace with the desired username

$pattern = '/^[a-zA-Z0-9]{5,}$/';

if (!preg_match($pattern, $username)) {
    $error .= "Käyttäjänimi on virheellinen <br>";
} elseif (strlen($password) < 8) {
    $error .= "Salasanan pitää olla vähintään 8 merkkiä.";
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $error .= "Salasanan tulee sisältää iso kirjain, erikoismerkki ja numero.";
} elseif (preg_match('/\bsalasana\b/i', $password) || preg_match('/\b123\b/', $password)) {
    $error .= "Salasana sisältää yleisiä sanoja tai on heikko.";
} else {


    $query = "SELECT hashedpassword FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPasswordFromDatabase);
    if ($stmt->fetch()) {
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            $error.= "Kirjautuminen onnistui.";

            //Regenerating new session id after success login - > to add more security for page.
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
        } else {
            $error.= "Käyttäjä tai salasana on väärin.";
        }
    } else {
        $error.= "Käyttäjä tai salasana on väärin.";
    }
    $stmt->close();
}

echo $error;

