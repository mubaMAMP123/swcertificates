<?php
//get external participants details from the event table
$SELECT_EXTERNAL_PARTICIPANT = "SELECT * FROM " . $event_id . " WHERE entry_position = 0 AND entry_college != 'VIT' AND request_status=1";
$stmt = $conn->query($SELECT_EXTERNAL_PARTICIPANT);
$data_external_participants = [];
if ($stmt->num_rows > 0) :
    while ($row = $stmt->fetch_assoc()) :
        $data_external_participants[] = $row;
    endwhile;
endif;
$stmt->free();

//condition to show bulk buttons
$external_participant_approve_all_btn = 0;
$external_participant_download_all_btn = 1;

if (count($data_external_participants) > 0) :
    //condition to show approve all and reject all buttons
    foreach ($data_external_participants as $entry_external_participant) :
        if ($entry_external_participant['approval_status'] == 0) :
            $external_participant_approve_all_btn = 1;
            break;
        endif;
    endforeach;
    //condition to show download all button
    $temp_ep = 1;
    foreach ($data_external_participants as $entry_external_participant) :
        if ($entry_external_participant['approval_status'] != 2) :
            $temp_ep = 0;
            break;
        endif;
    endforeach;
    foreach ($data_external_participants as $entry_external_participant) :
        if (($entry_external_participant['approval_status'] == 0 && $entry_external_participant['generate_status'] == 0) || ($entry_external_participant['approval_status'] == 1 && $entry_external_participant['generate_status'] == 0) || $temp_ep == 1) :
            $external_participant_download_all_btn = 0;
            break;
        endif;
    endforeach;

endif;
