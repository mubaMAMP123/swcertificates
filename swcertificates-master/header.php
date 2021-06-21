<?php
$user_id = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
$account_type = isset($_SESSION["account_type"]) ? $_SESSION["account_type"] : "";
$page_href = isset($page_href) ? $page_href : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $page_title; ?></title>
</head>

<body class="d-flex flex-column min-vh-100 <?php echo $bg_color; ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand"><?php
                                        if ($loggedIn) :
                                            echo "Certificate Generator";
                                        else :
                                            echo "Office of the Students' Welfare | VIT Vellore";
                                        endif;
                                        ?></span>
            <?php
            if ($loggedIn) {
            ?>
                <div class="dropdown me-3">
                    <button class="btn <?= $welcome_btn_color; ?> dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome <?= $_SESSION['user']; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#change_password_form">Change Password</a></li>
                        <li><a class="dropdown-item" href="logout">Logout</a></li>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>

    <!-- Change password modal start -->
    <div class="modal fade" id="change_password_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="change_password_form_heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_password_form_heading">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="changePassword?uid=<?= $user_id; ?>&at=<?= $account_type; ?>&ph=<?= $page_href; ?>" method="post">
                        <div class="mb-3" id="password_toggle_new">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" onChange="onChange()" placeholder="Enter new password" required>
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </div>
                        <div class="mb-3" id="password_toggle_new_confirm">
                            <label for="new_password_confirm" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" onChange="onChange()" placeholder="Confirm new password" required>
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger" name="password_submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Change password modal end -->
    <script>
        // check password match
        function onChange() {
            const password = document.querySelector("input[name=new_password]");
            const confirm = document.querySelector("input[name=new_password_confirm]");
            if (confirm.value === password.value) {
                confirm.setCustomValidity("");
            } else {
                confirm.setCustomValidity("Passwords do not match");
            }
        }
    </script>