<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "super") :
    header("location: index");
    exit;
endif;

// Include db config file
require_once 'dbConfig.php';

// get organiser id
$organiser_id = mysqli_real_escape_string($conn, test_input($_GET['oid']));

// delete organiser from 'organisers' table
$DELETE_ORGANISER = "DELETE FROM organisers WHERE id = '" . $organiser_id . "'";
$result_delete = $conn->query($DELETE_ORGANISER);

//close db connection
$conn->close();

if ($result_delete === TRUE) :
    header('Location: organisers?status=3');
    exit;
else :
    header('Location: organisers?status=4');
    exit;
endif;

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
