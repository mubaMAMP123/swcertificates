<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) :
  header("location: ../index");
  exit;
endif;

// Include db config file
require_once '../dbConfig.php';

require '../dompdf/autoload.inc.php';

// get event id and user account type
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

//get event and guest details
$SELECT = "SELECT * FROM events WHERE event_id = '" . $event_id . "'";
$query = mysqli_query($conn, $SELECT);
$row = mysqli_fetch_array($query);
$event_name = $row['event_name'];
$event_organiser = $row['event_organiser'];
$event_date = (DateTime::createFromFormat('Y-m-d', $row['event_date']))->format('D, d F Y');

$SELECT_GUESTS = "SELECT * FROM guests WHERE event_id = '" . $event_id . "' AND generate_status=1";
$result = mysqli_query($conn, $SELECT_GUESTS);
$emparray = array();
while ($row = mysqli_fetch_assoc($result)) {
  $emparray[] = $row;
}
$data_encoded =  json_encode($emparray);
$data_decoded =  json_decode($data_encoded);

$html = <<<EOD
          <!DOCTYPE html>
          <html lang='en'>
          <head>
          <meta charset='UTF-8' />
          <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>$event_name Guests Report</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
      }
      .heading {
        background-color: #210b2c;
        color: #fff;
        padding: 5px;
      }
      .sub-heading {
        background-color: #55286f;
        color: #fff;
        padding: 2px;
        margin-bottom: 0;
      }
      .content h3 {
        text-decoration: underline;
      }
      #event {
        border-collapse: collapse;
        width: 100%;
      }

      #event td,
      #event th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #event th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0d2818;
        color: white;
      }
      #event tr {
        background-color: #f2f2f2;
        text-align: center;
      }

      #guest {
        border-collapse: collapse;
        width: 100%;
      }

      #guest td,
      #guest th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #guest th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #04471c;
        color: white;
      }
      #guest tr {
        text-align: center;
      }
      #guest tr:nth-child(even) {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <div class='heading'>
      <h1>Office of the Students' Welfare</h1>
      <h3>VIT University</h3>
    </div>
    <div class='sub-heading'>
      <h2>Event Guests Report</h2>
    </div>
    <div class='content'>
      <h3>Event Details</h3>
      <table id='event'>
        <thead>
          <tr>
            <th>Event Name</th>
            <th>Event Organiser</th>
            <th>Event Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>$event_name</td>
            <td>$event_organiser</td>
            <td>$event_date</td>
          </tr>
        </tbody>
      </table>
      <h3>Guests' Details</h3>
      <table id='guest'>
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Email ID</th>
            <th>Certificate Link</th>
          </tr>
        </thead>
        <tbody>
EOD;
$count = 1;
foreach ($data_decoded as $entry) {
  $html .= <<<EOD
          <tr>
            <td>$count</td>
            <td>$entry->guest_name</td>
            <td>$entry->guest_email</td>
            <td><a href='http://localhost/swcertificates/certificates/$event_id/guests/$entry->guest_id.jpg'>View</a></td>
          </tr>
          EOD;
  $count++;
}
$html .= <<<EOD
        </tbody>
      </table>
    </div>
  </body>
</html>
EOD;

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("$event_name Guests' Report", array("Attachment" => 1));

// function to clean input data
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// close db connection
$conn->close();
