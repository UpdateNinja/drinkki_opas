<?php

// Store the file path in a session variable
session_start();



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
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["myfile"]["name"]);

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
    } else {
        // Display a more descriptive error message based on the error code
        if (isset($uploadErrors[$_FILES["myfile"]["error"]])) {
            echo "File upload error: " . $uploadErrors[$_FILES["myfile"]["error"]];
        } else {
            echo "Unknown file upload error.";
        }
    }
}
