<?php

$servername = "drinkki_opas-db-1";
$username = "php_docker";
$password = "password";
$dbname = "php_docker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input")); // Get JSON data from request

if (isset($data->rating) && isset($data->id)) {

    // Read the existing rating and rating qty values from the database
    $idValue = $conn->real_escape_string($data->id);

    $selectSql = "SELECT rating, rating_qty FROM php_docker_table WHERE id = '$idValue'";
    $result = $conn->query($selectSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingRating = $row['rating'];
        $existingRatingQty = $row['rating_qty'];
        $newRatingQty = $existingRatingQty + 1;

        // Now you have the existing rating and rating_qty values in $existingRating and $existingRatingQty

        $newRating = $conn->real_escape_string($data->rating); // Escape the new rating value

        //vanha arvo = 5, qty = 1
        //viimeinen arvo = 0, qty = 2
        //uusi arvo = 5+0 / 2 = 2.5

        //vanha arvo = 2.5, qty = 2
        //viimeinen arvo = 4, qty = 3
        // uusi arvo =  2.5 + 4 / 3
        $newRating = (($existingRating * $existingRatingQty) + $newRating) / $newRatingQty;

        // Perform the update
        $updateSql = "UPDATE php_docker_table SET rating = '$newRating', rating_qty = '$newRatingQty' WHERE id = '$idValue'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Rating updated successfully";
        } else {
            echo "Error updating rating: " . $conn->error;
        }
    } else {
        echo "No record found for the provided ID";
    }
} else {
    echo "Rating value not provided";
}

$conn->close();
?>