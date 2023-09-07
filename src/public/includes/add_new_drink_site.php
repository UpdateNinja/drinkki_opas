<?php
session_start();
unset($_SESSION['uploadedFilePath']);
?>

<head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<!-- The pop-up content -->
<div id="popup" class="popup">
    <h2>Lisää juoma</h2>


    <label for="fname">Juoman nimi:</label><br>
    <input type="text" id="fname" name="fname"><br>



    <label for="receipt">Resepti:</label><br>

    <textarea id="receipt" name="receipt" rows="4" cols="50"></textarea><br>

    <!-- File input for uploading an image -->
    <input type="file" id="myfile" name="myfile"><br>

    <button type="button" id="uploadButton">Upload File</button>

    <div id="uploadResult"></div>


    <button id="send_new_drink" onclick="sendnewDrink()">Lisää juoma</button>

</div>




<script>
    function sendnewDrink() {

        //Get drinkname from input element "fname"
        var drink_name_element = document.getElementById("fname");
        var drink_name = drink_name_element.value;

        //Get drink receipt from input element "receipt"
        var receipt_element = document.getElementById("receipt");
        var receipt = receipt_element.value;

        var data = {

            name: drink_name,
            descr: receipt,



        };

        fetch('add_new_drink.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from server:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });




    }

    $(document).ready(function() {
            $("#uploadButton").click(function() {
                // Create a FormData object to collect file data
                var formData = new FormData();

                // Append the file from the file input
                formData.append("myfile", $("#myfile")[0].files[0]);

                // Send the file data to the server using AJAX
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle the response from the server here
                        $("#uploadResult").html(response);
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });
        });

</script>