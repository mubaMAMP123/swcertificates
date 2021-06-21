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

// script on submitting add participant form
if (isset($_POST['internal_participant_submit'])) {
    $internal_participant_regno = strtoupper(test_input($_POST['internal_participant_regno']));
    $internal_participant_name = strtoupper(test_input($_POST['internal_participant_name']));
    $internal_participant_email = strtolower(test_input($_POST['internal_participant_email'])) . "@vitstudent.ac.in";

    //insert internal participant details into the event table
    $INSERT_INTERNAL_PARTICIPANT = "INSERT INTO " . $event_id . " (entry_regno, entry_name, entry_email) VALUES 
            ('" . $internal_participant_regno . "', '" . $internal_participant_name . "', '" . $internal_participant_email . "')";
    $result_insert = $conn->query($INSERT_INTERNAL_PARTICIPANT);

    if ($result_insert === TRUE) {
        $qstring = '?eid=' . $event_id . '&status=45';
    } else {
        $qstring = '?eid=' . $event_id . '&status=46';
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
