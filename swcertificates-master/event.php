<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") :
    header("location: index");
    exit;
endif;

// db config file
require_once 'dbConfig.php';

// initialize variables
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-warning";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0; //alert status
$page_href = "event?eid=" . $event_id;

// get event details from 'events' table
$SELECT_EVENT = "SELECT * FROM events WHERE event_id = '" . $event_id . "'";
$stmt = $conn->query($SELECT_EVENT);
if ($stmt->num_rows == 0) :
    $stmt->free();
    $conn->close();
    header("Location: allEvents");
    exit;
endif;
$row = $stmt->fetch_assoc();

// assign event table values to variables
$event_name = $row['event_name'];
$event_organiser = $row['event_organiser'];
$event_date = DateTime::createFromFormat('Y-m-d', $row['event_date'])->format('d F Y');
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

// get guests data
if ($guest) :
    include('script_guests/u_get_guests_data.php');
endif;

// get internal winners data
if ($internal_winner) :
    include('script_internal_winners/u_get_internal_winners_data.php');
endif;

// get internal participants data
if ($internal_participant) :
    include('script_internal_participants/u_get_internal_participants_data.php');
endif;

// get external winners data
if ($external_winner) :
    include('script_external_winners/u_get_external_winners_data.php');
endif;

// get external participants data
if ($external_participant) :
    include('script_external_participants/u_get_external_participants_data.php');
endif;

//function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!--------------------------- Page body --------------------------->
<!-- generating certificate loader -->
<div class="loader" id="generating-certificate-loader">
    <div class="content">
        <img src="./assets/gear.gif" alt="Loading...">
        <img src="./assets/generating_certificates.svg" alt="Loading...">
    </div>
</div>
<!-- sending mail loader -->
<div class="loader" id="sending-mail-loader">
    <div class="content">
        <img src="./assets/interwind.gif" alt="Loading..." width="300px">
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
        include 'script_guests/u_guests.php';
    endif;
    // internal participant card
    if ($internal_participant) :
        include 'script_internal_participants/u_internal_participants.php';
    endif;
    // internal winner card
    if ($internal_winner) :
        include 'script_internal_winners/u_internal_winners.php';
    endif;
    // external participant card
    if ($external_participant) :
        include 'script_external_participants/u_external_participants.php';
    endif;
    // external winner card
    if ($external_winner) :
        include 'script_external_winners/u_external_winners.php';
    endif;
    ?>
</div>
<?php
// footer file
include 'footer.php';
//close db connection
$conn->close();
// alerts
include 'alerts_event.php';
?>