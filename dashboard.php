<?php 

require_once('inc/config.inc.php'); 

if (isset($_SESSION['user_id'])){ 
    if($_SESSION['user_role'] == 0){
        header('Location: index.php');
    }
}else{
    header('Location: login.php');
}

$page_title = "Dashboard";

include("inc/admin_header.inc.php");

?>

<div class="container">
    <div class="card_grid">

        <div class="card">
            <div class="card-info">
                <p>Total Transaction</p>
                <div class="booking_price">
                    <div class="price">$38500</div>
                    <button class="book__now">More Info</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-info">
                <p>Total Flight</p>
                <div class="booking_price">
                    <div class="price">5</div>
                    <button class="book__now">More Info</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-info">
                <p>Total Airport</p>
                <div class="booking_price">
                    <div class="price">6</div>
                    <button class="book__now">More Info</button>
                </div>
            </div>
        </div>

    </div>
    <div class="card mt-3 ">
        <div class="card-info">
            <p class="p-msg">
                There is no data available at this moment.
            </p>

        </div>
    </div>
</div>

<?php include("inc/admin_footer.inc.php")?>