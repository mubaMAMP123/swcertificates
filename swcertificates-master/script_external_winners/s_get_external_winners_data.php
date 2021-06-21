<?php
//get external winners details from the event table
$SELECT_EXTERNAL_WINNER = "SELECT * FROM " . $event_id . " WHERE entry_position != 0 AND entry_college != 'VIT' AND request_status=1";
$stmt = $conn->query($SELECT_EXTERNAL_WINNER);
$data_external_winners = [];
if ($stmt->num_rows > 0) {
    while ($row = $stmt->fetch_assoc()) {
        $data_external_winners[] = $row;
    }
}
$stmt->free();

//condition to show bulk buttons
$external_winner_approve_all_btn = 0;
$external_winner_download_all_btn = 1;

if (count($data_external_winners) > 0) :
    //condition to show approve all and reject all buttons
    foreach ($data_external_winners as $entry_external_winner) :
        if ($entry_external_winner['approval_status'] == 0) :
            $external_winner_approve_all_btn = 1;
            break;
        endif;
    endforeach;
    //condition to show download all button
    $temp = 1;
    foreach ($data_external_winners as $entry_external_winner) :
        if ($entry_external_winner['approval_status'] != 2) :
            $temp = 0;
            break;
        endif;
    endforeach;
    foreach ($data_external_winners as $entry_external_winner) :
        if (($entry_external_winner['approval_status'] == 0 && $entry_external_winner['generate_status'] == 0) || ($entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 0) || $temp == 1) {
            $external_winner_download_all_btn = 0;
            break;
        }
    endforeach;

endif;
