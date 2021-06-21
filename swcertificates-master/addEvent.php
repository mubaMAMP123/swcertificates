<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") :
    header("location: index");
    exit;
endif;

// Include db config file
require_once 'dbConfig.php';

// Initialize variables
$page_title = "Add Event | SW VIT";
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-warning";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "addEvent";

// set timezone
date_default_timezone_set("Asia/Calcutta");

// Include header file
include 'header.php';

// generate event id
$SELECT_EVENT_ID = "SELECT event_id FROM events ORDER BY event_id DESC LIMIT 1";
$stmt = $conn->query($SELECT_EVENT_ID);
if (mysqli_num_rows($stmt) > 0) :
    if ($row = mysqli_fetch_assoc($stmt)) :
        $value = $row['event_id'];
        $value = substr($value, 2, 7);
        $value++;
        $value = "EV" . sprintf('%05s', $value);
    endif;
else :
    $value = "EV10000";
endif;
$stmt->free();

// Select all organisers from 'organisers'table
$SELECT_ORGANISERS = "SELECT organiser_name FROM organisers ORDER BY organiser_name ASC";
$stmt = $conn->query($SELECT_ORGANISERS);
$data_organisers = [];
if ($stmt->num_rows > 0) :
    while ($row = $stmt->fetch_assoc()) :
        $data_organisers[] = $row;
    endwhile;
endif;
$stmt->free();

// script on add event button click
if (isset($_POST["add_event"])) :
    $event_id = $value;
    $event_name = ucwords(mysqli_real_escape_string($conn, test_input($_POST['event_name'])));
    $event_organiser = strtoupper(mysqli_real_escape_string($conn, test_input($_POST['event_organiser'])));
    $event_date = test_input($_POST['event_date']);
    $guest = isset($_POST['guest']) ? test_input($_POST['guest']) : 0;
    $internal_participant = isset($_POST['internal_participant']) ? test_input($_POST['internal_participant']) : 0;
    $internal_winner = isset($_POST['internal_winner']) ? test_input($_POST['internal_winner']) : 0;
    $external_participant = isset($_POST['external_participant']) ? test_input($_POST['external_participant']) : 0;
    $external_winner = isset($_POST['external_winner']) ? test_input($_POST['external_winner']) : 0;
    $created_by = $_SESSION["user"];

    //insert event details into 'events' table
    $INSERT_EVENT = "INSERT INTO events (event_id, event_name, event_organiser, event_date, guest, internal_participant, internal_winner, external_participant, external_winner, created_by) 
            VALUES 
            ('" . $event_id . "', '" . $event_name . "', '" . $event_organiser . "', '" . $event_date . "', '" . $guest . "', '" . $internal_participant . "', '" . $internal_winner . "', '" . $external_participant . "', '" . $external_winner . "', '" . $created_by . "')";
    $result_insert = $conn->query($INSERT_EVENT);

    //create table for event
    $CREATE = "CREATE TABLE " . $event_id . " (
        event_id CHAR(7) NOT NULL DEFAULT '" . $event_id . "',
        entry_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
        entry_regno CHAR(9) NOT NULL DEFAULT '0',
        entry_name VARCHAR(100) NOT NULL,
        entry_email VARCHAR(100) NOT NULL,
        entry_position INT NOT NULL DEFAULT '0',
        entry_college VARCHAR(100) NOT NULL DEFAULT 'VIT',
        certificate_number CHAR(8) NOT NULL,
        request_status BOOLEAN NOT NULL DEFAULT '0',
        requested_by VARCHAR(15) NOT NULL,
        requested_at VARCHAR(30) NOT NULL,
        approval_status BOOLEAN NOT NULL DEFAULT '0',
        approved_by VARCHAR(15) NOT NULL,
        approved_at VARCHAR(30) NOT NULL,
        generate_status BOOLEAN NOT NULL DEFAULT '0',
        generated_by VARCHAR(15) NOT NULL,
        generated_at VARCHAR(30) NOT NULL,
        mail_status BOOLEAN NOT NULL DEFAULT '0',
        mailed_by VARCHAR(15) NOT NULL,
        mailed_at VARCHAR(30) NOT NULL,
        verification_link VARCHAR(100) NOT NULL DEFAULT '')";

    $result_create = $conn->query($CREATE);

    if ($result_insert === TRUE && $result_create === TRUE) {
        // make folders for certificates
        if ($guest) {
            $guest_folder = mkdir("certificates/$event_id/guests", 0777, true);
        }
        if ($internal_participant) {
            $internal_participant_folder = mkdir("certificates/$event_id/internal_participants", 0777, true);
        }
        if ($internal_winner) {
            $internal_winner_folder = mkdir("certificates/$event_id/internal_winners", 0777, true);
        }
        if ($external_participant) {
            $external_participant_folder = mkdir("certificates/$event_id/external_participants", 0777, true);
        }
        if ($external_winner) {
            $external_winner_folder = mkdir("certificates/$event_id/external_winners", 0777, true);
        }
        if (($guest == 1 && $guest_folder !== TRUE) ||
            ($internal_participant == 1 && $internal_participant_folder !== TRUE) ||
            ($internal_winner == 1 && $internal_winner_folder !== TRUE) ||
            ($external_participant == 1 && $external_participant_folder !== TRUE) ||
            ($external_winner == 1 && $external_winner_folder !== TRUE)
        ) {
            delete_dir("certificates/$event_id");
            $DROP = "DROP TABLE IF EXISTS `" . $event_id . "`";
            $conn->query($DROP);
            $DELETE = "DELETE FROM events WHERE event_id = '" . $event_id . "'";
            $conn->query($DELETE);
            $error_check = 2; //error in adding event
        } else {
            $error_check = 1; //event added successfully
        }
    } else {
        if ($result_insert !== TRUE) {
            $DROP = "DROP TABLE IF EXISTS `" . $event_id . "`";
            $conn->query($DROP);
        } elseif ($result_create !== TRUE) {
            $DELETE = "DELETE FROM events WHERE event_id = '" . $event_id . "'";
            $conn->query($DELETE);
        }
        $error_check = 2; //error in adding event
    }

    $status = $error_check;
