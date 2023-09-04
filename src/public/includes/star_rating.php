<div style="display: inline-block; vertical-align: middle;">
    <svg viewBox="0 0 1000 200" class='rating' width="40%">
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
        <rect width="<?php echo ($rating * 20) ?>%" class="rating__value_rating" clip-path="url(#star-clip)" id="ratingRect"></rect>


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


    </svg>


</div>
<style>
    .rating-label,
    .rating_qty {
        display: inline-block;
        padding-top: 5px;
    }
</style>



