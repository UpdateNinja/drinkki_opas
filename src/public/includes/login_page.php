<?php
session_start();
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
            <h1>Kirjaudu sisään</h1>
        </div>

        <input type="text" class="form-control" id="username" name="username" placeholder="Käyttäjänimi">

        <input type="password" class="form-control" id="password" name="password" placeholder="Salasana">

        <div id="resultMessage"></div>

        <button id="send_new_drink" class="form-control" onclick="sendnewRegister()">Kirjaudu sisään</button>


    </div>

    <main>


    </main>



    <?php require 'footer.php'; ?>
</body>




<script>
    function sendnewRegister() {

        //Get username from input element "username"
        var user_name_element = document.getElementById("username");
        var user_name = user_name_element.value;

        //Get email from input element "email"
        var email_element = document.getElementById("email");
        var email = email_element.value;

        //Get password from input element "password"
        var password_element = document.getElementById("password");
        var password = password_element.value;

        var data = {

            username: user_name,
            email: email,
            password: password,



        };

        fetch('register_new_user.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from server:', data);
                var resultMessageElement = document.getElementById("resultMessage");
                resultMessageElement.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });




    }
</script>