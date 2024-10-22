<?php

require_once('inc/config.inc.php'); 

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])){ 
    header('Location: login.php');
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['delete_ticket'])){

        $ticket_id      =  mysqli_real_escape_string($connection,$_POST['delete_ticket']);
        $ticket_price   =  mysqli_real_escape_string($connection,$_POST['ticket_price']);

        // Convert the ticket price to a numeric value (assuming it's a string)
        $ticket_price_numeric = floatval($ticket_price);

        // Get the negative value of the ticket price
        $negative_ticket_price = -$ticket_price_numeric;

        $user_id = $_SESSION['user_id'];

        $query_2 = "DELETE FROM `ticket` WHERE `ticket`.`ticket_id` = $ticket_id";
        $result_2 = mysqli_query($connection, $query_2);

        if ($result_2) {

            $query_3 = "INSERT INTO `transaction` (`tr_id`, `tr_name`, `tr_note`, `tr_amount`, `tr_date`, `tr_status`) VALUES (NULL, 'flight ticket cancel', 'flight ticket cancel', '$negative_ticket_price', CURDATE(), '1')";
            $result_3 = mysqli_query($connection, $query_3);

            if($result_3){
                $query_4 = "INSERT INTO `user_transaction` (`user_id`, `transaction_id`) VALUES ('$user_id', (SELECT MAX(tr_id) FROM `transaction`))";
                $result_4 = mysqli_query($connection, $query_4);

                if($result_4) {

                }
            }

            $response = array('success' => true, 'message' => 'The ticket was delete successfully.');
        }else{
            $response = array('success' => false, 'message' => 'There was error in deleting ticket');
        }

        echo json_encode($response);
        exit;

    }  
}

?>