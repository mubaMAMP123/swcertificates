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
$page_title = "All Events | SW VIT";
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-warning";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "allEvents";

// Include header file
include 'header.php';

// select all events from events table
$SELECT_EVENTS = "SELECT * FROM events ORDER BY event_id DESC";
$stmt = $conn->query($SELECT_EVENTS);
$data_events = [];
if ($stmt->num_rows > 0) :
    while ($row = $stmt->fetch_assoc()) :
        $data_events[] = $row;
    endwhile;
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
?>
<!-- Loading loader -->
<div class="loader" id="loading-loader">
    <div class="content">
        <img src="./assets/infinity.gif" alt="Loading...">
        <img src="./assets/loading.svg" alt="Loading...">
    </div>
</div>
<div class="container-fluid text-center bg-purple p-5 shadow mt-5">
    <h1 class="display-1 text-white">All Events</h1>
    <button class="btn btn-outline-light loading_btn" type="button" onclick="location.href = 'addEvent';"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Event</button>
</div>
<!-- search field -->
<div class="input-group">
    <span class="input-group-text bg-dark text-white" id="search_input"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</span>
    <input type="text" class="form-control" id="events_search" aria-describedby="search_input" placeholder="Search something...">
</div>
<!-- all events table -->
<div class="table-responsive">
    <table class="table table-bordered table-hover table-dark text-center">
        <thead>
            <tr class="table-light">
                <th></th>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Event Organiser</th>
                <th>Event Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="events_table_body">
            <?php
            $count = 1; //numbering each entry
            if (count($data_events) > 0) :
                foreach ($data_events as $entry_event) :
                    //convert date into word format
                    $event_date = (DateTime::createFromFormat('Y-m-d', $entry_event['event_date']))->format('D, d F Y');
            ?>
                    <tr class="align-middle">
                        <td><?= $count; ?></td>
                        <td><?= $entry_event['event_id']; ?></td>
                        <td><?= $entry_event['event_name']; ?></td>
                        <td><?= $entry_event['event_organiser']; ?></td>
                        <td><?= $event_date; ?></td>
                        <td>
                            <!-- select button -->
                            <a href="event?eid=<?= $entry_event['event_id']; ?>">
                                <button type="button" class="btn btn-primary col-5 loading_btn">Select</button>
                            </a>
                            <!-- delete button -->
                            <a href="deleteEvent?eid=<?= $entry_event['event_id']; ?>&uid=u" class="delete_event">
                                <button type="button" class="btn btn-danger col-5">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php
                    $count++;
                endforeach;
            else :
                ?>
                <!-- show no records found if no data is available -->
                <tr>
                    <td colspan="6">No Records Found</td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>
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
            title: "Event Deleted",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 2) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting Event",
            text: "Please note this error and report to the developer immediately",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
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