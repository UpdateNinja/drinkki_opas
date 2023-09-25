<?php
require 'includes/header.php';
$username = 'Käyttäjänimi';
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Drinkki Opas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styling.css"> <!-- Add this line -->
</head>

<body>

    <div class="container" style="max-width: 50%;">



        <div class="text-center mt-5 mb-4">
            <h1>Lisää juoma</h1>
        </div>

        <div>
            <?php
            if (!isset($_SESSION['username'])) {
            ?>
                <div id="AlertMessage" class="alert alert-danger" role="alert">
                    Voit lisätä juoman kirjautumalla sisään!
                </div>

            <?php
                
                $disabled = 'disabled';
            } else {
                $username = $_SESSION['username'];
                $disabled = '';
                ?>
                <div id="AlertMessage" class="alert alert-success" role="alert">
                    Olet kirjautunut sisään käyttäjällä : <?php echo $_SESSION['username'] ?>
                </div>
                <?
            }
            ?>
        </div>

        <div class="row">
            <div class="col">
                <!-- Add this element for image preview -->
                <div style="width: 100%; height: 100%; border: 2px solid black; position: relative;" class="rounded">
                    <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: 90%; position: absolute; top: 0; left: 0; display:none;" class="rounded">
                    <input type="file" class="form-control" accept=".jpeg, .jpg, .bmp, .png" id="myfile" name="myfile" onchange="readImage(this)" hidden>
                    <button type="button" class="btn btn-primary form-control" style="position: absolute; bottom: 0; left: 0; width: 100%; height:10%;" onclick="document.getElementById('myfile').click();">Lisää kuva juomasta</button>
                </div>
            </div>
            <div class="col">
                <input class="form-control" id="show_username" type="text" placeholder="<?php echo $username ?>" readonly>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Juoman nimi">
                <textarea id="receipt" class="form-control" name="receipt" rows="12" cols="50" placeholder="Kirjoita juoman resepti"></textarea>
                <div id="uploadResult"></div>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button id="send_new_drink" class="btn btn-primary" onclick="sendnewDrink()" <?php echo $disabled ?> style="width: 50%;">Lisää juoma</button>
                </div>

            </div>
        </div>



    </div>

    <main>


    </main>



    <?php require 'includes/footer.php'; ?>
</body>




<script>
    function sendnewDrink() {
        // Get drinkname from input element "fname"
        var drink_name_element = document.getElementById("fname");
        var drink_name = drink_name_element.value;

        // Get drink receipt from input element "receipt"
        var receipt_element = document.getElementById("receipt");
        var receipt = receipt_element.value;

        // Create a FormData object to collect file data
        var formData = new FormData();

        // Append the file from the file input
        formData.append("myfile", $("#myfile")[0].files[0]);
        formData.append("name", drink_name);
        formData.append("descr", receipt);

        // Send the file data to the server using AJAX
        $.ajax({
            url: "includes/upload.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle the response from the server here
                $("#uploadResult").html(response);
            },
            error: function(error) {
                console.error("Error: ", error);
            }
        });
    }

    $(document).ready(function() {
        // Add a change event listener to the myfile input
        $("#myfile").change(function() {
            // Check if a file was selected
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Display the selected image in the preview
                    $("#imagePreview").attr("src", e.target.result);
                    $("#imagePreview").css("display", "block");
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>