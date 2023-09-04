
var drinkRows = document.querySelectorAll('.drink');


drinkRows.forEach(function (drinkRow) {
    var stars = drinkRow.querySelectorAll('.star');
    var invisibleRects = drinkRow.querySelectorAll('.invisible-rect');
    var ratingRect = drinkRow.querySelector('.rating__value');




    invisibleRects.forEach(function (invisibleRect, index) {
        invisibleRect.addEventListener('click', function () {
            console.log('Clicked on star at index:', index);
            console.log("drink row id: ", drinkRow.id);
            ratingRect.setAttribute('width', ((index + 1) * 20) + '%');
            var ratingQtyElement = drinkRow.querySelector(".rating_qty");
            console.log(ratingQtyElement);
            var currentRatingQty = parseInt(ratingQtyElement.textContent);
            console.log(currentRatingQty);

            var newRatingQty = currentRatingQty + 1;


            ratingQtyElement.textContent = newRatingQty;



            var data = {
                rating: index + 1,
                id: drinkRow.id,
            };

            fetch('includes/update.php', {
                method: 'POST',
                body: JSON.stringify({
                    rating: index + 1,
                    id: drinkRow.id
                }), // Sending the new rating as JSON
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

        });
    });



    invisibleRects.forEach(function (invisibleRect, index) {
        invisibleRect.addEventListener('mouseover', function () {
            isMouseOverStars = true;
            console.log('Mouse entered:', index);

            for (var i = 0; i < index + 1; i++) {
                console.log("setting gold class:", i);
                stars[i].classList.add("gold");
            }



        });

        invisibleRect.addEventListener('mouseout', function () {
            isMouseOverStars = false;
            console.log('Mouse left:', index);
            for (var i = 0; i < stars.length; i++) {
                console.log("removing gold class:", i);
                stars[i].classList.remove("gold");
            }
        });

    });

    drinkRow.addEventListener('mouseenter', function () {
        console.log('Mouse entered:');
    });

    drinkRow.addEventListener('mouseleave', function () {
        console.log('Mouse left:');
    });
});
