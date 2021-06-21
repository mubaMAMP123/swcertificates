<?php
if ($status == 1) {
?>
    <script>
        Swal.fire({
            title: "Approved",
            text: "Guest Certificate",
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
            title: "Error in Responding to Guest Certificate Request",
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
            title: "Rejected",
            text: "Guest certificate",
            icon: "warning",
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
            title: "Approved",
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
} elseif ($status == 5) {
?>
    <script>
        Swal.fire({
            title: "Error in Responding to Guest Certificates Request",
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
} elseif ($status == 6) {
?>
    <script>
        Swal.fire({
            title: "Rejected",
            text: "Guest certificates",
            icon: "warning",
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
            title: "Approved",
            text: "Internal winner certificates",
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
            title: "Error in Responding to Internal Winner Certificates Request",
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
            title: "Rejected",
            text: "Internal winner certificates",
            icon: "warning",
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
            title: "Approved",
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
} elseif ($status == 11) {
?>
    <script>
        Swal.fire({
            title: "Error in Responding to Internal Winner Certificate Request",
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
} elseif ($status == 12) {
?>
    <script>
        Swal.fire({
            title: "Rejected",
            text: "Internal winner certificate",
            icon: "warning",
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
            title: "Approved",
            text: "External winner certificates",
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
            title: "Error in Responding to External Winner Certificates Request",
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
            title: "Rejected",
            text: "External winner certificates",
            icon: "warning",
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
            title: "Approved",
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
} elseif ($status == 17) {
?>
    <script>
        Swal.fire({
            title: "Error in Responding to External Winner Certificate Request",
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
            title: "Rejected",
            text: "External winner certificate",
            icon: "warning",
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
            title: "Approved",
            text: "External participant certificates",
            icon: "success",
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
            title: "Error in Responding to External Participant Certificates Request",
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
} elseif ($status == 21) {
?>
    <script>
        Swal.fire({
            title: "Rejected",
            text: "External participant certificates",
            icon: "warning",
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
            title: "Approved",
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
} elseif ($status == 23) {
?>
    <script>
        Swal.fire({
            title: "Error in Responding to External Participant Certificate Request",
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
} elseif ($status == 24) {
?>
    <script>
        Swal.fire({
            title: "Rejected",
            text: "External participant certificate",
            icon: "warning",
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
            title: "Approved",
            text: "Internal participant certificates",
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
            title: "Error in Responding to Internal Participant Certificates Request",
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
            title: "Rejected",
            text: "Internal participant certificates",
            icon: "warning",
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
            title: "Approved",
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
} elseif ($status == 29) {
?>
    <script>
        Swal.fire({
            title: "Error in Responding to Internal Participant Certificate Request",
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
} elseif ($status == 30) {
?>
    <script>
        Swal.fire({
            title: "Rejected",
            text: "Internal participant certificate",
            icon: "warning",
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