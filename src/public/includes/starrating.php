<head>
    <style>
        /* Style the container */
        .scrollable-list {
            height: 200px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 20px;
        }

        /* Style the list items */
        .scrollable-list ul li {
            border-bottom: 1px solid #ccc;
            padding: 5px 0;
        }

        /* Style the user names (make them bold) */
        .scrollable-list ul li strong {
            font-weight: bold;
        }
    </style>
</head>

<?php

function getStarRating($drinkId, $con)
{

    $input = $drinkId;
    $datalist = [];

    $pattern = "/^[A-Za-z]+$/";


    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM reviews WHERE drink_id LIKE ? AND approved = 1";
    $input = '%' . $input . '%'; // Add wildcards for a partial match
    $average_rating = 0;
    $review_amount = 0;
    $review_comment = "";
    $review_user = "";


    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the input parameter
        mysqli_stmt_bind_param($stmt, "s", $input);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the results
        $result_review = mysqli_stmt_get_result($stmt);
        $review_amount = mysqli_num_rows($result_review);

        if ($review_amount > 0) {

            while ($row = mysqli_fetch_assoc($result_review)) {
                $rating = $row['review_rating'];
                $average_rating += $rating;
                $review_comment = $row['review_comment'];
                $review_user = $row['review_user'];

                $datalist[] = ["name" => $review_user, "comment" => $review_comment, "rating" => $rating];
            }
            $average_rating /= $review_amount;
        }
    }

?>

    <p style="font-weight: 600" ;>Arviot (<?php echo $review_amount; ?>)</p>
    <div class="scrollable-list">
        <ul>
            <?php foreach ($datalist as $row) : ?>
                <li>
                    <strong><?php echo $row["name"]; ?>:</strong> <?php echo $row["comment"]; ?> <?php echo $row["rating"]; ?>/5
                    <?php place_star_rating($row["rating"], false); ?>

                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php place_star_rating($average_rating, false); ?>
    <style>
        .rating-label,
        .rating_qty {
            display: inline-block;
            padding-top: 5px;
        }


        #review_send {
            margin: 20px 20px 20px 20px;

        }
    </style>

<?php

}

function place_star_rating($rating_number, $isInput)
{

?>

    <div class="left" style="display: flex; vertical-align: middle;">
        <svg viewBox="0 0 1000 200" class='rating' width="20%">
            <defs>




                <polygon id="star" points="100,0 131,66 200,76 150,128 162,200 100,166 38,200 50,128 0,76 69,66" />
            </defs>

            <!-- Clipping path for the stars -->
            <clipPath id="star-clip">
                <use xlink:href="#star" />
                <use xlink:href="#star" x="20%" />
                <use xlink:href="#star" x="40%" />
                <use xlink:href="#star" x="60%" />
                <use xlink:href="#star" x="80%" />
            </clipPath>

            <!-- Background for the rating system clipped to the star boundaries -->
            <rect class='rating__background' clip-path="url(#star-clip)"></rect>

            <!-- Change the width of this rect to change the rating -->
            <rect width="<?php echo ($rating_number * 20) ?>%" class="rating__value" clip-path="url(#star-clip)" id="ratingRect"></rect>


            <!-- Individual star elements with border color, hover effect, and scale transformation -->
            <use xlink:href="#star" class="star" />
            <use xlink:href="#star" x="20%" class="star" />
            <use xlink:href="#star" x="40%" class="star" />
            <use xlink:href="#star" x="60%" class="star" />
            <use xlink:href="#star" x="80%" class="star" />

            <?php
            if ($isInput == true) {
            ?>

                <!-- Individual star elements with border color, hover effect, and scale transformation -->
                <use xlink:href="#star" class="star_rating" />
                <use xlink:href="#star" x="20%" class="star_rating" />
                <use xlink:href="#star" x="40%" class="star_rating" />
                <use xlink:href="#star" x="60%" class="star_rating" />
                <use xlink:href="#star" x="80%" class="star_rating" />

                <!-- Individual invisible rectangles positioned over each star -->
                <rect class="invisible-rect" x="0" y="0" width="22%" height="200" />
                <rect class="invisible-rect" x="20%" y="0" width="22%" height="200" />
                <rect class="invisible-rect" x="40%" y="0" width="22%" height="200" />
                <rect class="invisible-rect" x="60%" y="0" width="22%" height="200" />
                <rect class="invisible-rect" x="80%" y="0" width="22%" height="200" />
            <?php
            } else {
            ?>
                <!-- Individual star elements with border color, hover effect, and scale transformation -->
                <use xlink:href="#star" class="star" />
                <use xlink:href="#star" x="20%" class="star" />
                <use xlink:href="#star" x="40%" class="star" />
                <use xlink:href="#star" x="60%" class="star" />
                <use xlink:href="#star" x="80%" class="star" />

            <?php
            }
            ?>

        </svg>
        <?php
            if ($isInput == false) {
            ?>
        <p class="right"> <?php echo number_format($rating_number, 1); ?>
        <?php
            }
            ?>

    </div>

<?php

}


?>