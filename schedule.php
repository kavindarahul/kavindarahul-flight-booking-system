<?php 

    require_once('inc/config.inc.php'); 
    $page_title = "schedule";

    if (isset($_SESSION['user_id'])){ 
        if($_SESSION['user_role'] == 0){
            header('Location: index.php');
        }
    }else{
        header('Location: login.php');
    }

    $page_title = "Schedule";
    include("inc/admin_header.inc.php");


    $query_1 = "SELECT * FROM flight";
    $result_1 = mysqli_query($connection, $query_1);

    
    if($result_1){
        $flight_list = '';
        while($row = mysqli_fetch_assoc($result_1)) {
            $flight_id = $row['flight_id'];
            $flight_name = $row['flight_name'];
            $flight_list .= "<option value=\"$flight_id\">$flight_name</option>";
        }
    }

    $query_2 = "SELECT * FROM airport";
    $result_2 = mysqli_query($connection, $query_2);

    
    if($result_2){
        $airport_list = '';
        while($row = mysqli_fetch_assoc($result_2)) {
            $airport_id = $row['airport_id'];
            $airport_name = $row['airport_name'];
            $airport_list .= "<option value=\"$airport_id\">$airport_name</option>";
        }
    }

?>


<div class="container">

    <div class="row mt-4" id="new-form">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <form id="new-form-1">
                    <div class="form-grid">
                        <div class="col-md-6">
                            <label for="flight-name" class="form-label">Flight Name</label>
                            <select class="form-input" name="flight-name" id="flight-name" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($flight_list)){echo $flight_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gate-number" class="form-label">Gate Numbe</label>
                            <input type="text" class="form-input" name="gate-number" id="gate-number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-airport" class="form-label">Departure Airport</label>
                            <select class="form-input" name="departure-airport" id="departure-airport" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="arrival-airport" class="form-label">Arrival Airport</label>
                            <select class="form-input" name="arrival-airport" id="arrival-airport" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-date" class="form-label">Departure Date</label>
                            <input type="date" class="form-input" name="departure-date" id="departure-date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-time" class="form-label">Departure Time</label>
                            <input type="time" class="form-input" name="departure-time" id="departure-time" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ec-price" class="form-label">Economic Class Price ($)</label>
                            <input type="number" class="form-input" name="ec-price" id="ec-price" required>
                        </div>
                        <div class="col-md-6">
                            <label for="bc-price" class="form-label">Business Class Price ($)</label>
                            <input type="number" class="form-input" name="bc-price" id="bc-price" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" value="new_schedule" name="new_schedule">Add New</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>

    
    <div class="row mt-4" id="update-form" style="display:none">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <form id="update-form-1">
                    <div class="form-grid">
                        <div class="col-md-6">
                            <label for="flight-name" class="form-label">Flight Name</label>
                            <select class="form-input" name="flight-name" id="flight-name" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($flight_list)){echo $flight_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gate-number" class="form-label">Gate Numbe</label>
                            <input type="text" class="form-input" name="gate-number" id="gate-number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-airport" class="form-label">Departure Airport</label>
                            <select class="form-input" name="departure-airport" id="departure-airport" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="arrival-airport" class="form-label">Arrival Airport</label>
                            <select class="form-input" name="arrival-airport" id="arrival-airport" required>
                                <option value="">Open this select menu</option>
                                <?php if(isset($airport_list)){echo $airport_list;}?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-date" class="form-label">Departure Date</label>
                            <input type="date" class="form-input" name="departure-date" id="departure-date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departure-time" class="form-label">Departure Time</label>
                            <input type="time" class="form-input" name="departure-time" id="departure-time" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ec-price" class="form-label">Economic Class Price ($)</label>
                            <input type="number" class="form-input" name="ec-price" id="ec-price" required>
                        </div>
                        <div class="col-md-6">
                            <label for="bc-price" class="form-label">Business Class Price ($)</label>
                            <input type="number" class="form-input" name="bc-price" id="bc-price" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <Button type="submit" value="update_schedule" name="update_schedule">Update</Button>
                        <Button type="button" onclick="removeUpdate()"
                            style="background: rgb(212, 212, 212); color: rgb(0, 0, 0); margin-left: 0.25rem;">Cancel</Button>
                    </div>
                </form>    
            </div>
        </div>
    </div>

    <?php
    
        $query_3 = "SELECT schedule.*,flight.*,departure_airport.airport_name AS departure_airport_name, arrival_airport.airport_name AS arrival_airport_name FROM schedule JOIN flight ON schedule.f_id = flight.flight_id JOIN airport AS departure_airport ON schedule.departure_airport_id = departure_airport.airport_id JOIN airport AS arrival_airport ON schedule.arrival_airport_id = arrival_airport.airport_id;";
        $result_3 = mysqli_query($connection, $query_3);

        if($result_3){
            while($row = mysqli_fetch_assoc($result_3)) {
                ?>
                    <div class="row mt-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-head">
                                <div class="info">
                                    <div class="lable">Departed</div>
                                    <div class="lable">Business Class 32/60</div>
                                    <div class="lable">Economy Class 190/200</div>
                                </div>
                                <div class="action">
                                    <button class="update-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="delete-btn" id="<?php echo $row['s_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-grid">
                                    <div class="col-md-6">
                                        <label for="flight-name" class="form-label">Flight Name</label>
                                        <input type="text" class="form-input" name="flight-name" id="flight-name" value="<?php echo $row['flight_name']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gate-number" class="form-label">Gate Numbe</label>
                                        <input type="text" class="form-input" name="gate-number" id="gate-number" value="<?php echo $row['g_id'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="departure-airport" class="form-label">Departure Airport</label>
                                        <input type="text" class="form-input" name="departure-airport" id="departure-airport" value="<?php echo $row['departure_airport_name'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="arrival-airport" class="form-label">Arrival Airport</label>
                                        <input type="text" class="form-input" name="arrival-airport" id="arrival-airport" value="<?php echo $row['arrival_airport_name'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="departure-date" class="form-label">Departure Date</label>
                                        <input type="date" class="form-input" name="departure-date" id="departure-date" value="<?php echo $row['departure_date'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="departure-time" class="form-label">Departure Time</label>
                                        <input type="time" class="form-input" name="departure-time" id="departure-time" value="<?php echo $row['departure_time'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ec-price" class="form-label">Economic Class Price ($)</label>
                                        <input type="number" class="form-input" name="ec-price" id="ec-price" value="<?php echo $row['e_class_price'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bc-price" class="form-label">Business Class Price ($)</label>
                                        <input type="number" class="form-input" name="bc-price" id="bc-price" value="<?php echo $row['b_class_price'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
    
    ?>

</div>

<!-- we use jquery only for the ajax request sending (other all function write by javascript)-->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="js/schedule.js"></script>

<?php include("inc/admin_footer.inc.php")?>