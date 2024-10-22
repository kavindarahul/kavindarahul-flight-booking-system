<?php 

    require_once('inc/config.inc.php'); 

    if (isset($_SESSION['user_id'])){ 
        if($_SESSION['user_role'] == 0){
            header('Location: index.php');
        }
    }else{
        header('Location: login.php');
    }

    $page_title = "Airport";
    include("inc/admin_header.inc.php");

?>

<div class="container">

    <div class="row mt-4" id="new-form">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <form id="new-form-1">
                    <div class="form-grid">
                        <div class="col-md-6">
                            <label for="a_id" class="form-label">Airport code</label>
                            <input type="number" class="form-input" id="a_id" name="a_id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_name" class="form-label">Airport Name</label>
                            <input type="text" class="form-input" id="a_name" name="a_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_country" class="form-label">Country</label>
                            <input type="text" class="form-input" id="a_country" name="a_country" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_city" class="form-label">City</label>
                            <input type="text" class="form-input" id="a_city" name="a_city" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" value="new_airport" name="new_airport">Add New</button>
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
                            <label for="a_id" class="form-label">Airport code</label>
                            <input type="number" class="form-input" id="a_id" name="a_id" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="a_name" class="form-label">Airport Name</label>
                            <input type="text" class="form-input" id="a_name" name="a_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_country" class="form-label">Country</label>
                            <input type="text" class="form-input" id="a_country" name="a_country" required>
                        </div>
                        <div class="col-md-6">
                            <label for="a_city" class="form-label">City</label>
                            <input type="text" class="form-input" id="a_city" name="a_city" required>
                        </div>
                    </div>
                    <div class="form-btn">
                        <Button type="submit" value="update_airport" name="update_airport">Update</Button>
                        <Button type="button" onclick="removeUpdate()"
                            style="background: rgb(212, 212, 212); color: rgb(0, 0, 0); margin-left: 0.25rem;">Cancel</Button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    
        $query_3 = "SELECT * FROM airport";
        $result_3 = mysqli_query($connection, $query_3);

        if($result_3){
            while($row = mysqli_fetch_assoc($result_3)) {
                ?>
                    <div class="row mt-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-head">
                                <div class="info">
                                    <div class="lable">Airport Information</div>
                                </div>
                                <div class="action">
                                    <button class="update-btn"><i class="fa-solid fa-pen"></i></button>
                                    <button class="delete-btn" id="<?php echo $row['airport_id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-grid">
                                    <div class="col-md-6">
                                        <label for="f_id" class="form-label">Airport code</label>
                                        <input type="text" class="form-input" id="a_id" value="<?php echo $row['airport_id']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="f_name" class="form-label">Airport Name</label>
                                        <input type="text" class="form-input" id="a_name" value="<?php echo $row['airport_name']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="a_country" class="form-label">Country</label>
                                        <input type="text" class="form-input" id="a_country" value="<?php echo $row['airport_country']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="a_city" class="form-label">City</label>
                                        <input type="text" class="form-input" id="a_city" value="<?php echo $row['airport_city']; ?>">
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
<script src="js/airport.js"></script>

<?php include("inc/admin_footer.inc.php")?>