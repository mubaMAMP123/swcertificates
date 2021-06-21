<?php
// get guest details whose request status = 1
$SELECT_GUESTS = "SELECT * FROM guests WHERE event_id = '" . $event_id . "' AND request_status=1";
$stmt = $conn->query($SELECT_GUESTS);
$data_guests = [];
if ($stmt->num_rows > 0) {
    while ($row = $stmt->fetch_assoc()) {
        $data_guests[] = $row;
    }
}
$stmt->free();

//condition to show bulk buttons
$guest_approve_all_btn = 0;
$guest_download_all_btn = 1;

if (count($data_guests) > 0) :
    //condition to show approve all and reject all buttons
    foreach ($data_guests as $entry_guest) :
        if ($entry_guest['approval_status'] == 0) :
            $guest_approve_all_btn = 1;
            break;
        endif;
    endforeach;
    //condition to show download all button
    $temp = 1;
    foreach ($data_guests as $entry_guest) :
        if ($entry_guest['approval_status'] != 2) :
            $temp = 0;
            break;
        endif;
    endforeach;
    foreach ($data_guests as $entry_guest) :
        if (($entry_guest['approval_status'] == 0 && $entry_guest['generate_status'] == 0) || ($entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 0) || $temp == 1) {
            $guest_download_all_btn = 0;
            break;
        }
    endforeach;

endif;
