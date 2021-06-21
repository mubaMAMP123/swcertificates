<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") :
    header("location: ../index");
    exit;
endif;

// Include db config file
require_once '../dbConfig.php';

// get event id
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

// script on submitting add participant form
if (isset($_POST['external_participant_submit'])) :
    $external_participant_name = strtoupper(test_input($_POST['external_participant_name']));
    $external_participant_college = strtoupper(test_input($_POST['external_participant_college']));
    $external_participant_email = strtolower(test_input($_POST['external_participant_email']));

    //insert external participant details into the event table
    $INSERT_EXTERNAL_PARTICIPANT = "INSERT INTO " . $event_id . " (entry_name, entry_email, entry_college) VALUES 
            ('" . $external_participant_name . "', '" . $external_participant_email . "', '" . $external_participant_college . "')";
    $result_insert = $conn->query($INSERT_EXTERNAL_PARTICIPANT);

    if ($result_insert === TRUE) :
        $qstring = '?eid=' . $event_id . '&status=31';
    else :
        $qstring = '?eid=' . $event_id . '&status=32';
    endif;
endif;

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
