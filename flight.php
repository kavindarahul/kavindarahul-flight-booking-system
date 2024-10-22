<?php 

    require_once('inc/config.inc.php'); 

    if (isset($_SESSION['user_id'])){ 
        if($_SESSION['user_role'] == 0){
            header('Location: index.php');
        }
    }else{
        header('Location: login.php');
    }

    $page_title = "Flight";
    include("inc/admin_header.inc.php");

?>

<div class="container">

    <div class="row mt-4" id="new-form">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <form id="new-form-1">
                    <div class="form-grid">
                        <div class="col-md-6">
                            <label for="f_id" class="form-label">Flight Id</label>
                            <input type="number" class="form-input" id="f_id" name="f_id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="f_name" class="form-label">Flight Name</label>
                            <input type="text" class="form-input" id="f_name" name="f_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="e_seats" class="form-label">Economy Seats</label>
                            <input type="number" class="form-input" id="e_seats" name="e_seats" required>
                        </div>
                        <div class="col-md-6">
                            <label for="b_seats" class="form-label">Business Seats</label>
                            <input type="number" class="form-input" id="b_seats" name="b_seats" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" value="new_flight" name="new_flight">Add New</button>
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
                            <label for="f_id" class="form-label">Flight Id</label>
                            <input type="number" class="form-input" id="f_id" name="f_id" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="f_name" class="form-label">Flight Name</label>
                            <input type="text" class="form-input" id="f_name" name="f_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="e_seats" class="form-label">Economy Seats</label>
                            <input type="number" class="form-input" id="e_seats" name="e_seats" required>
                        </div>
                        <div class="col-md-6">
                            <label for="b_seats" class="form-label">Business Seats</label>
                            <input type="number" class="form-input" id="b_seats" name="b_seats" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <Button type="submit" value="update_flight" name="update_flight">Update</Button>
                        <Button type="button" onclick="removeUpdate()"
                            style="background: rgb(212, 212, 212); color: rgb(0, 0, 0); margin-left: 0.25rem;">Cancel</Button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    
        $query_3 = "SELECT * FROM flight";
        $result_3 = mysqli_query($connection, $query_3);

        if($result_3){
            while($row = mysqli_fetch_assoc($result_3)) {
                ?>
                    <div class="row mt-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-head">
                                <div class="info">
                                    <div class="lable">Flight Information</div>
                                </div>
                                <div class="action">
                                    <button class="update-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="delete-btn" id="<?php echo $row['flight_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-grid">
                                    <div class="col-md-6">
                                        <label for="f_id" class="form-label">Flight Id</label>
                                        <input type="text" class="form-input" id="f_id" value="<?php echo $row['flight_id']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="f_name" class="form-label">Flight Name</label>
                                        <input type="text" class="form-input" id="f_name" value="<?php echo $row['flight_name']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="b_seats" class="form-label">Economy Seats</label>
                                        <input type="number" class="form-input" id="e_seats" value="<?php echo $row['e_seats']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="e_seats" class="form-label">Business Seats</label>
                                        <input type="number" class="form-input" id="b_seats" value="<?php echo $row['b_seats']; ?>"
                                            readonly>
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
<script src="js/flight.js"></script>

<?php include("inc/admin_footer.inc.php")?>