endif;
// funtion to delete directory with all files in it
function delete_dir($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK);

        foreach ($files as $file) {
            delete_dir($file);
        }

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
?>
<!-- loading loader -->
<div class="loader" id="loading-loader">
    <div class="content">
        <img src="./assets/infinity.gif" alt="Loading...">
        <img src="./assets/loading.svg" alt="Loading...">
    </div>
</div>
<div class="container" style="margin-top: 70px;">
    <button class="btn btn-danger loading_btn" type="button" onclick='location.href="allEvents"'><i aria-hidden="true" class="fa fa-arrow-left"></i> All Events</button>
    <div class="card mt-3">
        <div class="card-header bg-dark text-white text-center">Add Event</div>
        <div class="card-body">
            <!-- add event form -->
            <form action="addEvent" method="POST" id="addEventForm">
                <div class="mb-3">
                    <label for="event_name" class="form-label">Event Name</label>
                    <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Enter event name" required>
                </div>
                <div class="mb-3">
                    <label for="event_organiser" class="form-label">Event Organiser</label>
                    <select class="form-select" name="event_organiser" id="event_organiser" required>
                        <option disabled selected value> -- select an organiser -- </option>
                        <?php
                        foreach ($data_organisers as $entry_organiser) :
                            $organiser_name = $entry_organiser['organiser_name'];
                        ?>
                            <option value="<?php echo $organiser_name; ?>"><?php echo $organiser_name; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="event_date" class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control" id="event_date" required>
                </div>
                <div class="mb-3">
                    Required Certificates:&nbsp;
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox_guest" name="guest" value="1">
                        <label class="form-check-label" for="checkbox_guest">Guest</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox_int_par" name="internal_participant" value="1">
                        <label class="form-check-label" for="checkbox_int_par">Internal Participant</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox_int_win" name="internal_winner" value="1">
                        <label class="form-check-label" for="checkbox_int_win">Internal Winner</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox_ext_par" name="external_participant" value="1">
                        <label class="form-check-label" for="checkbox_ext_par">External Participant</label>
                    </div>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox_ext_win" name="external_winner" value="1">
                        <label class="form-check-label" for="checkbox_ext_win">External Winner</label>
                    </div>
                    <div class="form-text">Once required certificates are selected for an event, it cannot be edited later!</div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="add_event">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
// footer file
include 'footer.php';
//close db connection
$conn->close();
// alerts
if ($status == 1) {
?>
    <script>
        Swal.fire({
            title: "Event added successfully",
            text: "Go to All Events to generate certificates",
            icon: "success",
            button: "OK"
        })
    </script>
<?php
} elseif ($status == 2) {
?>
    <script>
        Swal.fire({
            title: "Error in adding event",
            text: "Please try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        })
    </script>
<?php
} elseif ($status == 540) {
?>
    <script>
        Swal.fire({
            title: "Password Changed Successfully",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 541) {
?>
    <script>
        Swal.fire({
            title: "Error in Changing Password",
            text: "Logout and try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
}
?>
<!-- Check atleast one certificate category is selected -->
<script>
    $(document).ready(function() {
        $("#addEventForm").submit(function() {
            if ($('input:checkbox').filter(':checked').length < 1) {
                Swal.fire({
                    title: "Warning",
                    text: "Please select atleast one certificate category",
                    icon: "warning",
                    button: "OK"
                })
                return false;
            }
        });
    });
</script>