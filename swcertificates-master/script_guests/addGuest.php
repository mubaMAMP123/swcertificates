<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") {
    header("location: ../index");
    exit;
}

// Include db config file
require_once '../dbConfig.php';

// get event id
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

// generate guest id
$SELECT_GUEST_ID = "SELECT guest_id FROM guests ORDER BY guest_id DESC LIMIT 1";
$stmt = $conn->query($SELECT_GUEST_ID);
if (mysqli_num_rows($stmt) > 0) {
    if ($row = mysqli_fetch_assoc($stmt)) {
        $value = $row['guest_id'];
        $value = substr($value, 2, 6);
        $value++;
        $value = "GS" . sprintf('%04s', $value);
    }
} else {
    $value = "GS1000";
}
$stmt->free();

// script on submitting add guest form
if (isset($_POST['guest_submit'])) {
    $guest_id = $value;
    $guest_name = strtoupper(test_input($_POST['guest_name']));
    $guest_email = strtolower(test_input($_POST['guest_email']));

    //insert guest details into 'guests' table
    $INSERT_GUEST = "INSERT INTO guests (event_id, guest_id, guest_name, guest_email) VALUES 
            ('" . $event_id . "', '" . $guest_id . "', '" . $guest_name . "', '" . $guest_email . "')";
    $result_insert = $conn->query($INSERT_GUEST);

    if ($result_insert === TRUE) {
        $qstring = '?eid=' . $event_id . '&status=1';
    } else {
        $qstring = '?eid=' . $event_id . '&status=2';
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
