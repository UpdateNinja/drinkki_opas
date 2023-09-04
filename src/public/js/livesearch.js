$(document).ready(function () {
    var debounceTimeout; // Initialize the timeout variable

    $('#live_search').keyup(function () {
        var input = $(this).val();

        // Clear the previous timeout
        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(function () {
            if (input != "") {
                $.ajax({

                    url: "includes/livesearch.php",
                    method: "POST",
                    data: {
                        input,
                        input
                    },

                    success: function (data) {
                        $("#searchresult").html(data);
                        $("#searchresult").css("display", "block");


                    }

                });
            } else {
                $("#searchresult").css("display", "none");
            }
        }, 500);
    });
});
