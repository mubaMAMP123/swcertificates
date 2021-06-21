<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") :
    header("location: ../index");
    exit;
endif;

// Include db config file
require_once '../dbConfig.php';

// get event id
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

// script on submitting import participants form
if (isset($_POST['external_participants_import'])) :

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['csvfile']['name']) && in_array($_FILES['csvfile']['type'], $csvMimes)) :
        // If the file is uploaded
        if (is_uploaded_file($_FILES['csvfile']['tmp_name'])) :
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['csvfile']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // initialize error variables
            $emptyCell = 0;
            $mailError = 0;

            // validate the data in the uploaded file
            while (($line = fgetcsv($csvFile)) !== FALSE) :
                $entry_name = strtoupper(test_input($line[0]));
                $entry_college = strtoupper(test_input($line[1]));
                $entry_mail = strtolower(test_input($line[2]));

                // check for empty cells
                if ($entry_name == "" || $entry_college == "" || $entry_mail == "") :
                    $emptyCell = 1;
                    break;
                endif;
                // check for error in Email ID
                if (!filter_var($entry_mail, FILTER_VALIDATE_EMAIL)) :
                    $mailError = 1;
                endif;
            endwhile;
            // close csv file
            fclose($csvFile);
            // open csv file
            $csvFile = fopen($_FILES['csvfile']['tmp_name'], 'r');
            // skip the first line
            fgetcsv($csvFile);

            if ($emptyCell == 0 && $mailError == 0) :
                while (($line = fgetcsv($csvFile)) !== FALSE) :
                    $entry_name = strtoupper(test_input($line[0]));
                    $entry_college = strtoupper(test_input($line[1]));
                    $entry_mail = strtolower(test_input($line[2]));

                    // check for duplicate entry
                    $prevQuery = "SELECT * FROM " . $event_id . " WHERE entry_email = '" . $entry_mail . "'";
                    $prevResult = $conn->query($prevQuery);

                    if ($prevResult->num_rows > 0) :
                        $UPDATE_EXTERNAL_PARTICIPANT = "UPDATE " . $event_id . " SET entry_name = '" . $entry_name . "', entry_college = '" . $entry_college . "' WHERE entry_email = '" . $entry_mail . "' AND request_status=0";
                        $result_update = $conn->query($UPDATE_EXTERNAL_PARTICIPANT);
                    else :
                        $INSERT_EXTERNAL_PARTICIPANT = "INSERT INTO " . $event_id . " (entry_name, entry_email, entry_college) VALUES ('" . $entry_name . "', '" . $entry_mail . "', '" . $entry_college . "')";
                        $result_insert = $conn->query($INSERT_EXTERNAL_PARTICIPANT);
                    endif;
                endwhile;
                $qstring = '?eid=' . $event_id . '&status=55';
            else :
                $qstring = '?eid=' . $event_id . '&status=56';
            endif;
            // close csv file
            fclose($csvFile);
        else :
            $qstring = '?eid=' . $event_id . '&status=53';
        endif;
    else :
        $qstring = '?eid=' . $event_id . '&status=54';
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

//close db connection
$conn->close();
// redirect to event page with status
header("Location: ../event" . $qstring);
exit;
