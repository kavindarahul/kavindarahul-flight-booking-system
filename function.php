<?php

require_once('inc/config.inc.php'); 

header('Content-Type: application/json');

if (isset($_SESSION['user_id'])){ 
    if($_SESSION['user_role'] == 0){
        header('Location: index.php');
    }
}else{
    header('Location: login.php');
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //code by SIBRAN
    if(isset($_POST['new_flight'])){
        $flight_id      =  mysqli_real_escape_string($connection,$_POST['f_id']);
        $flight_name    =  mysqli_real_escape_string($connection,$_POST['f_name']);
        $economy_seats  =  mysqli_real_escape_string($connection,$_POST['e_seats']);
        $business_seats =  mysqli_real_escape_string($connection,$_POST['b_seats']);

        $query_1 = "INSERT INTO `flight` (`flight_id`, `flight_name`, `e_seats`, `b_seats`) VALUES ('$flight_id', '$flight_name', '$economy_seats', '$business_seats')";
        $result_1 = mysqli_query($connection, $query_1);

        if ($result_1) {
            $response = array('success' => true, 'message' => 'The flight was added successfully.');
        } else {
            $response = array('success' => false, 'message' => 'There was error in adding flight: ');
        }
       
        echo json_encode($response);
        exit;
    }

    if(isset($_POST['delete_flight'])){

        $flight_id      =  mysqli_real_escape_string($connection,$_POST['delete_flight']);

        $query_2 = "DELETE FROM `flight` WHERE `flight`.`flight_id` = $flight_id";
        $result_2 = mysqli_query($connection, $query_2);

        if ($result_2) {
            $response = array('success' => true, 'message' => 'The flight was delete successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in deleting flight');
        }

        echo json_encode($response);
        exit;

    }

    if(isset($_POST['update_flight'])){

        $flight_id      =  mysqli_real_escape_string($connection,$_POST['f_id']);
        $flight_name    =  mysqli_real_escape_string($connection,$_POST['f_name']);
        $economy_seats  =  mysqli_real_escape_string($connection,$_POST['e_seats']);
        $business_seats =  mysqli_real_escape_string($connection,$_POST['b_seats']);

        $query_3 = "UPDATE `flight` SET  `flight_name` = '$flight_name', `e_seats` = '$economy_seats', `b_seats` = '$business_seats' WHERE `flight`.`flight_id` = $flight_id";
        $result_3 = mysqli_query($connection, $query_3);

        if ($result_3) {
            $response = array('success' => true, 'message' => 'The flight was update successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in updating flight');
        }

        echo json_encode($response);
        exit;

    }

    //code by Lathujan
    if(isset($_POST['new_airport'])){
        $airport_id      =  mysqli_real_escape_string($connection,$_POST['a_id']);
        $airport_name    =  mysqli_real_escape_string($connection,$_POST['a_name']);
        $airport_country  =  mysqli_real_escape_string($connection,$_POST['a_country']);
        $airport_city =  mysqli_real_escape_string($connection,$_POST['a_city']);

        $query_1 = "INSERT INTO `airport` (`airport_id`, `airport_name`, `airport_country`, `airport_city`) VALUES ('$airport_id', '$airport_name', '$airport_country', '$airport_city');";
        $result_1 = mysqli_query($connection, $query_1);

        if ($result_1) {
            $response = array('success' => true, 'message' => 'The airport was added successfully.');
        } else {
            $response = array('success' => false, 'message' => 'There was error in adding airport');
        }
       
        echo json_encode($response);
        exit;
    }

    if(isset($_POST['delete_airport'])){

        $airport_id      =  mysqli_real_escape_string($connection,$_POST['delete_airport']);

        $query_2 = "DELETE FROM `airport` WHERE `airport`.`airport_id` = $airport_id";
        $result_2 = mysqli_query($connection, $query_2);

        if ($result_2) {
            $response = array('success' => true, 'message' => 'The airport was delete successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in deleting airport.');
        }

        echo json_encode($response);
        exit;

    }

    if(isset($_POST['update_airport'])){

        $airport_id      =  mysqli_real_escape_string($connection,$_POST['a_id']);
        $airport_name    =  mysqli_real_escape_string($connection,$_POST['a_name']);
        $airport_country  =  mysqli_real_escape_string($connection,$_POST['a_country']);
        $airport_city =  mysqli_real_escape_string($connection,$_POST['a_city']);

        $query_3 = "UPDATE `airport` SET `airport_name` = '$airport_name', `airport_country` = '$airport_country', `airport_city` = '$airport_city' WHERE `airport`.`airport_id` = $airport_id";
        $result_3 = mysqli_query($connection, $query_3);

        if ($result_3) {
            $response = array('success' => true, 'message' => 'The airport was update successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in updating airport');
        }

        echo json_encode($response);
        exit;

    }

    //code by bosilu
    if(isset($_POST['new_schedule'])){

        $flight_name  =  mysqli_real_escape_string($connection,$_POST['flight_name']);
        $gate_number  =  mysqli_real_escape_string($connection,$_POST['gate_number']);
        $departure_airport  =  mysqli_real_escape_string($connection,$_POST['departure_airport']);
        $arrival_airport  =  mysqli_real_escape_string($connection,$_POST['arrival_airport']);
        $departure_date  =  mysqli_real_escape_string($connection,$_POST['departure_date']);
        $departure_time  =  mysqli_real_escape_string($connection,$_POST['departure_time']);
        $ec_price  =  mysqli_real_escape_string($connection,$_POST['ec_price']);
        $bc_price  =  mysqli_real_escape_string($connection,$_POST['bc_price']);

        $query_1 = "INSERT INTO `schedule` (`s_id`, `f_id`, `departure_airport_id`, `arrival_airport_id`, `departure_date`, `departure_time`, `e_class_price`, `b_class_price`, `g_id`) VALUES (NULL, '$flight_name', '$departure_airport', '$arrival_airport', '$departure_date', '$departure_time', '$ec_price', '$bc_price', '$gate_number')";
        $result_1 = mysqli_query($connection, $query_1);

        if ($result_1) {
            $response = array('success' => true, 'message' => 'The schedule was added successfully.');
        } else {
            $response = array('success' => false, 'message' => 'There was error in adding schedule.');
        }
       
        echo json_encode($response);
        exit;
    }

    if(isset($_POST['delete_schedule'])){

        $schedule_id      =  mysqli_real_escape_string($connection,$_POST['delete_schedule']);

        $query_2 = "DELETE FROM `schedule` WHERE `schedule`.`s_id` = $schedule_id";
        $result_2 = mysqli_query($connection, $query_2);

        if ($result_2) {
            $response = array('success' => true, 'message' => 'The schedule was delete successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in deleting schedule.');
        }

        echo json_encode($response);
        exit;

    }

    if(isset($_POST['new_schedule'])){

        $flight_name  =  mysqli_real_escape_string($connection,$_POST['flight_name']);
        $gate_number  =  mysqli_real_escape_string($connection,$_POST['gate_number']);
        $departure_airport  =  mysqli_real_escape_string($connection,$_POST['departure_airport']);
        $arrival_airport  =  mysqli_real_escape_string($connection,$_POST['arrival_airport']);
        $departure_date  =  mysqli_real_escape_string($connection,$_POST['departure_date']);
        $departure_time  =  mysqli_real_escape_string($connection,$_POST['departure_time']);
        $ec_price  =  mysqli_real_escape_string($connection,$_POST['ec_price']);
        $bc_price  =  mysqli_real_escape_string($connection,$_POST['bc_price']);

        $query_1 = "INSERT INTO `schedule` (`s_id`, `f_id`, `departure_airport_id`, `arrival_airport_id`, `departure_date`, `departure_time`, `e_class_price`, `b_class_price`, `g_id`) VALUES (NULL, '$flight_name', '$departure_airport', '$arrival_airport', '$departure_date', '$departure_time', '$ec_price', '$bc_price', '$gate_number')";
        $result_1 = mysqli_query($connection, $query_1);

        if ($result_1) {
            $response = array('success' => true, 'message' => 'The schedule was added successfully.');
        } else {
            $response = array('success' => false, 'message' => 'There was error in adding schedule.');
        }
       
        echo json_encode($response);
        exit;
    }

    
}

?>