<?php
if ($status == 1) {
?>
    <script>
        Swal.fire({
            title: "Guest Added",
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
            title: "Error in Adding Guest",
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
            title: "Request Sent",
            text: "For guest certificate",
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
            title: "Error in Guest Certificate Request",
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
            title: "Generated",
            text: "Guest certificate",
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
            title: "Generated",
            text: "All approved guest certificates",
            icon: "success",
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
            title: "Request Sent",
            text: "Guest certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 8) {
?>
    <script>
        Swal.fire({
            title: "Error in Guest Certificates Request",
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
} elseif ($status == 9) {
?>
    <script>
        Swal.fire({
            title: "Internal Winner Added",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 10) {
?>
    <script>
        Swal.fire({
            title: "Error in Adding Internal Winner",
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
} elseif ($status == 11) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For internal winner certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 12) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Winner Certificates Request",
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
} elseif ($status == 13) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For internal winner certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 14) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Winner Certificate Request",
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
} elseif ($status == 15) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "Internal winner certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 16) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "All approved internal winner certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 17) {
?>
    <script>
        Swal.fire({
            title: "Error in Guest Certificate Generation",
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
} elseif ($status == 18) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Winner Certificate Generation",
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
} elseif ($status == 19) {
?>
    <script>
        Swal.fire({
            title: "Error in Some Internal Winner Certificates Generation",
            text: "Check the status and try again! If the problem persists, contact developer",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 20) {
?>
    <script>
        Swal.fire({
            title: "Error in Some Guest Certificates Generation",
            text: "Check the status and try again! If the problem persists, contact developer",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 21) {
?>
    <script>
        Swal.fire({
            title: "External Winner Added",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 22) {
?>
    <script>
        Swal.fire({
            title: "Error in Adding External Winner",
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
} elseif ($status == 23) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For external winner certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 24) {
?>
    <script>
        Swal.fire({
            title: "Error in External Winner Certificate Request",
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
} elseif ($status == 25) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For external winner certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 26) {
?>
    <script>
        Swal.fire({
            title: "Error in External Winner Certificates Request",
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
} elseif ($status == 27) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "All approved external winner certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 28) {
?>
    <script>
        Swal.fire({
            title: "Error in Some External Winner Certificates Generation",
            text: "Check the status and try again! If the problem persists, contact developer",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 29) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "External winner certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 30) {
?>
    <script>
        Swal.fire({
            title: "Error in External Winner Certificate Generation",
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
} elseif ($status == 31) {
?>
    <script>
        Swal.fire({
            title: "External Participant Added",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 32) {
?>
    <script>
        Swal.fire({
            title: "Error in Adding External Participant",
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
} elseif ($status == 33) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For external participant certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 34) {
?>
    <script>
        Swal.fire({
            title: "Error in External Participant Certificates Request",
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
} elseif ($status == 35) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For external participant certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 36) {
?>
    <script>
        Swal.fire({
            title: "Error in External Participant Certificate Request",
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
} elseif ($status == 37) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "All approved external participant certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 38) {
?>
    <script>
        Swal.fire({
            title: "Error in Some External Participant Certificates Generation",
            text: "Check the status and try again! If the problem persists, contact developer",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 39) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "External participant certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 40) {
?>
    <script>
        Swal.fire({
            title: "Error in External Participant Certificate Generation",
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
} elseif ($status == 41) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For internal participant certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 42) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Participant Certificates Request",
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
} elseif ($status == 43) {
?>
    <script>
        Swal.fire({
            title: "Request Sent",
            text: "For internal participant certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 44) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Participant Certificate Request",
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
} elseif ($status == 45) {
?>
    <script>
        Swal.fire({
            title: "Internal Participant Added",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 46) {
?>
    <script>
        Swal.fire({
            title: "Error in Adding Internal Participant",
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
} elseif ($status == 47) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "All approved internal participant certificates",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 48) {
?>
    <script>
        Swal.fire({
            title: "Error in Some Internal Participant Certificates Generation",
            text: "Check the status and try again! If the problem persists, contact developer",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 49) {
?>
    <script>
        Swal.fire({
            title: "Generated",
            text: "Internal participant certificate",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 50) {
?>
    <script>
        Swal.fire({
            title: "Error in Internal Participant Certificate Generation",
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
} elseif ($status == 51) {
?>
    <script>
        Swal.fire({
            title: "Data Imported Successfully",
            text: "Internal participants",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 52) {
?>
    <script>
        Swal.fire({
            title: "Empty or Invalid Cells Found in File",
            text: "Check for empty cells or error in registration numbers and VIT mail IDs",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 53) {
?>
    <script>
        Swal.fire({
            title: "Error in File Upload",
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
} elseif ($status == 54) {
?>
    <script>
        Swal.fire({
            title: "Invalid File Format",
            text: "Download and use the template provided for importing data",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 55) {
?>
    <script>
        Swal.fire({
            title: "Data Imported Successfully",
            text: "External participants",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 56) {
?>
    <script>
        Swal.fire({
            title: "Empty or Invalid Cells Found in File",
            text: "Check for empty cells or error in email IDs",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 500) {
?>
    <script>
        Swal.fire({
            title: "Guest Deleted",
            text: "Generated guest certificate also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 501) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting Guest",
            text: "Please note this error & report to the developer immediately",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 502) {
?>
    <script>
        Swal.fire({
            title: "All Guests Deleted",
            text: "Generated guest certificates also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 503) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting All Guests",
            text: "Please note this error & report to the developer immediately",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 504) {
?>
    <script>
        Swal.fire({
            title: "Mail Sent",
            text: "Along with certificate attached to the guest",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 505) {
?>
    <script>
        Swal.fire({
            title: "Error in Sending Mail to Guest",
            text: "Check the mail id and try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 506) {
?>
    <script>
        Swal.fire({
            title: "Mail Request Submitted for Guests",
            text: "Check status for more info",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 507) {
?>
    <script>
        Swal.fire({
            title: "Mail Not Sent",
            text: "Mail was already sent once for all guests. Use the individual send mail option to send again",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 508) {
?>
    <script>
        Swal.fire({
            title: "All Internal Winners Deleted",
            text: "Generated internal winner certificates also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 509) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting All Internal Winners",
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
} elseif ($status == 510) {
?>
    <script>
        Swal.fire({
            title: "Internal Winner Deleted",
            text: "Generated internal winner certificate also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 511) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting Internal Winner",
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
} elseif ($status == 512) {
?>
    <script>
        Swal.fire({
            title: "Mail Sent",
            text: "Along with certificate attached to the internal winner",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 513) {
?>
    <script>
        Swal.fire({
            title: "Error in Sending Mail to Internal Winner",
            text: "Check the mail id and try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 514) {
?>
    <script>
        Swal.fire({
            title: "Mail Not Sent",
            text: "Mail was already sent once for all internal winners. Use the individual send mail option to send again",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 515) {
?>
    <script>
        Swal.fire({
            title: "Mail Request Submitted for Internal Winners",
            text: "Check status for more info",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 516) {
?>
    <script>
        Swal.fire({
            title: "All External Winners Deleted",
            text: "Generated external winner certificates also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 517) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting All External Winners",
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
} elseif ($status == 518) {
?>
    <script>
        Swal.fire({
            title: "External Winner Deleted",
            text: "Generated external winner certificate also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 519) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting External Winner",
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
} elseif ($status == 520) {
?>
    <script>
        Swal.fire({
            title: "Mail Not Sent",
            text: "Mail was already sent once for all external winners. Use the individual send mail option to send again",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 521) {
?>
    <script>
        Swal.fire({
            title: "Mail Request Submitted for External Winners",
            text: "Check status for more info",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 522) {
?>
    <script>
        Swal.fire({
            title: "Mail Sent",
            text: "Along with certificate attached to the external winner",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 523) {
?>
    <script>
        Swal.fire({
            title: "Error in Sending Mail to External Winner",
            text: "Check the mail id and try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 524) {
?>
    <script>
        Swal.fire({
            title: "All External Participants Deleted",
            text: "Generated external participant certificates also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 525) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting All External Participants",
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
} elseif ($status == 526) {
?>
    <script>
        Swal.fire({
            title: "External Participant Deleted",
            text: "Generated external participant certificate also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 527) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting External Participant",
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
} elseif ($status == 528) {
?>
    <script>
        Swal.fire({
            title: "Mail Not Sent",
            text: "Mail was already sent once for all external participants. Use the individual send mail option to send again",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 529) {
?>
    <script>
        Swal.fire({
            title: "Mail Request Submitted for External Participants",
            text: "Check status for more info",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 530) {
?>
    <script>
        Swal.fire({
            title: "Mail Sent",
            text: "Along with certificate attached to the external participant",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 531) {
?>
    <script>
        Swal.fire({
            title: "Error in Sending Mail to External Participant",
            text: "Check the mail id and try again! If the problem persists, contact developer",
            icon: "error",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 532) {
?>
    <script>
        Swal.fire({
            title: "All Internal Participants Deleted",
            text: "Generated internal participant certificates also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 533) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting All Internal Participants",
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
} elseif ($status == 534) {
?>
    <script>
        Swal.fire({
            title: "Internal Participant Deleted",
            text: "Generated internal participant certificate also deleted (if any)",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 535) {
?>
    <script>
        Swal.fire({
            title: "Error in Deleting Internal Participant",
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
} elseif ($status == 536) {
?>
    <script>
        Swal.fire({
            title: "Mail Not Sent",
            text: "Mail was already sent once for all internal participants. Use the individual send mail option to send again",
            icon: "warning",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 537) {
?>
    <script>
        Swal.fire({
            title: "Mail Request Submitted for Internal Participants",
            text: "Check status for more info",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 538) {
?>
    <script>
        Swal.fire({
            title: "Mail Sent",
            text: "Along with certificate attached to the internal participant",
            icon: "success",
            button: "OK"
        }).then((result) => {
            if (result.value) {
                document.location.href = "<?= $page_href; ?>";
            }
        })
    </script>
<?php
} elseif ($status == 539) {
?>
    <script>
        Swal.fire({
            title: "Error in Sending Mail to Internal Participant",
            text: "Check the mail id and try again! If the problem persists, contact developer",
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