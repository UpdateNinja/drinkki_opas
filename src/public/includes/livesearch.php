<?php
include("config.php");
session_start(); // Start the session
include("starrating.php");
include("Drink.php");



$search_list = array();


if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $pattern = "/^[A-Za-z]+$/";

    if (preg_match($pattern, $input)) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM php_docker_table WHERE drink_name LIKE ? AND approved = 1";
        $input = '%' . $input . '%'; // Add wildcards for a partial match

        if ($stmt = mysqli_prepare($con, $query)) {
            // Bind the input parameter
            mysqli_stmt_bind_param($stmt, "s", $input);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the results
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
?>
                <div>
                <table class="table table-bordered table-striped modern-table">
                    <thead>
                        <tr>
                            <th class="rounded-start" style="width: 10%;">Numero</th>
                            <th style="width: 20%;">Kuva</th>
                            <th style="width: 10%;">Juoma</th>
                            <th style="width: 20%;">Ohjeet</th>
                            <th style="width: 40%;" class="rounded-end">Arvosana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $search_list[] = new Drink($row['id'], $row['drink_name'],$row['image_url'], $row['descr']);

                            

                        }

                        foreach ($search_list as $drink) {
                        ?>

                        

                            <tr class="drink" id=<?php echo $drink->get_id() ?>>
                                <td><?php echo $drink->get_id() ?></td>
                                <th><img src="<?php echo $drink->get_image_url() ?>" alt="Image Alt Text" class="table-image"></th>
                                <td><?php echo $drink->get_name() ?></td>
                                <td><?php echo $drink->get_instruction() ?></td>
                                
                                <td>
                                    <?php getStarRating($drink->get_id(), $con); ?>
                                    <button style="margin-top:10px" class="btn btn-outline-success" ; onclick="openPopup('<?php echo $drink->get_name() ?>')" id="<?php echo $drink->get_id() ?>">Anna arvostelu</button>
                                </td>
                                <!-- Button to trigger the pop-up -->

                            </tr>

                        <?php
                            

                        }

                        ?>


                    </tbody>
                </table>
                </div>
<?php
            } else {
                echo "<h6 class='text-center mt-3'>Ei ole!</h6>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<h6 class='text-center mt-3'>Virhe tiedonsiirrossa.</h6>";
        }
    } else {
        echo "<h6 class='text-center mt-3'>Hakusanan tulee sisältää vain A-Z ja a-z kirjaimia.</h6>";
    }
} else {
    echo "<h6 class='text-center mt-3'>Hakusanaa ei ole asetettu.</h6>";
}


?>

<body>

    <!-- The pop-up content -->
    <div id="popup" class="popup">
        <h2>Anna arvostelu</h2>
        <p>Arvostele drinkki : <span id="buttonIdPlaceholder"></p>

        <label for="fname">Nimi:</label><br>
        <input type="text" id="fname" name="fname"><br>

        <label for="comment">Kommentti:</label><br>

        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>

        <?php place_star_rating(0, true); ?>
        <button id="review_send" onclick="sendReview()">Lähetä arvostelu</button>
        <span onclick="closePopup()" class="close-button topright">&times</span>
    </div>

    <!-- The overlay background -->
    <div id="overlay" class="overlay"></div>

    <script>
        var stars = document.querySelectorAll('.star_rating');
        var invisibleRects = document.querySelectorAll('.invisible-rect');
        var ratingRect_rating = document.querySelector('.rating__value_rating');
        var buttonId;

        var rating_number;
        var isClicked = false;


        invisibleRects.forEach(function(invisibleRect, index) {
            invisibleRect.addEventListener('click', function() {
                console.log('Clicked on star at index:', index);
                console.log("drink row id: ", buttonId);
                isClicked = true;
                rating_number = index + 1;

                for (var i = 0; i < stars.length; i++) {
                    console.log("removing gold class:", i);
                    stars[i].classList.remove("gold");
                }

                for (var i = 0; i < index + 1; i++) {
                    console.log("setting gold class:", i);
                    stars[i].classList.add("gold");
                }

            });
        });



        invisibleRects.forEach(function(invisibleRect, index) {
            invisibleRect.addEventListener('mouseover', function() {

                if (isClicked == false) {
                    console.log('Mouse entered:', index);

                    for (var i = 0; i < index + 1; i++) {
                        console.log("setting gold class:", i);
                        stars[i].classList.add("gold");
                    }
                }
            });

            invisibleRect.addEventListener('mouseout', function() {
                if (isClicked == false) {

                    console.log('Mouse left:', index);
                    for (var i = 0; i < stars.length; i++) {
                        console.log("removing gold class:", i);
                        stars[i].classList.remove("gold");
                    }
                }
            });

        });


        function openPopup(name) {

            var button = event.target || event.srcElement;

            buttonId = button.id;
            isClicked = false;

            // Get the ID of the clicked button
            console.log(buttonId);


            // Display the button ID in the placeholder
            document.getElementById("buttonIdPlaceholder").textContent = name;

            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";

            for (var i = 0; i < stars.length; i++) {
                console.log("removing gold class:", i);
                stars[i].classList.remove("gold");
            }

        }

        function sendReview() {
            // Hide the pop-up and overlay

            var fname_element = document.querySelector('#fname')
            var fname = fname_element.value;
            console.log(fname);

            var comment_element = document.querySelector('#comment');
            var comment = comment_element.value;
            console.log(comment);

            var data = {
                rating: rating_number,
                id: buttonId,
                name: fname,
                review_comment: comment,

            };

            fetch('includes/updatenew.php', {
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

            closePopup();
        }

        function closePopup() {

            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";

        }
    </script>