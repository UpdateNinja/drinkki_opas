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

$email = $conn->real_escape_string($data->email); // Replace with the desired username
$password = $conn->real_escape_string($data->password); // Replace with the desired username

$pattern = '/^[a-zA-Z0-9]{5,}$/';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Sähköposti on virheellinen <br>";
} elseif (strlen($password) < 8) {
    $error .= "Salasanan pitää olla vähintään 8 merkkiä.";
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $error .= "Salasanan tulee sisältää iso kirjain, erikoismerkki ja numero.";
} elseif (preg_match('/\bsalasana\b/i', $password) || preg_match('/\b123\b/', $password)) {
    $error .= "Salasana sisältää yleisiä sanoja tai on heikko.";
} else {


    $query = "SELECT username,hashedpassword,active FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($username, $hashedPasswordFromDatabase, $activate);



    if ($stmt->fetch()) {

        if ($activate == 1) {

            if (password_verify($password, $hashedPasswordFromDatabase)) {
                $error .= "OK";

                //Regenerating new session id after success login - > to add more security for page.
                session_regenerate_id(true);
                $_SESSION['username'] = $username;



            } else {
                $error .= "Käyttäjä tai salasana on väärin.";
            }
        } else {
            $error .= "Käyttäjää ei ole vielä aktivoitu.";
        }
    } else {
        $error .= "Käyttäjä tai salasana on väärin.";
    }
    $stmt->close();
}

echo $error;