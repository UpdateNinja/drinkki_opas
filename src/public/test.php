<label for="fname">Nimi:</label><br>
<input type="text" id="fname" name="fname"><br>

<button onclick="getData()">Get Name</button>

<script>
function getData() {
    // Get the input element by its ID
    var inputElement = document.getElementById("fname");

    // Get the value entered by the user
    var name = inputElement.value;

    // Display the name in the console (you can use it as needed)
    console.log("Name entered: " + name);
}
</script>