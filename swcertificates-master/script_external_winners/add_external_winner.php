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
if (isset($_POST['external_winner_submit'])) {
    $external_winner_name = strtoupper(test_input($_POST['external_winner_name']));
    $external_winner_college = strtoupper(test_input($_POST['external_winner_college']));
    $external_winner_email = strtolower(test_input($_POST['external_winner_email']));
    $external_winner_position = test_input($_POST['external_winner_position']);

    //insert external winner details into the event table
    $INSERT_EXTERNAL_WINNER = "INSERT INTO " . $event_id . " (entry_name, entry_email, entry_position, entry_college) VALUES 
            ('" . $external_winner_name . "', '" . $external_winner_email . "', '" . $external_winner_position . "', '" . $external_winner_college . "')";
    $result_insert = $conn->query($INSERT_EXTERNAL_WINNER);

    if ($result_insert === TRUE) {
        $qstring = '?eid=' . $event_id . '&status=21';
    } else {
        $qstring = '?eid=' . $event_id . '&status=22';
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
