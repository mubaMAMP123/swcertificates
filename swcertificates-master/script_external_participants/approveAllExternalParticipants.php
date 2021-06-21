<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "super") :
    header("location: ../index");
    exit;
endif;

// Include db config file
require_once '../dbConfig.php';

// get event id and approval status
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$status = mysqli_real_escape_string($conn, test_input($_GET['s']));

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$approved_by = $_SESSION['user'];
$approved_at = date("d-m-Y") . " at " . date("h:i:s A");

// update approval status of external participants
$UPDATE = "UPDATE " . $event_id . " SET approval_status='" . $status . "', approved_by='" . $approved_by . "', approved_at='" . $approved_at . "' WHERE entry_position = 0 AND entry_college != 'VIT' AND request_status=1 AND approval_status=0";
$result_update = $conn->query($UPDATE);

if ($result_update === TRUE) {
    if ($status == 1) {
        $qstring = '?eid=' . $event_id . '&status=19';
    } elseif ($status == 2) {
        $qstring = '?eid=' . $event_id . '&status=21';
    }
} else {
    $qstring = '?eid=' . $event_id . '&status=20';
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
header("Location: ../checkEvent" . $qstring);
exit;
