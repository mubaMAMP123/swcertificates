<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["account_type"] != "user") {
    header("location: ../index");
    exit;
}
// Include db config file
require_once '../dbConfig.php';

// get guest id and event id
$guest_id = mysqli_real_escape_string($conn, test_input($_GET['gid']));
$event_id = mysqli_real_escape_string($conn, test_input($_GET['eid']));

//set timezone
date_default_timezone_set("Asia/Calcutta");

// set variables
$generated_by = $_SESSION['user'];
$generated_at = date("d-m-Y") . " at " . date("h:i:s A");

// select event and guest details
$SELECT = "SELECT event_name,event_organiser,event_date,guest_name FROM events INNER JOIN guests ON events.event_id = guests.event_id WHERE guest_id='" . $guest_id . "' AND approval_status=1";
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
// guest details
$guest_name = $row['guest_name'];

header('Content-type: image/jpeg');
$font = realpath('../fonts/saki.otf');
$image = imagecreatefromjpeg("../templates/Guest.jpg");
global $image_width;
$image_width = imagesx($image);
$color = imagecolorallocate($image, 169, 142, 120);
$angle = 0;
/* ----------------------NAME---------------------------------------- */
$name = $guest_name;
$name_len = strlen($name);
if ($name_len <= 15) {
    $font_size_name = 170;
    $name_start_y_offset = 2320;
} elseif ($name_len >= 16 && $name_len <= 21) {
    $font_size_name = 150;
    $name_start_y_offset = 2310;
} elseif ($name_len >= 22 && $name_len <= 25) {
    $font_size_name = 130;
    $name_start_y_offset = 2300;
} elseif ($name_len >= 26 && $name_len <= 30) {
    $font_size_name = 120;
    $name_start_y_offset = 2300;
} elseif ($name_len >= 31 && $name_len <= 35) {
    $font_size_name = 100;
    $name_start_y_offset = 2290;
} elseif ($name_len >= 36 && $name_len <= 40) {
    $font_size_name = 90;
    $name_start_y_offset = 2290;
} elseif ($name_len >= 41) {
    $font_size_name = 80;
    $name_start_y_offset = 2280;
}
$name_bound = imageftbbox($font_size_name, $angle, $font, $name);
$name_start_x_offset = calcXoffset($name_bound[0], $name_bound[2]);
imagettftext($image, $font_size_name, $angle, $name_start_x_offset, $name_start_y_offset, $color, $font, $name);
/* ----------------------NAME---------------------------------------- */
/* ----------------------TOPIC----------------------------------------*/
$topic = ucwords($event_name);
$topic_len = strlen($topic);
if ($topic_len <= 23) {
    $font_size_topic = 130;
    $topic_start_y_offset = 3185;
} elseif ($topic_len >= 24 && $topic_len <= 30) {
    $font_size_topic = 110;
    $topic_start_y_offset = 3180;
} elseif ($topic_len >= 31 && $topic_len <= 35) {
    $font_size_topic = 100;
    $topic_start_y_offset = 3170;
} elseif ($topic_len >= 36 && $topic_len <= 40) {
    $font_size_topic = 90;
    $topic_start_y_offset = 3160;
} elseif ($topic_len >= 41 && $topic_len <= 45) {
    $font_size_topic = 80;
    $topic_start_y_offset = 3150;
} else {
    $font_size_topic = 70;
    $topic_start_y_offset = 3140;
}
$topic_bound = imageftbbox($font_size_topic, $angle, $font, $topic);
$topic_start_x_offset = calcXoffset($topic_bound[0], $topic_bound[2]);
imagettftext($image, $font_size_topic, $angle, $topic_start_x_offset, $topic_start_y_offset, $color, $font, $topic);
/* ----------------------TOPIC---------------------------------------- */
/* ----------------------DATE----------------------------------------*/
$date = "ON " . $event_date;
$font_size_date = 110;
$date_bound = imageftbbox($font_size_date, $angle, $font, $date);
$date_start_x_offset = calcXoffset($date_bound[0], $date_bound[2]);
$date_start_y_offset = 3950;
imagettftext($image, $font_size_date, $angle, $date_start_x_offset, $date_start_y_offset, $color, $font, $date);
/* ----------------------DATE---------------------------------------- */
/* ----------------------ORGANISER----------------------------------------*/
$organiser = strtoupper($event_organiser);
$organiser_len = strlen($organiser);
if ($organiser_len <= 30) {
    $font_size_organiser = 120;
    $organiser_start_y_offset = 3680;
} elseif ($organiser_len >= 31 && $organiser_len <= 40) {
    $font_size_organiser = 100;
    $organiser_start_y_offset = 3670;
} elseif ($organiser_len >= 41) {
    $font_size_organiser = 80;
    $organiser_start_y_offset = 3660;
}
$organiser_bound = imageftbbox($font_size_organiser, $angle, $font, $organiser);
$organiser_start_x_offset = calcXoffset($organiser_bound[0], $organiser_bound[2]);
imagettftext($image, $font_size_organiser, $angle, $organiser_start_x_offset, $organiser_start_y_offset, $color, $font, $organiser);
/* ----------------------ORGANISER---------------------------------------- */
// save image as jpeg to event guest folder
imagejpeg($image, "../certificates/$event_id/guests/$guest_id.jpg");
imagedestroy($image);

// check certificate is generated
$certificate_exists = file_exists("../certificates/$event_id/guests/$guest_id.jpg");
// set certificate generate status
if ($certificate_exists === TRUE) :
    $UPDATE = "UPDATE guests SET generate_status=1, generated_by='" . $generated_by . "', generated_at='" . $generated_at . "' WHERE guest_id = '" . $guest_id . "'";
    $conn->query($UPDATE);
    $qstring = '?eid=' . $event_id . '&status=5';
else :
    $qstring = '?eid=' . $event_id . '&status=17';
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
