<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "super") :
    header("location: index");
    exit;
endif;

// Include db config file
require_once 'dbConfig.php';

// Initialize variables
$page_title = "Users | SW VIT";
$loggedIn = TRUE;
$bg_color = "";
$welcome_btn_color = "btn-outline-info";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "users";

// Include header file
include 'header.php';

// get all users data from organisers table
$SELECT_USERS = "SELECT * FROM accounts";
$stmt = $conn->query($SELECT_USERS);
$data_users = [];
if ($stmt->num_rows > 0) :
    while ($row = $stmt->fetch_assoc()) :
        $data_users[] = $row;
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
<!-- Add user modal start -->
<div class="modal fade" id="add_user_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_user_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_user_form_heading">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addUser" method="post">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3" id="password_toggle_new_user">
                        <label for="new_user_password" class="form-label">Create a Password</label>
                        <input type="password" class="form-control" id="new_user_password" name="new_user_password" onChange="onChangePassword()" placeholder="Enter a password" required>
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                    <div class="mb-3" id="password_toggle_new_user_confirm">
                        <label for="new_user_password_confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="new_user_password_confirm" name="new_user_password_confirm" onChange="onChangePassword()" placeholder="Confirm password" required>
                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    </div>
                    <div class="mb-3">
                        <label for="user_account_type" class="form-label">Account type</label>
                        <select class="form-select" name="user_account_type" id="user_account_type" required>
                            <option disabled selected value> -- select a user type -- </option>
                            <option value="user">Student</option>
                            <option value="super">Faculty</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add user modal end -->

<div class="container" style="margin-top: 70px;">
    <button class="btn btn-danger loading_btn" type="button" onclick='location.href="home"'><i aria-hidden="true" class="fa fa-arrow-left"></i> All Events</button>
    <button class="btn btn-success float-end" type="button" data-bs-toggle="modal" data-bs-target="#add_user_form"><i aria-hidden="true" class="fa fa-plus-circle"></i> Add New User</button>

    <div class="bg-dark text-white p-3 shadow mt-5 text-center fs-2">
        <span>All Users</span>
    </div>

    <div class="table-responsive mt-1">
        <table class="table table-dark table-hover text-center table-striped">
            <thead>
                <tr class="align-middle">
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Account Type</th>
                    <th>Created By</th>
                    <th>Last Password Change</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="organisers_table_body">
                <?php
                if (count($data_users) > 0) :
                    foreach ($data_users as $entry_user) :
                ?>
                        <tr class="align-middle">
                            <td><?= $entry_user['id']; ?></td>
                            <td><?= $entry_user['username']; ?></td>
                            <td><?php
                                if ($entry_user['account_type'] == "user") :
                                    echo "Student";
                                else :
                                    echo "Faculty";
                                endif;
                                ?></td>
                            <td><?= $entry_user['created_by'] . " on " . $entry_user['created_at']; ?></td>
                            <td>
                                <?php
                                if ($entry_user['password_changed_at'] == "") :
                                    echo "Not changed";
                                else :
                                    echo $entry_user['password_changed_at'];
                                endif;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($entry_user['id'] != $_SESSION['id'] && $entry_user['id'] != "US01" && $entry_user['id'] != "US02") :
                                ?>
                                    <!-- delete button -->
                                    <a href="deleteUser?uid=<?= $entry_user['id']; ?>" class="delete_user">
                                        <button type="button" class="btn btn-danger me-2">Delete</button>
                                    </a>
                                <?php
                                else :
                                    echo "-";
                                endif;
                                ?>
                            </td>
                        </tr>
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
<script>
    // check password match
    function onChangePassword() {
        const password = document.querySelector("input[name=new_user_password]");
        const confirm = document.querySelector("input[name=new_user_password_confirm]");
        if (confirm.value === password.value) {
            confirm.setCustomValidity("");
        } else {
            confirm.setCustomValidity("Passwords do not match");
        }
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
            title: "User Added Successfully",
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
            title: "Error in Adding User",
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
            title: "User Deleted Successfully",
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
            title: "Error in Deleting User",
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