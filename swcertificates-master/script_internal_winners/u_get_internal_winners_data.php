<?php
//get internal winners details from the event table
$SELECT_INTERNAL_WINNER = "SELECT * FROM " . $event_id . " WHERE entry_position != 0 AND entry_college = 'VIT'";
$stmt = $conn->query($SELECT_INTERNAL_WINNER);
$data_internal_winners = [];
if ($stmt->num_rows > 0) {
    while ($row = $stmt->fetch_assoc()) {
        $data_internal_winners[] = $row;
    }
}
$stmt->free();

// conditions to show bulk buttons
$internal_winner_request_all_btn = 0;
$internal_winner_generate_all_btn = 0;
$internal_winner_download_all_btn = 1;
if (count($data_internal_winners) > 0) :
    // condition to show request all button
    foreach ($data_internal_winners as $entry_internal_winner) :
        if (!($entry_internal_winner['request_status'])) :
            $internal_winner_request_all_btn = 1;
            break;
        endif;
    endforeach;
    // condition to show generate all button
    foreach ($data_internal_winners as $entry_internal_winner) :
        if ($entry_internal_winner['approval_status'] == 0) {
            $internal_winner_generate_all_btn = 0;
            break;
        } elseif ($entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 0) {
            $internal_winner_generate_all_btn = 1;
        }
    endforeach;
    // condition to show download all button
    $temp = 1;
    foreach ($data_internal_winners as $entry_internal_winner) :
        if ($entry_internal_winner['approval_status'] != 2) :
            $temp = 0;
            break;
        endif;
    endforeach;
    foreach ($data_internal_winners as $entry_internal_winner) :
        if (($entry_internal_winner['approval_status'] == 0 && $entry_internal_winner['generate_status'] == 0) || ($entry_internal_winner['approval_status'] == 1 && $entry_internal_winner['generate_status'] == 0) || $temp == 1) {
            $internal_winner_download_all_btn = 0;
            break;
        }
    endforeach;

endif;
