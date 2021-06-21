<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index");
    exit;
}

// Include db config file
require_once '../dbConfig.php';

// get internal winner id, event id and user account type
$internal_winner_id = mysqli_real_escape_string($conn, test_input($_GET['iwid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// get internal winner registration number
$SELECT = "SELECT entry_regno FROM " . $event_id . " WHERE entry_id='" . $internal_winner_id . "'";
$stmt = $conn->query($SELECT);
$row = $stmt->fetch_assoc();
$internal_winner_regno = $row['entry_regno'];
$stmt->free();

// delete the internal winner from the events table
$DELETE = "DELETE FROM " . $event_id . "  WHERE entry_id='" . $internal_winner_id . "'";
$result_delete = $conn->query($DELETE);

// check certificate is there in the folder
$certificate_exists = file_exists("../certificates/$event_id/internal_winners/$internal_winner_regno.jpg");
$result_unlink = true;
if ($certificate_exists === TRUE) :
    // delete the generated internal winner certificate
    $result_unlink = unlink("../certificates/$event_id/internal_winners/$internal_winner_regno.jpg");
endif;

if ($result_delete === TRUE && $result_unlink === TRUE) {
    $qstring = '?eid=' . $event_id . '&status=510';
} else {
    $qstring = '?eid=' . $event_id . '&status=511';
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
// redirect to corresponding page with status
if ($account_type == "u") :
    header("Location: ../event" . $qstring);
    exit;
else :
    header("Location: ../checkEvent" . $qstring);
    exit;
endif;
