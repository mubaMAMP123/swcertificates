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

// get user id
$userid = mysqli_real_escape_string($conn, test_input($_GET['uid']));

// delete user from 'accounts' table
$DELETE_USER = "DELETE FROM accounts WHERE id = '" . $userid . "'";
$result_delete = $conn->query($DELETE_USER);

//close db connection
$conn->close();

if ($result_delete === TRUE) :
    header('Location: users?status=3');
    exit;
else :
    header('Location: users?status=4');
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
