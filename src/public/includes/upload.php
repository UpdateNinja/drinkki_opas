<?php

// Store the file path in a session variable
session_start();

date_default_timezone_set('Europe/Bucharest'); // Change to your specific timezone

// Get the current timestamp in GMT+2 timezone
$currentTimestamp = time();

// Format the timestamp as "Day/Month/Year"
$formattedDate = date('d_m_Y_h_i_s', $currentTimestamp);

$allowedTypes = array('image/jpeg', 'image/jpg', 'image/png', 'image/bmp');



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadErrors = [
        UPLOAD_ERR_OK         => "File uploaded successfully.",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."
    ];

    // Check if the file was uploaded without errors
    if ($_FILES["myfile"]["error"] === UPLOAD_ERR_OK) {

        $fileType = mime_content_type($_FILES['myfile']['tmp_name']); // Get the MIME type of the uploaded file
        

        $targetDir = "uploads/";
        $targetFile = $targetDir . 'drink_image_' . $formattedDate ."_" . random_int(0,PHP_INT_MAX);

        if (in_array($fileType, $allowedTypes)) {

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "File already exists.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetFile)) {
                echo "File uploaded successfully." . $targetFile;
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                $serverHost = $_SERVER['HTTP_HOST'];
                $fullURL = $protocol . $serverHost . "/src/public/includes/" . $targetFile;
                $_SESSION['uploadedFilePath'] = $fullURL; // $filePath is the file path obtained in upload.php
            } else {
                echo "Error uploading file.";
            }
        }
    } else{
        echo 'Invalid file type. Only JPEG, JPG, PNG, and BMP images are allowed.';
    }

    } else {
        // Display a more descriptive error message based on the error code
        if (isset($uploadErrors[$_FILES["myfile"]["error"]])) {
            echo "File upload error: " . $uploadErrors[$_FILES["myfile"]["error"]];
        } else {
            echo "Unknown file upload error.";
        }
    }
}
