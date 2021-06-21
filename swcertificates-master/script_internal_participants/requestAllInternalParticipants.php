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

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$requested_by = $_SESSION['user'];
$requested_at = date("d-m-Y") . " at " . date("h:i:s A");

// update request status
$UPDATE = "UPDATE " . $event_id . " SET request_status=1, requested_by='" . $requested_by . "', requested_at='" . $requested_at . "' WHERE entry_position = 0 AND entry_college = 'VIT' AND request_status=0";
$result_update = $conn->query($UPDATE);

if ($result_update === TRUE) {
    $qstring = '?eid=' . $event_id . '&status=41';
} else {
    $qstring = '?eid=' . $event_id . '&status=42';
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
