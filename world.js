document.addEventListener("DOMContentLoaded", function() {
    const lookupButton = document.getElementById("lookup");
    const lookupCitiesButton = document.getElementById("lookup-cities");
    const countryInput = document.getElementById("country");
    const resultDiv = document.getElementById("result");

    function fetchData(lookupType) {
        const country = countryInput.value;
        let url = "world.php?country=" + encodeURIComponent(country);

        if (lookupType === "cities") {
            url += "&lookup=cities";
        }

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
    }

    lookupButton.addEventListener("click", function() {
        fetchData("countries");
    });

    lookupCitiesButton.addEventListener("click", function() {
        fetchData("cities");
    });

    countryInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            lookupButton.click();
        }
    });
});
