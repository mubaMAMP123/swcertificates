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
$page_title = "Organisers | SW VIT";
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-info";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "organisers";

// Include header file
include 'header.php';

// get all organisers data from 'organisers' table
$SELECT_ORGANISERS = "SELECT * FROM organisers ORDER BY organiser_name";
$stmt = $conn->query($SELECT_ORGANISERS);
$data_organisers = [];
if ($stmt->num_rows > 0) :
    while ($row = $stmt->fetch_assoc()) :
        $data_organisers[] = $row;
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
<!-- loading loader -->
<div class="loader" id="loading-loader">
    <div class="content">
        <img src="./assets/infinity.gif" alt="Loading...">
        <img src="./assets/loading.svg" alt="Loading...">
    </div>
</div>
<!-- Add organiser modal start -->
<div class="modal fade" id="add_organiser_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_organiser_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_organiser_form_heading">Add New Organiser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addOrganiser" method="post">
                    <div class="mb-3">
                        <label for="organiser_name" class="form-label">Organiser Name</label>
                        <input type="text" class="form-control" name="organiser_name" id="organiser_name" placeholder="Enter organiser name" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="add_organiser">Add Organiser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add organiser modal end -->

<div class="container" style="margin-top: 70px;">
    <button class="btn btn-danger loading_btn" type="button" onclick='location.href="home"'><i aria-hidden="true" class="fa fa-arrow-left"></i> All Events</button>
    <button class="btn btn-success float-end" type="button" data-bs-toggle="modal" data-bs-target="#add_organiser_form"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add New Organiser</button>

    <div class="bg-dark text-white p-3 shadow mt-5 text-center fs-2">
        <span>All Organisers</span>
    </div>

    <div class="input-group mt-2">
        <span class="input-group-text bg-dark text-white" id="search_organisers_input"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</span>
        <input type="text" class="form-control" id="organisers_search" aria-describedby="search_organisers_input" placeholder="Search an organiser...">
    </div>

    <div class="table-responsive mt-2">
        <table class="table table-dark table-hover text-center table-striped">
            <thead>
                <tr class="align-middle">
                    <th>Organiser ID</th>
                    <th>Organiser Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="organisers_table_body">
                <?php
                if (count($data_organisers) > 0) :
                    foreach ($data_organisers as $entry_organiser) :
                ?>
                        <tr class="align-middle">
                            <td><?= $entry_organiser['id']; ?></td>
                            <td><?= $entry_organiser['organiser_name']; ?></td>
                            <td>
                                <!-- edit button -->
                                <button type="button" class="btn btn-warning col-5 me-2" data-bs-toggle="modal" data-bs-target="#edit_organiser_form<?= $entry_organiser['id']; ?>">Edit</button>
                                <!-- delete button -->
                                <a href="deleteOrganiser?oid=<?= $entry_organiser['id']; ?>" class="delete_organiser">
                                    <button type="button" class="btn btn-danger col-5 me-2">Delete</button>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit organiser modal start -->
                        <div class="modal fade" id="edit_organiser_form<?= $entry_organiser['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_organiser_form_heading" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit_organiser_form_heading">Edit Organiser</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editOrganiser?oid=<?= $entry_organiser['id']; ?>" method="post">
                                            <div class="mb-3">
                                                <label for="organiser_name" class="form-label">Organiser Name</label>
                                                <input type="text" class="form-control" name="organiser_name" id="organiser_name" value="<?= $entry_organiser['organiser_name']; ?>" placeholder="Enter organiser name" required>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" name="edit_organiser">Update Organiser</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit organiser modal end -->
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
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
//alerts
if ($status == 1) {
?>
    <script>
        Swal.fire({
            title: "Organiser Added Successfully",
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
            title: "Error in Adding Organiser",
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
} elseif ($status == 3) {
?>
    <script>
        Swal.fire({
            title: "Organiser Deleted Successfully",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 4) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting Organiser",
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
} elseif ($status == 5) {
?>
    <script>
        Swal.fire({
            title: "Organiser Name Updated Successfully",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 6) {
?>
    <script>
        Swal.fire({
            title: "Error in Updating Organiser Name",
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
} elseif ($status == 7) {
?>
    <script>
        Swal.fire({
            title: "No Change in Organiser Name",
            icon: "warning",
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