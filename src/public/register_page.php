<?php require 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Elegant Sign Up Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #999;
	background: #fafafa;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	min-height: 41px;
	box-shadow: none;
	border-color: #e6e6e6;
}
.form-control:focus {
	border-color: #00c1c0;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 425px;
	margin: 0 auto;
	padding: 30px 0;
}
.signup-form h2 {
	color: #333;
	font-weight: bold;
	margin: 0 0 25px;
}
.signup-form form {
	margin-bottom: 15px;
	background: #fff;
	border: 1px solid #f4f4f4;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 40px 50px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form label {
	font-weight: normal;
	font-size: 14px;
}
.signup-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}    
.signup-form .btn, .signup-form .btn:active {        
	font-size: 16px;
	font-weight: bold;
	background: #00c1c0 !important;
	border: none;
	min-width: 140px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #00b3b3 !important;
}
.signup-form a {
	color: #00c1c0;
	text-decoration: none;
}	
.signup-form a:hover {
	text-decoration: underline;
}
</style>
</head>
<body>
<div class="signup-form">
    <form>
		<h2>Rekisteröidy</h2>
        <div class="form-group">
        	<input type="text" class="form-control" id="username_register" name="username" placeholder="Käyttäjänimi" required="required">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" id="email_register" name="email" placeholder="Sähköposti" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" id="password_register" name="password" placeholder="Salasana" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" id="password_register_confirm" name="confirm_password" placeholder="Vahvista salasana" required="required">
        </div>        

        <div id="resultMessage_register"></div>

        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> Hyväksyn <a href="#"> Käyttöehdot</a> &amp; <a href="#">Sopimusehdot</a></label>
		</div>
		<div class="form-group">
            <button type="button" class="btn btn-primary btn-lg" onclick="sendnewRegister()">Rekisteröidy</button>
            
        </div>
    </form>
	<div class="text-center">Onko sinulla jo käyttäjä? <a href="#">Kirjaudu tästä</a></div>
</div>





    <main>
    

    </main>



    <?php require 'includes/footer.php'; ?>
</body>




<script>
    function sendnewRegister() {

        //Get username from input element "username"
        var user_name_element = document.getElementById("username_register");
        var user_name = user_name_element.value;
        var resultMessageElement = document.getElementById("resultMessage_register");

        //Get email from input element "email"
        var email_element = document.getElementById("email_register");
        var email = email_element.value;

        //Get password from input element "password"
        var password_element = document.getElementById("password_register");
        var password = password_element.value;
        
        //Get passwordconfirm from input element "passwordconfirm"
        var password_confirm_element = document.getElementById("password_register_confirm");
        var password_confirm = password_confirm_element.value;

        if (password_confirm!=password){
            console.error('Error: Passwords doesnt match');
            resultMessageElement.innerHTML = "Passwords doesn't match";
            return;
        }

        var data = {

            username: user_name,
            email: email,
            password: password,



        };

        fetch('includes/register_new_user.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from server:', data);
                
                resultMessageElement.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });




    }
</script>