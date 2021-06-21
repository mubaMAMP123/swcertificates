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

// generate organiser id
$SELECT_ORGANISER_ID = "SELECT id FROM organisers ORDER BY id DESC LIMIT 1";
$stmt = $conn->query($SELECT_ORGANISER_ID);
if (mysqli_num_rows($stmt) > 0) :
    if ($row = mysqli_fetch_assoc($stmt)) :
        $value = $row['id'];
        $value = substr($value, 2, 5);
        $value++;
        $value = "CC" . sprintf('%03s', $value);
    endif;
else :
    $value = "CC100";
endif;
$stmt->free();

if (isset($_POST['add_organiser'])) :
    $organiser_id = $value;
    $organiser_name = mysqli_real_escape_string($conn, $_POST['organiser_name']);

    // insert into organiser table
    $INSERT_ORGANISER = "INSERT INTO organisers (id, organiser_name) VALUES ('" . $organiser_id . "','" . $organiser_name . "')";
    $result_insert = $conn->query($INSERT_ORGANISER);

    // close db connection
    $conn->close();

    if ($result_insert === TRUE) :
        header('Location: organisers?status=1');
        exit;
    else :
        header('Location: organisers?status=2');
        exit;
    endif;
endif;
