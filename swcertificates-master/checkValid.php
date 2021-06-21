<?php
// Include db config file
require_once 'dbConfig.php';

// Initialize variables
$page_title = "Validate Certificate | SW VIT";
$loggedIn = FALSE;
$bg_color = "";
$certificate_valid = false;
$event_valid = false;
$entry_valid = false;

$certificate_number = mysqli_real_escape_string($conn, test_input($_GET['cn']));
$event_id = "EV" . substr($certificate_number, 0, 5);
$entry_id = ltrim(substr($certificate_number, 5, 8), "0");

// get event details
$SELECT_EVENT = "SELECT * FROM events WHERE event_id = '" . $event_id . "'";
$stmt = $conn->query($SELECT_EVENT);
if (mysqli_num_rows($stmt) > 0) :
    $event_valid = true;
    $row = $stmt->fetch_assoc();
    $event_name = $row['event_name'];
    $event_organiser = $row['event_organiser'];
    //convert date into word format
    $event_date = (DateTime::createFromFormat('Y-m-d', $row['event_date']))->format('D, d F Y');
endif;
$stmt->free();

// get entry details
$SELECT_ENTRY = "SELECT * FROM " . $event_id . " WHERE entry_id = '" . $entry_id . "'";
$stmt = $conn->query($SELECT_ENTRY);
if (mysqli_num_rows($stmt) > 0) :
    $entry_valid = true;
    $row = $stmt->fetch_assoc();
    $entry_regno = $row['entry_regno'];
    $entry_name = $row['entry_name'];
    $entry_email = $row['entry_email'];
    if ($row['entry_position'] == 1) {
        $entry_position = "1st";
    } elseif ($row['entry_position'] == 2) {
        $entry_position = "2nd";
    } elseif ($row['entry_position'] == 3) {
        $entry_position = "3rd";
    } elseif ($row['entry_position'] == 0) {
        $entry_position = "0th";
    }
    $entry_college = $row['entry_college'];
endif;
$stmt->free();

if ($event_valid == true && $entry_valid == true) :
    $certificate_valid = true;
endif;

// Include header file
include 'header.php';

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($certificate_valid == true) :
?>
    <div class="container">
        <div class="card w-50 position-absolute top-50 start-50 translate-middle">
            <div class="card-header text-center bg-success text-white fs-3">Valid Certificate</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Event Name</strong></td>
                                <td><?= $event_name; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Event Organiser</strong></td>
                                <td><?= $event_organiser; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Event Date</strong></td>
                                <td><?= $event_date; ?></td>
                            </tr>
                            <?php
                            if ($entry_regno != 0) :
                            ?>
                                <tr>
                                    <td><strong>Registration No.</strong></td>
                                    <td><?= $entry_regno; ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><?= $entry_name; ?></td>
                            </tr>
                            <?php
                            if ($entry_college != "VIT") :
                            ?>
                                <tr>
                                    <td><strong>College</strong></td>
                                    <td><?= $entry_college; ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>
                            <tr>
                                <td>
                                    <strong>
                                        <?php
                                        if ($entry_college == "VIT") :
                                            echo "VIT Mail ID";
                                        else :
                                            echo "Email ID";
                                        endif;
                                        ?>
                                    </strong>
                                </td>
                                <td><?= $entry_email; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Winner / Participant</strong></td>
                                <td>
                                    <?php
                                    if ($entry_position != "0th") :
                                        echo "Winner";
                                    else :
                                        echo "Participant";
                                    endif;
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if ($entry_position != 0) :
                            ?>
                                <tr>
                                    <td><strong>Position</strong></td>
                                    <td><?= $entry_position; ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>
                            <tr>
                                <td><strong>Certificate No.</strong></td>
                                <td><?= $certificate_number; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
else :
?>
    <div class="container">
        <div class="card w-50 position-absolute top-50 start-50 translate-middle">
            <div class="card-header text-center bg-danger text-white fs-1">Invalid Certificate</div>
        </div>
    </div>
<?php
endif;
// footer file
include 'footer.php';
//close db connection
$conn->close();
?>