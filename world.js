document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById("lookup");
    const countryInput = document.getElementById("country");
    const resultDiv = document.getElementById("result");

    lookupButton.addEventListener("click", function() {
        const country = countryInput.value;
        const url = "world.php?country=" + encodeURIComponent(country);

        fetch(url)
            .then(function(response) {
                return response.text();
            })
            .then(function(data) {
                resultDiv.innerHTML = data;
            })
            .catch(function(error) {
                resultDiv.innerHTML = "<p>Error fetching data: " + error + "</p>";
            });
    });

    countryInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            lookupButton.click();
        }
    });
});

