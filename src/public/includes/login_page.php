<?php
?>

<head>

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

        <button id="send_new_drink" class="form-control" onclick="login()">Kirjaudu sisään</button>


    </div>

    <main>


    </main>



    <?php require 'footer.php'; ?>
</body>




<script>
    function login() {

        //Get username from input element "username"
        var user_name_element = document.getElementById("username");
        var user_name = user_name_element.value;

        //Get password from input element "password"
        var password_element = document.getElementById("password");
        var password = password_element.value;

        var data = {

            username: user_name,
            password: password,



        };

        fetch('login.php', {
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