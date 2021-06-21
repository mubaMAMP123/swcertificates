<?php
// Initialize the session
session_start();

// Include db config file
require_once 'dbConfig.php';

// get user id, user account type and page link
$user_id = mysqli_real_escape_string($conn, test_input($_GET['uid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['at']));
$page_href = mysqli_real_escape_string($conn, test_input($_GET['ph']));

//set timezone
date_default_timezone_set("Asia/Calcutta");

$password_changed_at = date("d-m-Y") . " at " . date("h:i:s A");

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $user_id != $_SESSION['id'] || $account_type != $_SESSION['account_type']) :
    header("location: index");
    exit;
endif;

if (isset($_POST['password_submit'])) :
    $password = md5(test_input($_POST['new_password']));
    $UPDATE_PASSWORD = "UPDATE accounts SET password = '" . $password . "', password_changed_at = '" . $password_changed_at . "' WHERE id = '" . $user_id . "'";
    $result_update = $conn->query($UPDATE_PASSWORD);

    if ($result_update === TRUE) :
        $qstring1 = "?status=540";
        $qstring2 = "&status=540";
    else :
        $qstring1 = "?status=541";
        $qstring2 = "&status=541";
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
// close db connection
$conn->close();

// redirect to corresponding page with status
if ($page_href == "allEvents") {
    header("Location: " . $page_href . $qstring1);
    exit;
} elseif ($page_href == "addEvent") {
    header("Location: " . $page_href . $qstring1);
    exit;
} elseif ($page_href == "home") {
    header("Location: " . $page_href . $qstring1);
    exit;
} elseif ($page_href == "users") {
    header("Location: " . $page_href . $qstring1);
    exit;
} elseif ($page_href == "organisers") {
    header("Location: " . $page_href . $qstring1);
    exit;
} else {
    header("Location: " . $page_href . $qstring2);
    exit;
}
