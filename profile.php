<?php 

    require_once('inc/config.inc.php'); 

    if (!isset($_SESSION['user_id'])){ 
        header('Location: login.php');
    }

    $page_name = "Profile"; 
    include("inc/header.inc.php");

?>

<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .card-body {
        padding: 2rem;
    }
    .mt-4 {
        margin-top: 4rem;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .form-btn button {
        border: none;
        padding: 15px 50px;
        background: #1c255b;
        color: #fff;
        border-radius: 4px;
        font-size: 15px;
    }
    .form-input {
        width: 100%;
        padding: 14px;
        border: none;
        background: #eee;
        border-radius: 4px;
    }
    .card-head {
        padding: 1rem 2rem;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
    }
    .action button {
        padding-left: 15px;
        border: none;
        background: none;
        font-size: 15px;
        cursor: pointer;
    }
    .info {
        display: flex;
        flex-direction: row;
    }
    .info .lable {
        font-size: 15px;
        padding-right: 30px;
        font-weight: 600;
        color: #000000bd;
    }
</style>
<div class="container">

<?php

        $user_id = $_SESSION['user_id'];
    
        $query_3 = "SELECT a1.airport_name AS arrival_airport_name, a2.airport_name AS departure_airport_name, s.departure_date, s.e_class_price, s.b_class_price, s.departure_time, p.p_name, t.ticket_id, t.booked_by, t.seat_number FROM ticket AS t INNER JOIN schedule AS s ON t.schedule_id = s.s_id INNER JOIN passenger AS p ON t.passenger_id = p.p_id INNER JOIN airport AS a1 ON s.arrival_airport_id = a1.airport_id INNER JOIN airport AS a2 ON s.departure_airport_id = a2.airport_id WHERE t.booked_by = '$user_id';";
        $result_3 = mysqli_query($connection, $query_3);

        if($result_3){
            if(mysqli_num_rows($result_3) >= 1) {
                while($row = mysqli_fetch_assoc($result_3)) {
                    ?>
                        <div class="row mt-4">
                            <div class="card" style="width: 100%;">
                                <div class="card-head">
                                    <div class="info">
                                        Ticket Information
                                    </div>
                                    <div class="action">
                                        <button class="delete-btn" data-class="<?php echo $row['seat_number'];?>" data-ec-price="<?php echo $row['e_class_price']; ?>" data-bc-price="<?php echo $row['b_class_price']; ?>" id="<?php echo $row['ticket_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-grid">
                                        <div class="col-md-6">
                                            <label for="flight-name" class="form-label">Passenger Name</label>
                                            <input type="text" class="form-input" name="passenger-name" id="passenger-name" value="<?php echo $row['p_name']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gate-number" class="form-label">From</label>
                                            <input type="text" class="form-input" name="gate-number" id="gate-number" value="<?php echo $row['departure_airport_name'];?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="departure-airport" class="form-label">To</label>
                                            <input type="text" class="form-input" name="departure-airport" id="departure-airport" value="<?php echo $row['arrival_airport_name'];?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="arrival-airport" class="form-label">Date</label>
                                            <input type="text" class="form-input" name="arrival-airport" id="arrival-airport" value="<?php echo $row['departure_date'];?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="departure-date" class="form-label">Time</label>
                                            <input type="text" class="form-input" name="departure-date" id="departure-date" value="<?php echo $row['departure_time'];?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="departure-time" class="form-label">Seat Number</label>
                                            <input type="text" class="form-input" name="departure-time" id="departure-time" value="<?php echo $row['seat_number'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?PHP
                }
            }else{
                ?>
                    <p class="p-msg">
                        There are not data available in here.
                    </p>
                <?php
            }
        }

?>
</div>

<!-- we use jquery only for the ajax request sending (other all function write by javascript)-->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var ticket_id = this.id;
                var ecPrice = button.getAttribute("data-ec-price");
                var bcPrice = button.getAttribute("data-bc-price"); 
                var className = button.getAttribute("data-class");

                // Check if the first letter is 'E'
                if (className.charAt(0) == 'E') {
                    var price = ecPrice;
                }else if(className.charAt(0) == 'B'){
                    var price = bcPrice;
                }
                
                confPopup("Are you sure?", "Do you really want to delete this item? This process can't be undo.", function deleteTicket() {
                    //get by bosilu
                    $.ajax({
                        url: "user_function.php",
                        type: "POST",
                        data: { delete_ticket: ticket_id,ticket_price: price },
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
    });
</script>

<?php include("inc/footer.inc.php"); ?>