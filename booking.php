<?php 

    require_once('inc/config.inc.php'); 

    if (!isset($_SESSION['user_id'])){ 
        header('Location: login.php');
    }

    $page_name = "booking"; 
    include("inc/header.inc.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['book'])){
            $schedule_id  = mysqli_real_escape_string($connection, $_POST['book']); //prevent my SQL injection
            $e_class_price = mysqli_real_escape_string($connection, $_POST['e_class_price']);
            $b_class_price = mysqli_real_escape_string($connection, $_POST['b_class_price']);
        }
    }

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

    .add-new-btn button {
        margin-top: 2rem;
        border: none;
        padding: 15px 50px;
        background: #1c255b;
        color: #fff;
        border-radius: 4px;
        font-size: 15px;
    }

    .price-box {
        display: flex;
        justify-content: space-between;
    }
</style>


<div class="container">

    <form id="pricess" style="display:none">
        <input type="number" name="ec" id="ec" value="<?php if(isset($e_class_price)){echo $e_class_price; } ?>"
            style="display:none" readonly>
        <input type="number" name="bc" id="bc" value="<?php if(isset($b_class_price)){echo $b_class_price; } ?>"
            style="display:none" readonly>
    </form>

    <div class="row">
        <div class="card mt-2" style="width: 100%;" id="card">
            <div class="card-body">
                <form>
                    <div class="form-grid">
                        <div class="col-md-6">
                            <label for="full-name" class="form-label">Full Name</label>
                            <input type="text" class="form-input" name="full-name" id="full-name">
                        </div>
                        <div class="col-md-6">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-input" name="birthday" id="birthday">
                        </div>
                        <div class="col-md-6">
                            <label for="contact-number" class="form-label">Contact Number</label>
                            <input type="text" class="form-input" name="contact-number" id="contact-number">
                        </div>
                        <div class="col-md-6">
                            <label for="passport-number" class="form-label">Passport Number</label>
                            <input type="number" class="form-input" name="passport-number" id="passport-number">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-input" name="email" id="email">
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Ticket Type</label>
                            <select class="form-input" name="ticket-type" id="ticket-type">
                                <option value="0">Open this select menu</option>
                                <option value="ec">Economic Class</option>
                                <option value="bc">Business Class</option>
                            </select>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="add-new-btn">
            <Button onclick="duplicateForm()">Add New Passenger</Button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="price-box form-btn">
                    <h1 id="price_text">Total amount payable = </h1>
                    <button type="button" id="confirm" onclick="confirm()" class="btn btn-success">Confirm</button>
                    <button type="button" id="proceed" onclick="getPassengerInfo()" class="btn btn-success"
                        style="display:none">Proceed to Pay</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    function duplicateForm() {
        const formContainer = document.getElementById('card');
        const clone = formContainer.cloneNode(true);
        formContainer.parentNode.appendChild(clone);
    }


    function confirm() {

        var confirmButton = document.getElementById('confirm');
        var proceedButton = document.getElementById('proceed');

        confirmButton.style.display = 'none';
        proceedButton.style.display = 'block';

        var dropdowns = document.querySelectorAll('#ticket-type');
        var totalEC = 0;
        var totalBC = 0;

        // Loop through each select dropdown
        dropdowns.forEach(function (dropdown) {
            // Get the selected value
            var selectedValue = dropdown.value;
            if (selectedValue == 'ec') {
                totalEC++;
            } else if (selectedValue == 'bc') {
                totalBC++;
            }
        });

        var ecPrice = document.getElementById('ec').value;
        var bcPrice = document.getElementById('bc').value;

        var totalPrice = (ecPrice * totalEC) + (bcPrice * totalBC);
        document.getElementById('price_text').innerText = "Total amount payable = " + totalPrice;

    }

    function getPassengerInfo() {

        const forms = document.querySelectorAll('.card-body form');
        const passengers = [];

        forms.forEach(form => {
            const inputs = form.querySelectorAll('.form-input');
            const passenger = {};

            inputs.forEach(input => {
                passenger[input.getAttribute('name')] = input.value;
            });

            passengers.push(passenger);
        });

        // Create a hidden form element
        const form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', 'payment.php');
        form.style.display = 'none';

        // Create an input element to hold the passengers data
        const passengersInput = document.createElement('input');
        passengersInput.setAttribute('type', 'hidden');
        passengersInput.setAttribute('name', 'passengers');
        passengersInput.setAttribute('value', JSON.stringify(passengers));

        // Create an input element to hold the schedule id
        const scheduleIdInput = document.createElement('input');
        scheduleIdInput.setAttribute('type', 'hidden');
        scheduleIdInput.setAttribute('name', 's_id');
        scheduleIdInput.setAttribute('value', '<?php echo $schedule_id ?>');

        // Create an input element to hold the e_class_price
        const ecPriceInput = document.createElement('input');
        ecPriceInput.setAttribute('type', 'hidden');
        ecPriceInput.setAttribute('name', 'ec_price');
        ecPriceInput.setAttribute('value', '<?php echo $e_class_price ?>');

        // Create an input element to hold the b_class_price
        const bcPriceInput = document.createElement('input');
        bcPriceInput.setAttribute('type', 'hidden');
        bcPriceInput.setAttribute('name', 'bc_price');
        bcPriceInput.setAttribute('value', '<?php echo $b_class_price ?>');

        // Append the input elements to the form
        form.appendChild(passengersInput);
        form.appendChild(scheduleIdInput);
        form.appendChild(ecPriceInput);
        form.appendChild(bcPriceInput);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }



</script>

<?php include("inc/footer.inc.php"); ?>