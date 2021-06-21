<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../index");
  exit;
}

// Include db config file
require_once '../dbConfig.php';

// get internal participant id, event id & user account type
$internal_participant_id = mysqli_real_escape_string($conn, test_input($_GET['ipid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));
$account_type = mysqli_real_escape_string($conn, test_input($_GET['uid']));

//select event and internal participant details
$SELECT = "SELECT event_name,event_organiser,event_date,entry_name,entry_regno,entry_email,certificate_number,verification_link FROM events INNER JOIN " . $event_id . " ON events.event_id = " . $event_id . ".event_id WHERE entry_id='" . $internal_participant_id . "' AND generate_status=1";
$stmt = $conn->query($SELECT);
$row = $stmt->fetch_assoc();
if ($stmt->num_rows == 0) {
  $stmt->free();
  $conn->close();
  header("Location: allEvents");
  exit;
}

// event details
$event_name = $row['event_name'];
$event_organiser = $row['event_organiser'];
$event_date = DateTime::createFromFormat('Y-m-d', $row['event_date'])->format('d F Y');
// internal participant details
$entry_name = ucwords(strtolower($row['entry_name']));
$entry_email = $row['entry_email'];
$entry_regno = $row['entry_regno'];
$certificate_number = $row['certificate_number'];
$verification_link = $row['verification_link'];
$certificate_path = "../certificates/" . $event_id . "/internal_participants/" . $entry_regno . ".jpg";
$stmt->free();

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$mailed_by = $_SESSION['user'];
$mailed_at = date("d-m-Y") . " at " . date("h:i:s A");

// phpMailer files
require '../phpMailer/includes/PHPMailer.php';
require '../phpMailer/includes/SMTP.php';
require '../phpMailer/includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

// mail settings
$mail->isSMTP();
$mail->isHTML(true);
// mail host
$mail->Host = "smtpout.secureserver.net";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "ssl";
$mail->Port = "465";
// mail credentials
$mail->Username = "no-reply@primaveravit.com";
$mail->Password = "DswVit!2021";
// mail subject
$mail->Subject = $event_name . " Participant Certificate";
// mail from address
$mail->setFrom("no-reply@primaveravit.com", "Office of the Students' Welfare | VIT Vellore");
// add certificate as attachment
$mail->addAttachment($certificate_path);
//mail body
$msg = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
  </head>
  <body>
    <div style="background-color: #edc800; color: #000; padding: 10px; text-align: center;">
      <h1>Congratulations</h1>
    </div>
    <div style="background-color: #21295d; color: #fff; padding: 10px; line-height: 1.5; text-align: center;">
      Dear <strong>$entry_name</strong> 
      <br /><br />
      Congratulations for participating in the event
      <strong>$event_name</strong> conducted on
      <strong>$event_date</strong> organised by
      <strong>$event_organiser</strong>.
      <br />
      
      Congratulations once again and hope to be in contact for our future events.
      <br /><br />
      <a href="http://localhost/swcertificates/certificates/$event_id/internal_participants/$entry_regno.jpg" style="text-decoration:none;">
        <button style="outline: none; background-color: #edc800; border: none; border-radius: 5px; margin: 0 auto; display: block; padding: 10px;">
          Download Certificate
        </button>
      </a>
      <br />
      Regards 
      <br /><br />
      Office of the Students' Welfare 
      <br />
      VIT University 
      <br />
      Vellore Campus
      <br /><br />
    </div>
    <div style="background-color: #000; text-align: center; color: #f0ffff; font-size: smaller; padding: 10px;">
      This is an auto-generated email. 
      <br />
      Please do not reply to this email. Emails sent to this address will not be answered. 
      <br />
      <br />
      &#169; Office of the Students' Welfare | VIT Vellore
    </div>
  </body>
</html>
EOT;
$mail->msgHTML($msg);
//mail to address
$mail->addAddress("$entry_email");

if ($mail->send()) {
  $qstring = '?eid=' . $event_id . '&status=538';
  $UPDATE = "UPDATE " . $event_id . " SET mail_status=1, mailed_by='" . $mailed_by . "', mailed_at='" . $mailed_at . "' WHERE entry_id = '" . $internal_participant_id . "'";
  $conn->query($UPDATE);
} else {
  $qstring = '?eid=' . $event_id . '&status=539';
  $UPDATE = "UPDATE " . $event_id . " SET mail_status=2 WHERE entry_id = '" . $internal_participant_id . "'";
  $conn->query($UPDATE);
}

$mail->smtpClose();
// close db connection
$conn->close();
// function to clean input data
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// redirect to respective page with status
if ($account_type == "u") :
  header("Location: ../event" . $qstring);
  exit;
else :
  header("Location: ../checkEvent" . $qstring);
  exit;
endif;
