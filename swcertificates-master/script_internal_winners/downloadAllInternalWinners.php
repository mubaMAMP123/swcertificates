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

// get event id
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

// select event details from events table
$SELECT = "SELECT * FROM events WHERE event_id='" . $event_id . "'";
$stmt = $conn->query($SELECT);
$row = $stmt->fetch_assoc();
$event_name = $row['event_name'];
$stmt->free();

// select the internal winners folder to be downloaded
$pathdir = "../certificates/$event_id/internal_winners/";

// name the zip folder
$zipcreated = "$event_name Internal Winners' Certificates.zip";
// zip all files
$zip = new ZipArchive;
if ($zip->open($zipcreated, ZipArchive::CREATE) === TRUE) {
    $dir = opendir($pathdir);
    while ($file = readdir($dir)) {
        if (is_file($pathdir . $file)) {
            $zip->addFile($pathdir . $file, $file);
        }
    }
    $zip->close();
}
if (file_exists($zipcreated)) {
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipcreated) . '"');
    header('Content-Length: ' . filesize($zipcreated));
    flush();
    readfile($zipcreated);
    unlink($zipcreated);
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
