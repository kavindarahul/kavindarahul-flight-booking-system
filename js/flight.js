document.addEventListener('DOMContentLoaded', function () {

    var deleteButtons = document.querySelectorAll('.delete-btn');
    var updateButtons = document.querySelectorAll('.update-btn');
    var updateForm = document.getElementById("update-form-1");
    var newForm = document.getElementById("new-form-1");

    newForm.addEventListener('submit', function (event) {

        var formData = new FormData(newForm);

        var flightId = formData.get('f_id');
        var flightName = formData.get('f_name');
        var economySeats = formData.get('e_seats');
        var businessSeats = formData.get('b_seats');

        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                new_flight: true,
                f_id: flightId,
                f_name: flightName,
                e_seats: economySeats,
                b_seats: businessSeats
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
            var flightId = this.id;
            var flightCard = this.parentNode.parentNode.parentNode.parentNode;
            console.log(flightId);
            confPopup("Are you sure?", "Do you really want to delete this item? This process can't be undo.", function car() {
                $.ajax({
                    url: "function.php",
                    type: "POST",
                    data: { delete_flight: flightId },
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

        var flightId = formData.get('f_id');
        var flightName = formData.get('f_name');
        var economySeats = formData.get('e_seats');
        var businessSeats = formData.get('b_seats');

        $.ajax({
            url: "function.php",
            type: "POST",
            data: {
                update_flight: true,
                f_id: flightId,
                f_name: flightName,
                e_seats: economySeats,
                b_seats: businessSeats
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
            var flightId = card.querySelector('#f_id').value;
            var flightName = card.querySelector('#f_name').value;
            var economySeats = card.querySelector('#e_seats').value;
            var businessSeats = card.querySelector('#b_seats').value;

            updateForm.querySelector('#f_id').value = flightId;
            updateForm.querySelector('#f_name').value = flightName;
            updateForm.querySelector('#e_seats').value = economySeats;
            updateForm.querySelector('#b_seats').value = businessSeats;

        });
    });

});