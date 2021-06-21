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

// Initialize variables
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-info";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "checkEvent?eid=" . $event_id;

// get event details from 'events' table
$SELECT_EVENT = "SELECT * FROM events WHERE event_id = '" . $event_id . "'";
$stmt = $conn->query($SELECT_EVENT);
if ($stmt->num_rows == 0) : //redirect to all events page if no details are available
    $stmt->free();
    $conn->close();
    header("Location: allEvents");
    exit;
endif;
$row = $stmt->fetch_assoc();
// event details
$event_name = $row['event_name'];
$event_organiser = $row['event_organiser'];
$event_date = DateTime::createFromFormat('Y-m-d', $row['event_date'])->format('d F Y');
// required certificate status
$guest = $row['guest'];
$internal_participant = $row['internal_participant'];
$internal_winner = $row['internal_winner'];
$external_participant = $row['external_participant'];
$external_winner = $row['external_winner'];
$stmt->free();

// page title
$page_title = $event_name . " | SW VIT";
// header file
include 'header.php';

// get guest details
if ($guest) :
    include 'script_guests/s_get_guests_data.php';
endif;

// get internal winner details
if ($internal_winner) :
    include 'script_internal_winners/s_get_internal_winners_data.php';
endif;

// get internal participant details
if ($internal_participant) :
    include 'script_internal_participants/s_get_internal_participants_data.php';
endif;

// get external winner details
if ($external_winner) :
    include 'script_external_winners/s_get_external_winners_data.php';
endif;

// get external participant details
if ($external_participant) :
    include 'script_external_participants/s_get_external_participants_data.php';
endif;

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!--------------------------- Page body --------------------------->
<!-- sending mail loader -->
<div class="loader" id="sending-mail-loader">
    <div class="content">
        <img src="./assets/interwind.gif" alt="Loading...">
        <img src="./assets/sending_mails.svg" alt="Loading...">
    </div>
</div>
<!-- loading loader -->
<div class="loader" id="loading-loader">
    <div class="content">
        <img src="./assets/infinity.gif" alt="Loading...">
        <img src="./assets/loading.svg" alt="Loading...">
    </div>
</div>
<div class="container" style="margin-top: 70px;">
    <button class="btn btn-danger" type="button" onclick='location.href="allEvents"'><i aria-hidden="true" class="fa fa-arrow-left"></i> All Events</button>
    <!-- event details table -->
    <div class="table-responsive mt-3">
        <table class="table table-hover text-center shadow-sm">
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Event Organiser</th>
                    <th>Event Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $event_id; ?></td>
                    <td><?= $event_name; ?></td>
                    <td><?= $event_organiser; ?></td>
                    <td><?= $event_date; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container-fluid">
    <?php
    // guest card
    if ($guest) :
        include 'script_guests/s_guests.php';
    endif;
    // internal participant card
    if ($internal_participant) :
        include 'script_internal_participants/s_internal_participants.php';
    endif;
    // internal winner card
    if ($internal_winner) :
        include 'script_internal_winners/s_internal_winners.php';
    endif;
    // external participant card
    if ($external_participant) :
        include 'script_external_participants/s_external_participants.php';
    endif;
    // external winner card
    if ($external_winner) :
        include 'script_external_winners/s_external_winners.php';
    endif;
    ?>
</div>
<?php
// footer file
include 'footer.php';
//close db connection
$conn->close();
// alerts
include 'alerts_checkEvent.php';
?>