<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) :
    header("location: index");
    exit;
endif;

// Include db config file
require_once 'dbConfig.php';

// get event id & user account type
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// drop the event table
$DROP_TABLE = "DROP TABLE IF EXISTS `" . $event_id . "`";
$result_drop = $conn->query($DROP_TABLE);

// delete event from 'events' table
$DELETE_EVENT = "DELETE FROM events WHERE event_id = '" . $event_id . "'";
$result_delete_event = $conn->query($DELETE_EVENT);

// delete guests from 'guests' table
$DELETE_GUESTS = "DELETE FROM guests WHERE event_id = '" . $event_id . "'";
$result_delete_guests = $conn->query($DELETE_GUESTS);

// delete all folders & certificates generated
delete_dir("certificates/$event_id");
$result_delete_dir = !(is_dir("certificates/$event_id"));

if ($result_drop === TRUE && $result_delete_event === TRUE && $result_delete_guests === TRUE && $result_delete_dir === TRUE) :
    $qstring = '?status=1';
else :
    $qstring = '?status=2';
endif;

// function to delete directory with all files in it
function delete_dir($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK);

        foreach ($files as $file) :
            delete_dir($file);
        endforeach;

        rmdir($target);
    } elseif (is_file($target)) {
        unlink($target);
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

// redirect to corresponding page with status
if ($account_type == "u") :
    header("Location: allEvents" . $qstring);
    exit;
else :
    header("Location: home" . $qstring);
    exit;
endif;
