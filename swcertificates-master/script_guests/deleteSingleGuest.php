<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index");
    exit;
}

// Include db config file
require_once '../dbConfig.php';

// get guest id, event id and user account type
$guest_id = mysqli_real_escape_string($conn, test_input($_GET['gid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// delete the guest from guests table
$DELETE = "DELETE FROM guests WHERE guest_id = '" . $guest_id . "'";
$result_delete = $conn->query($DELETE);

// check certificate is there in the folder
$certificate_exists = file_exists("../certificates/$event_id/guests/$guest_id.jpg");
$result_unlink = true;
if ($certificate_exists === TRUE) :
    // delete the generated internal winner certificate
    $result_unlink = unlink("../certificates/$event_id/guests/$guest_id.jpg");
endif;

if ($result_delete === TRUE && $result_unlink === TRUE) {
    $qstring = '?eid=' . $event_id . '&status=500';
} else {
    $qstring = '?eid=' . $event_id . '&status=501';
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
