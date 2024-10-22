<?php

require_once('inc/config.inc.php'); 

if (!isset($_SESSION['user_id'])){ 
    header('Location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["passengers"])) {

        $passengers = json_decode($_POST['passengers'], true);
        $s_id = mysqli_real_escape_string($connection,$_POST['s_id']);
        $ec_price = mysqli_real_escape_string($connection,$_POST['ec_price']);
        $bc_price = mysqli_real_escape_string($connection,$_POST['bc_price']);

        $user_id = $_SESSION['user_id'];

        foreach ($passengers as $passenger) {
            $fullName = $passenger['full-name'];
            $birthday = $passenger['birthday'];
            $contactNumber = $passenger['contact-number'];
            $passportNumber = $passenger['passport-number'];
            $email = $passenger['email'];
            $type = $passenger['ticket-type'];
            
            $randomNumber = rand(1, 200);

            if($type == 'ec'){
                $price = $ec_price;
                $seat_number = "E-" . $randomNumber;
            }elseif($type == 'bc'){
                $price = $bc_price;
                $seat_number = "B-" . $randomNumber;
            }

            $query_1 = "INSERT INTO `passenger` (`p_id`, `p_name`, `p_email`, `passport_no`, `birthday`) VALUES (NULL, '$fullName', '$email', '$passportNumber', ' $birthday')";
            $result_1 = mysqli_query($connection, $query_1);

            if ($result_1) {
                
                $query_2 = "INSERT INTO `ticket` (`ticket_id`, `schedule_id`, `passenger_id`, `booked_by`, `booked_date`, `seat_number`) 
                VALUES (null, '$s_id', (SELECT MAX(p_id) FROM passenger), '$user_id', CURDATE(), '$seat_number')";
                $result_2 = mysqli_query($connection, $query_2);

                if ($result_2) {
                    $query_3 = "INSERT INTO `transaction` (`tr_id`, `tr_name`, `tr_note`, `tr_amount`, `tr_date`, `tr_status`) VALUES (NULL, 'flight ticket booking', 'flight ticket booking', '$price', CURDATE(), '1')";
                    $result_3 = mysqli_query($connection, $query_3);

                    if($result_3) {
                        $query_4 = "INSERT INTO `user_transaction` (`user_id`, `transaction_id`) VALUES ('$user_id', (SELECT MAX(tr_id) FROM `transaction`))";
                        $result_4 = mysqli_query($connection, $query_4);

                        if($result_4) {

                        }
                            
                    }

                }

            }

        }
    
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .payment-form {
            background: #fff;
            padding: 40px;
            max-width: 350px;
            width: 350px;
            font-size: 15px;
            border-radius: 4px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .payment-form h3 {
            font-size: 28px;
        }

        .login-form p {
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            border: none;
            background: #eee;
            border-radius: 4px;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            background: #1c255b;
            color: #fff;
            border-radius: 4px;
        }

        .col-6 {
            width: 60%;
        }

        .col-4 {
            width: 40%;
        }

        .ml-0-5 {
            margin-left: 0.5rem;
        }

        .mr-0-5 {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body class="bg-2">

    <div class="login-container">

        <div class="payment-form">

            <form id="new-form-1" action="profile.php">

                <div class="mb-1">
                    <h3>Payment</h3>
                </div>

                <div class="mb-1">
                    <label for="">Card Number</label>
                    <input type="text" class="form-input" id="username" placeholder="5431 1111 1111 1111">
                </div>

                <div class="mb-1 d-flex justify-content-between">
                    <div class="mb-1 col-6 mr-0-5">
                        <label for="">Exp Date</label>
                        <input type="date" class="form-input" id="password">
                    </div>
                    <div class="mb-1 col-4 ml-0-5">
                        <label for="">CVV</label>
                        <input type="password" class="form-input" placeholder="***" id="password">
                    </div>
                </div>

                <div class="mb-1">
                    <input type="submit" value="Pay" class="btn-login">
                </div>

            </form>

        </div>

    </div>

    <script src="js/main.js"></script>

</body>

</html>