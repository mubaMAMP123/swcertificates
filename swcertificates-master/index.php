<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect to corresponding page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :
    if (isset($_SESSION["account_type"]) && $_SESSION["account_type"] == "super") {
        header("location: home");
        exit;
    } elseif (isset($_SESSION["account_type"]) && $_SESSION["account_type"] == "user") {
        header("location: allEvents");
        exit;
    }
endif;

// Include db config file
require_once 'dbConfig.php';

// Initialize variables
$page_title = "SW VIT | Login";
$loggedIn = FALSE;
$bg_color = "bg-light";
$login_error = 0;
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn, test_input($_GET['status'])) : 0;
$page_href = "index";

// Include header file
include 'header.php';

// Submit login form data
if (isset($_POST['login'])) :
    $username = mysqli_real_escape_string($conn, test_input($_POST['username']));
    $password = md5(mysqli_real_escape_string($conn, test_input($_POST['password'])));

    $SELECT_USER = "SELECT id, account_type FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $SELECT_USER);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) :
        session_regenerate_id();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["user"] = $username;
        $_SESSION["account_type"] = $row['account_type'];

        // close db connection
        $conn->close();

        // Redirect to corresponding page based on user account type
        if ($_SESSION["account_type"] == "super") :
            header("location: home");
            exit;
        endif;
        if ($_SESSION["account_type"] == "user") :
            header("location: allEvents");
            exit;
        endif;
    else :
        // close db connection
        $conn->close();
        $login_error = 1; //Invalid user credentials
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
?>
<div class="container">
    <div class="card w-25 position-absolute top-50 start-50 translate-middle">
        <div class="card-header text-center">Login to continue</div>
        <div class="card-body">
            <form action="index" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating" id="password_toggle">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div>
                <div class="d-grid col-12 mx-auto mt-3">
                    <button class="btn btn-success" type="submit" name="login">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
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
// alerts
if ($login_error == 1) {
?>
    <script>
        Swal.fire({
            title: "Error",
            text: "Invalid Login Credentials",
            icon: "error",
            button: "OK"
        })
    </script>
<?php
}

if ($status == 1) {
?>
    <script>
        Swal.fire({
            title: "Logged out successfully",
            icon: "success",
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