<?php


require __DIR__ . '/../../vendor/autoload.php';


?>

<!DOCTYPE html>
<html>

<head>
    <title>Drinkki Opas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styling.css"> <!-- Add this line -->

    <style>
        /* Styling for the pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        /* Styling for the overlay background */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 98;
        }
    </style>

</head>


<body>

    <div class="container" style="max-width: 50%;">



        <div class="text-center mt-5 mb-4">
            <h1>Drinkki Opas</h1>
        </div>

        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Etsi juomaa ... ">


    </div>



    <div id="searchresult"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="js/livesearch.js"></script>

    <main>


    </main>

    <?php require 'includes/footer.php'; ?>

</body>

</html>



