<?php
//get internal participants details from the event table
$SELECT_INTERNAL_PARTICIPANT = "SELECT * FROM " . $event_id . " WHERE entry_position = 0 AND entry_college = 'VIT'";
$stmt = $conn->query($SELECT_INTERNAL_PARTICIPANT);
$data_internal_participants = [];
if ($stmt->num_rows > 0) {
    while ($row = $stmt->fetch_assoc()) {
        $data_internal_participants[] = $row;
    }
}
$stmt->free();

// conditions to show bulk buttons
$internal_participant_request_all_btn = 0;
$internal_participant_generate_all_btn = 0;
$internal_participant_download_all_btn = 1;
if (count($data_internal_participants) > 0) :
    // condition to show request all button
    foreach ($data_internal_participants as $entry_internal_participant) :
        if (!($entry_internal_participant['request_status'])) :
            $internal_participant_request_all_btn = 1;
            break;
        endif;
    endforeach;
    // condition to show generate all button
    foreach ($data_internal_participants as $entry_internal_participant) :
        if ($entry_internal_participant['approval_status'] == 0) {
            $internal_participant_generate_all_btn = 0;
            break;
        } elseif ($entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 0) {
            $internal_participant_generate_all_btn = 1;
        }
    endforeach;
    // condition to show download all button
    $temp = 1;
    foreach ($data_internal_participants as $entry_internal_participant) :
        if ($entry_internal_participant['approval_status'] != 2) :
            $temp = 0;
            break;
        endif;
    endforeach;
    foreach ($data_internal_participants as $entry_internal_participant) :
        if (($entry_internal_participant['approval_status'] == 0 && $entry_internal_participant['generate_status'] == 0) || ($entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 0) || $temp == 1) {
            $internal_participant_download_all_btn = 0;
            break;
        }
    endforeach;

endif;
