<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") {
    header("location: ../index");
    exit;
}

// Include db config file
require_once '../dbConfig.php';

// get event id
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

// script on submitting add winner form
if (isset($_POST['internal_winner_submit'])) {
    $internal_winner_regno = strtoupper(test_input($_POST['internal_winner_regno']));
    $internal_winner_name = strtoupper(test_input($_POST['internal_winner_name']));
    $internal_winner_email = strtolower(test_input($_POST['internal_winner_email'])) . "@vitstudent.ac.in";
    $internal_winner_position = test_input($_POST['internal_winner_position']);

    //insert internal winner details into the event table
    $INSERT_INTERNAL_WINNER = "INSERT INTO " . $event_id . " (entry_regno, entry_name, entry_email, entry_position) VALUES 
            ('" . $internal_winner_regno . "', '" . $internal_winner_name . "', '" . $internal_winner_email . "', '" . $internal_winner_position . "')";
    $result_insert = $conn->query($INSERT_INTERNAL_WINNER);

    if ($result_insert === TRUE) {
        $qstring = '?eid=' . $event_id . '&status=9';
    } else {
        $qstring = '?eid=' . $event_id . '&status=10';
    }
}

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//close db connection
$conn->close();
// redirect to event page with status
header("Location: ../event" . $qstring);
exit;
