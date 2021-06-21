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

// select the organiser from 'organisers' table
$SELECT_ORGANISER = "SELECT organiser_name FROM organisers WHERE id = '" . $organiser_id . "'";
$stmt = $conn->query($SELECT_ORGANISER);
$row = $stmt->fetch_assoc();
$organiser_name_original = mysqli_real_escape_string($conn, $row['organiser_name']);
$stmt->free();

if (isset($_POST['edit_organiser'])) :
    $organiser_name = mysqli_real_escape_string($conn, test_input($_POST['organiser_name']));

    if ($organiser_name == $organiser_name_original) :
        //close db connection
        $conn->close();
        header('Location: organisers?status=7');
        exit;
    endif;

    // updata organiser in 'organisers' table
    $UPDATE_ORGANISER = "UPDATE organisers SET organiser_name = '" . $organiser_name . "' WHERE id = '" . $organiser_id . "'";
    $result_update = $conn->query($UPDATE_ORGANISER);

    //close db connection
    $conn->close();

    if ($result_update === TRUE) :
        header('Location: organisers?status=5');
        exit;
    else :
        header('Location: organisers?status=6');
        exit;
    endif;
endif;

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
