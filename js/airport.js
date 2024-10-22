document.addEventListener('DOMContentLoaded', function () {

    var deleteButtons = document.querySelectorAll('.delete-btn');
    var updateButtons = document.querySelectorAll('.update-btn');
    var newForm = document.getElementById("new-form-1");
    var updateForm = document.getElementById("update-form-1");

    newForm.addEventListener('submit', function (event) {

        var formData = new FormData(newForm);

        var airportId = formData.get('a_id');
        var airportName = formData.get('a_name');
        var airportCountry = formData.get('a_country');
        var airportCity = formData.get('a_city');

        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                new_airport: true,
                a_id: airportId,
                a_name: airportName,
                a_country: airportCountry,
                a_city: airportCity
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    infoPopup("Success!", response.message);
                } else {
                    infoPopup("Error!", response.message);
                }
            },
            error: function (xhr, status, error) {
                infoPopup("Error!", "Something went wrong. Please try again later.");
            }
        });

        event.preventDefault();

    });

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var airportId = this.id;
            var airportCard = this.parentNode.parentNode.parentNode.parentNode;
            console.log(airportId);
            confPopup("Are you sure?", "Do you really want to delete this item? This process can't be undo.", function car() {
                $.ajax({
                    url: "function.php",
                    type: "POST",
                    data: { delete_airport: airportId },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            infoPopup("Success!", response.message);
                        } else {
                            infoPopup("Error!", response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        infoPopup("Error!", "Something went wrong. Please try again later.");
                    }
                });
            });
        });
    });

    updateForm.addEventListener('submit', function (event) {

        var formData = new FormData(updateForm);

        var airportId = formData.get('a_id');
        var airportName = formData.get('a_name');
        var airportCountry = formData.get('a_country');
        var airportCity = formData.get('a_city');

        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                update_airport: true,
                a_id: airportId,
                a_name: airportName,
                a_country: airportCountry,
                a_city: airportCity
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    infoPopup("Success!", response.message);
                } else {
                    infoPopup("Error!", response.message);
                }
            },
            error: function (xhr, status, error) {
                infoPopup("Error!", "Something went wrong. Please try again later.");
            }
        });

        event.preventDefault();

    });

    updateButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            window.scrollTo(0, 0);
            var updateForm = document.getElementById("update-form");
            var newForm = document.getElementById("new-form");
            updateForm.style.display = "block";
            newForm.style.display = "none";

            var card = button.closest('.card');

            // Get input fields within the card
            var airportId = card.querySelector('#a_id').value;
            var airportName = card.querySelector('#a_name').value;
            var airportCountry = card.querySelector('#a_country').value;
            var airportCity = card.querySelector('#a_city').value;

            updateForm.querySelector('#a_id').value = airportId;
            updateForm.querySelector('#a_name').value = airportName;
            updateForm.querySelector('#a_country').value = airportCountry;
            updateForm.querySelector('#a_city').value = airportCity;

        });
    });

});