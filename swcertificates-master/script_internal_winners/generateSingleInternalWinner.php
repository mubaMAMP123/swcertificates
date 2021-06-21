<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") {
    header("location: ../index");
    exit;
}
// Include db config file
require_once '../dbConfig.php';

// get internal winner id and event id
$internal_winner_id = mysqli_real_escape_string($conn, test_input($_GET['iwid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$generated_by = $_SESSION['user'];
$generated_at = date("d-m-Y") . " at " . date("h:i:s A");

// select event and internal winner details
$SELECT = "SELECT event_name,event_organiser,event_date,entry_name,entry_regno,entry_position FROM events INNER JOIN " . $event_id . " ON events.event_id = " . $event_id . ".event_id WHERE entry_id='" . $internal_winner_id . "' AND approval_status=1 AND generate_status=0";
$stmt = $conn->query($SELECT);
$row = $stmt->fetch_assoc();
if ($stmt->num_rows == 0) {
    $stmt->free();
    $conn->close();
    header("Location: ../allEvents");
    exit;
}

// function to clean input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// event details
$event_name = $row['event_name'];
$event_organiser = $row['event_organiser'];
$event_date = DateTime::createFromFormat('Y-m-d', $row['event_date'])->format('d F Y');
// internal winner details
$entry_name = $row['entry_name'];
$entry_regno = $row['entry_regno'];
if ($row['entry_position'] == 1) {
    $entry_position = "1st";
} elseif ($row['entry_position'] == 2) {
    $entry_position = "2nd";
} elseif ($row['entry_position'] == 3) {
    $entry_position = "3rd";
}
// generating certificate number
$certificate_number = substr($event_id, 2, 7) . sprintf('%03s', $internal_winner_id);

header('Content-type: image/jpeg');
$font = realpath('../fonts/CALIBRIB.ttf');
$font_light = realpath('../fonts/CALIBRIL.ttf');
$font_italic = realpath('../fonts/CALIBRII.ttf');
$font_italic_bold = realpath('../fonts/CALIBRIZ.ttf');
$image = imagecreatefromjpeg("../templates/Winner_Internal.jpg");
global $image_width;
$image_width = imagesx($image);
$color = imagecolorallocate($image, 0, 96, 86);
$angle = 0;
/* ----------------------NAME---------------------------------------- */
$name = $entry_name;
$font_size_name = 45;
$name_start_y_offset = 570;
$name_bound = imageftbbox($font_size_name, $angle, $font, $name);
$name_start_x_offset = calcXoffset($name_bound[0], $name_bound[2]);
imagettftext($image, $font_size_name, $angle, $name_start_x_offset, $name_start_y_offset, $color, $font, $name);
/* ----------------------NAME---------------------------------------- */
/* ----------------------POSITION---------------------------------------- */
$position = $entry_position;
$font_size_position = 30;
$position_start_y_offset = 635;
if ($position == "1st") {
    $position_start_x_offset = 785;
} elseif ($position == "2nd") {
    $position_start_x_offset = 777;
} elseif ($position == "3rd") {
    $position_start_x_offset = 783;
}

imagettftext($image, $font_size_position, $angle, $position_start_x_offset, $position_start_y_offset, $color, $font_italic_bold, $position);
/* ----------------------POSITION---------------------------------------- */
/* ----------------------EVENT NAME----------------------------------------*/
$topic = ucwords($event_name);
$font_size_topic = 35;
$topic_start_y_offset = 720;
$topic_bound = imageftbbox($font_size_topic, $angle, $font, $topic);
$topic_start_x_offset = calcXoffset($topic_bound[0], $topic_bound[2]);
imagettftext($image, $font_size_topic, $angle, $topic_start_x_offset, $topic_start_y_offset, $color, $font, $topic);
/* ----------------------EVENT NAME---------------------------------------- */
/* ----------------------EVENT DATE----------------------------------------*/
$date = "on " . $event_date;
$font_size_date = 25;
$date_bound = imageftbbox($font_size_date, $angle, $font, $date);
$date_start_x_offset = calcXoffset($date_bound[0], $date_bound[2]);
$date_start_y_offset = 930;
imagettftext($image, $font_size_date, $angle, $date_start_x_offset, $date_start_y_offset, $color, $font_italic, $date);
/* ----------------------EVENT DATE---------------------------------------- */
/* ----------------------EVENT ORGANISER----------------------------------------*/
$organiser = strtoupper($event_organiser);
$font_size_organiser = 30;
$organiser_start_y_offset = 865;
$organiser_bound = imageftbbox($font_size_organiser, $angle, $font, $organiser);
$organiser_start_x_offset = calcXoffset($organiser_bound[0], $organiser_bound[2]);
imagettftext($image, $font_size_organiser, $angle, $organiser_start_x_offset, $organiser_start_y_offset, $color, $font, $organiser);
/* ----------------------EVENT ORGANISER---------------------------------------- */
/* ----------------------CERTIFICATE NUMBER----------------------------------------*/
$number = $certificate_number;
$font_size_number = 20;
$number_start_x_offset = 360;
$number_start_y_offset = 1040;
imagettftext($image, $font_size_number, $angle, $number_start_x_offset, $number_start_y_offset, $color, $font_light, $number);
/* ----------------------CERTIFICATE NUMBER---------------------------------------- */
/* ----------------------VERIFICATION LINK----------------------------------------*/
$link = "http://localhost/swcertificates/checkValid?cn=" . $certificate_number;
$font_size_link = 20;
$link_start_x_offset = 113;
$link_start_y_offset = 1120;
imagettftext($image, $font_size_link, $angle, $link_start_x_offset, $link_start_y_offset, $color, $font_light, $link);
/* ----------------------VERIFICATION LINK---------------------------------------- */
// save image as jpeg to event internal_winner folder
imagejpeg($image, "../certificates/$event_id/internal_winners/$entry_regno.jpg");
imagedestroy($image);
// check certificate is generated
$certificate_exists = file_exists("../certificates/$event_id/internal_winners/$entry_regno.jpg");
if ($certificate_exists === TRUE) :
    // set certificate generate status
    $UPDATE = "UPDATE " . $event_id . " SET generate_status=1, generated_by='" . $generated_by . "', generated_at='" . $generated_at . "', certificate_number = '" . $certificate_number . "', verification_link = '" . $link . "' WHERE entry_id = '" . $internal_winner_id . "'";
    $conn->query($UPDATE);
    $qstring = '?eid=' . $event_id . '&status=15';
else :
    $qstring = '?eid=' . $event_id . '&status=18';
endif;
function calcXoffset($item_lower_left_x, $item_lower_right_x)
{
    global $image_width;
    $item_width = $item_lower_right_x - $item_lower_left_x;
    return $item_start_x_offset = ($image_width - $item_width) / 2;
}
$stmt->free();
// close db connection
$conn->close();
// redirect to event page with status
header("Location: ../event" . $qstring);
exit;
