document.addEventListener('DOMContentLoaded', function () {

    var newForm = document.getElementById("new-form-1");
    var deleteButtons = document.querySelectorAll('.delete-btn');
    var updateButtons = document.querySelectorAll('.update-btn');

    updateButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            window.scrollTo(0, 0);
            var updateForm = document.getElementById("update-form");
            var newForm = document.getElementById("new-form");
            updateForm.style.display = "block";
            newForm.style.display = "none";

            var card = button.closest('.card');

            // Get input fields within the card
            var flight_name = card.querySelector('#flight-name').value;
            var gate_number = card.querySelector('#gate-number').value;
            var departure_airport = card.querySelector('#departure-airport').value;
            var arrival_airport = card.querySelector('#arrival-airport').value;
            var departure_date = card.querySelector('#departure-date').value;
            var departure_time = card.querySelector('#departure-time').value;
            var ec_price = card.querySelector('#ec-price').value;
            var bc_price = card.querySelector('#ec-price').value;

            //updateForm.querySelector('#flight-name').value = flight_name;
            updateForm.querySelector('#gate-number').value = gate_number;
            //updateForm.querySelector('#departure-airport').value = departure_airport;
            //updateForm.querySelector('#arrival-airport').value = arrival_airport;
            updateForm.querySelector('#departure-date').value = departure_date;
            updateForm.querySelector('#departure-time').value = departure_time;
            updateForm.querySelector('#ec-price').value = ec_price;
            updateForm.querySelector('#ec-price').value = bc_price;

        });
    });

    newForm.addEventListener('submit', function (event) {

        var formData = new FormData(newForm);

        var flightName = formData.get('flight-name');
        var gateNumber = formData.get('gate-number');
        var departureAirport = formData.get('departure-airport');
        var arrivalAirport = formData.get('arrival-airport');
        var departureDate = formData.get('departure-date');
        var departureTime = formData.get('departure-time');
        var ecPrice = formData.get('ec-price');
        var bcPrice = formData.get('bc-price');


        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                new_schedule: true,
                flight_name: flightName,
                gate_number: gateNumber,
                departure_airport: departureAirport,
                arrival_airport: arrivalAirport,
                departure_date: departureDate,
                departure_time: departureTime,
                ec_price: ecPrice,
                bc_price: bcPrice
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
            var sId = this.id;
            var sCard = this.parentNode.parentNode.parentNode.parentNode;
            console.log(sId);
            confPopup("Are you sure?", "Do you really want to delete this item? This process can't be undo.", function car() {
                $.ajax({
                    url: "function.php",
                    type: "POST",
                    data: { delete_schedule: sId },
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

        var flightName = formData.get('flight-name');
        var gateNumber = formData.get('gate-number');
        var departureAirport = formData.get('departure-airport');
        var arrivalAirport = formData.get('arrival-airport');
        var departureDate = formData.get('departure-date');
        var departureTime = formData.get('departure-time');
        var ecPrice = formData.get('ec-price');
        var bcPrice = formData.get('bc-price');

        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                update_schedule: true,
                flight_name: flightName,
                gate_number: gateNumber,
                departure_airport: departureAirport,
                arrival_airport: arrivalAirport,
                departure_date: departureDate,
                departure_time: departureTime,
                ec_price: ecPrice,
                bc_price: bcPrice
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





});