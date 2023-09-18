<?php
session_start();
unset($_SESSION['uploadedFilePath']);
?>

<head>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Drinkki Opas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styling.css"> <!-- Add this line -->

</head>

<body>

<?php require 'header.php'; ?>

    <div class="container" style="max-width: 30%;">



        <div class="text-center mt-5 mb-4">
            <h1>Lisää juoma</h1>
        </div>

        <input type="text" class="form-control" id="fname" name="fname" placeholder="Juoman nimi">

        <textarea id="receipt" class="form-control" name="receipt" rows="4" cols="50" placeholder="Kirjoita juoman resepti"></textarea>

        <input type="file" class="form-control" accept=".jpeg, .jpg, .bmp, .png" id="myfile" name="myfile"><br>

        <button type="button" class="form-control" id="uploadButton">Lähetä kuvatiedosto</button>

        <div id="uploadResult"></div>

        <button id="send_new_drink" class="form-control" onclick="sendnewDrink()">Lisää juoma</button>


    </div>

    <main>


    </main>



    <?php require 'footer.php'; ?>
</body>




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
                    console.error("Error :", error);
                }
            });
        });
    });
</script>