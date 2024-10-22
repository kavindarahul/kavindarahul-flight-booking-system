<?php 

    require_once('inc/config.inc.php'); 
    $page_name = "search"; 
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

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if(isset($_GET['from'])){

                    $from      =  mysqli_real_escape_string($connection,$_GET['from']);
                    $to        =  mysqli_real_escape_string($connection,$_GET['to']);
                    $date      =  mysqli_real_escape_string($connection,$_GET['date']);
                    $passenger =  mysqli_real_escape_string($connection,$_GET['count']);

                    $query_1 = "SELECT schedule.*,flight.*,departure_airport.airport_name AS departure_airport_name, arrival_airport.airport_name AS arrival_airport_name FROM schedule JOIN flight ON schedule.f_id = flight.flight_id JOIN airport AS departure_airport ON schedule.departure_airport_id = departure_airport.airport_id JOIN airport AS arrival_airport ON schedule.arrival_airport_id = arrival_airport.airport_id WHERE departure_airport_id='$from' AND arrival_airport_id='$to' AND departure_date = '$date';";
                    $result_1 = mysqli_query($connection, $query_1);
                    
                    if(mysqli_num_rows($result_1) >= 1) {
                        while($row = mysqli_fetch_assoc($result_1)) {
                            ?>
                            
                                <div class="row mt-4">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="form-grid">
                                                <div class="col-md-6">
                                                    <label for="from" class="form-label">From</label>
                                                    <input type="text" class="form-input" id="from" value="<?php echo $row['departure_airport_name'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="to" class="form-label">To</label>
                                                    <input type="text" class="form-input" id="to" value="<?php echo $row['arrival_airport_name'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" class="form-input" id="date" value="<?php echo $row['departure_date'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="time" class="form-label">Time</label>
                                                    <input type="time" class="form-input" id="time" value="<?php echo $row['departure_time'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ec_price" class="form-label">Economy Class Price ($)</label>
                                                    <input type="number" class="form-input" id="ec_price" value="<?php echo $row['e_class_price'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bc_price" class="form-label">Business Class Price ($)</label>
                                                    <input type="email" class="form-input" id="bc_price" value="<?php echo $row['b_class_price'];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-btn">
                                                <form action="booking.php" method="post">
                                                    <button type="submit" name="book" value="<?php echo $row['s_id'];?>">Book Now</button>
                                                    <input  type="number" name="b_class_price" id="bc" value="<?php echo $row['b_class_price'];?>" style="visibility: hidden;" readonly>
                                                    <input  type="number" name="e_class_price" id="ec" value="<?php echo $row['e_class_price'];?>" style="visibility: hidden;" readonly>
                                                </form>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                        }
                    }else{

                        ?>

                          <p class="p-msg">
                            Sorry! there is no flight schedule to related your requirement.
                          </p>

                        <?php

                    }

                }
            }

        ?>

    </div>

<script>
    /*document.addEventListener('DOMContentLoaded', function () {

        var bookButtons = document.querySelectorAll('.book');

        bookButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var scheduleId = this.id;
                console.log(scheduleId);
            });
        });

    });*/
</script>
<?php include("inc/footer.inc.php"); ?>