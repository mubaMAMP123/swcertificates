<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "super") :
    header("location: index");
    exit;
endif;

// Include db config file
require_once 'dbConfig.php';

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$created_by = $_SESSION['user'];
$created_at = date("d-m-Y") . " at " . date("h:i:s A");

// generate organiser id
$SELECT_USER_ID = "SELECT id FROM accounts ORDER BY id DESC LIMIT 1";
$stmt = $conn->query($SELECT_USER_ID);
if (mysqli_num_rows($stmt) > 0) :
    if ($row = mysqli_fetch_assoc($stmt)) :
        $value = $row['id'];
        $value = substr($value, 2, 4);
        $value++;
        $value = "US" . sprintf('%02s', $value);
    endif;
else :
    $value = "US10";
endif;
$stmt->free();

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['add_user'])) :
    $id = $value;
    $username = mysqli_real_escape_string($conn, test_input($_POST['user_name']));
    $password = md5(mysqli_real_escape_string($conn, test_input($_POST['new_user_password'])));
    $account_type = mysqli_real_escape_string($conn, test_input($_POST['user_account_type']));

    // insert into accounts table
    $INSERT_USER = "INSERT INTO accounts (id, username, password, account_type, created_by, created_at) VALUES ('" . $id . "','" . $username . "','" . $password . "','" . $account_type . "','" . $created_by . "','" . $created_at . "')";
    $result_insert = $conn->query($INSERT_USER);

    // close db connection
    $conn->close();

    if ($result_insert === TRUE) :
        header('Location: users?status=1');
        exit;
    else :
        header('Location: users?status=2');
        exit;
    endif;
endif;
