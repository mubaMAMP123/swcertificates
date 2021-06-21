<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) :
    header("location: ../index");
    exit;
endif;

// Include db config file
require_once '../dbConfig.php';

// get external participant id, event id and user account type
$external_participant_id = mysqli_real_escape_string($conn, test_input($_GET['epid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// get external participant certificate number
$SELECT = "SELECT certificate_number FROM " . $event_id . " WHERE entry_id='" . $external_participant_id . "'";
$stmt = $conn->query($SELECT);
$row = $stmt->fetch_assoc();
$certificate_number = $row['certificate_number'];
$stmt->free();

// delete the external participant from the events table
$DELETE = "DELETE FROM " . $event_id . "  WHERE entry_id='" . $external_participant_id . "'";
$result_delete = $conn->query($DELETE);

// check certificate is there in the folder
$certificate_exists = file_exists("../certificates/$event_id/external_participants/$certificate_number.jpg");
$result_unlink = true;
if ($certificate_exists === TRUE) :
    // delete the generated external participant certificate
    $result_unlink = unlink("../certificates/$event_id/external_participants/$certificate_number.jpg");
endif;

if ($result_delete === TRUE && $result_unlink === TRUE) {
    $qstring = '?eid=' . $event_id . '&status=526';
} else {
    $qstring = '?eid=' . $event_id . '&status=527';
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
