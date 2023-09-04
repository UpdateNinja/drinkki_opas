<?php
include("config.php");
session_start(); // Start the session

$id_array_current = array();
$id_array_previous = array();

// Set session variables
$_SESSION['id_array_current'] = $id_array_current;
$_SESSION['id_array_previous'] = $id_array_previous;

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

                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Numero</th>
                            <th style="width: 200px;">Kuva</th>
                            <th style="width: 200px;">Juoma</th>
                            <th style="width: 700px;">Ohjeet</th>
                            <th>Arvosana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $id_array_current[] = $id;
                            $image_url = $row['image_url'];
                            $title = $row['drink_name'];
                            $body = $row['descr'];
                            $rating = $row['rating'];
                            $rating_qty = $row['rating_qty'];
                        ?>
                            <tr class="drink" id=<?php echo $id ?>>
                                <td><?php echo $id ?></td>
                                <th><img src="<?php echo $image_url ?>" alt="Image Alt Text" class="table-image"></th>
                                <td><?php echo $title ?></td>
                                <td><?php echo $body ?></td>
                                <td>
                                    <?php include("starrating.php"); ?>
                                    <button onclick="openPopup('<?php echo $title ?>')" id="<?php echo $id ?>">Anna arvostelu</button>
                                </td>
                                <!-- Button to trigger the pop-up -->

                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
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

        <?php include("star_rating.php"); ?>
        <button onclick="sendReview()">Lähetä arvostelu</button>
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
                review_comment : comment,

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