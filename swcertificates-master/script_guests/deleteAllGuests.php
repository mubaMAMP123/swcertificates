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

// get event id and user account type
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// delete all event guests from guests table
$DELETE = "DELETE FROM guests WHERE event_id = '" . $event_id . "'";
$result_delete = $conn->query($DELETE);

// delete all generated certificates
$folder_path = "../certificates/$event_id/guests";
$files = glob($folder_path . '/*');
$result_unlink = TRUE;
foreach ($files as $file) :
    if (is_file($file)) :
        $status = unlink($file);
    endif;
    if ($status == FALSE) :
        $result_unlink = FALSE;
    endif;
endforeach;

if ($result_delete === TRUE && $result_unlink === TRUE) {
    $qstring = '?eid=' . $event_id . '&status=502';
} else {
    $qstring = '?eid=' . $event_id . '&status=503';
}

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// close db connection
$conn->close();
// redirect to corresponding page with status
if ($account_type == "u") :
    header("Location: ../event" . $qstring);
    exit;
else :
    header("Location: ../checkEvent" . $qstring);
    exit;
endif;
