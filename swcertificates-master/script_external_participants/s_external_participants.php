<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-4 text-white">External Participant Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <?php
            if (count($data_external_participants) > 0) :
                // show approve all and reject all buttons
                if ($external_participant_approve_all_btn) :
            ?>
                    <a href="script_external_participants/approveAllExternalParticipants?eid=<?= $entry_external_participant['event_id'] ?>&s=1">
                        <button type="button" class="btn btn-success me-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve All</button>
                    </a>
                    <a href="script_external_participants/approveAllExternalParticipants?eid=<?= $entry_external_participant['event_id'] ?>&s=2">
                        <button type="button" class="btn btn-danger me-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject All</button>
                    </a>
                <?php
                endif;
                // show download all, send mail, generate pdf & delete all buttons
                if ($external_participant_download_all_btn) :
                ?>
                    <a href="script_external_participants/downloadAllExternalParticipants?eid=<?= $entry_external_participant['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_external_participants/sendMailAllExternalParticipants?eid=<?= $entry_external_participant['event_id']; ?>&uid=s">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                    <a href="script_external_participants/pdfReport?eid=<?= $entry_external_participant['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_external_participants/deleteAllExternalParticipants?eid=<?= $event_id; ?>&uid=s" class="btn-del-all-external-participants">
                        <button type="button" class="btn btn-danger me-2"><i class="fa fa-trash" aria-hidden="true"></i> Delete All</button>
                    </a>
            <?php
                endif;
            endif; ?>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th></th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>College</th>
                        <th>Certificate No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_external_participants) > 0) :
                        // numbering the entries
                        $count = 1;
                        foreach ($data_external_participants as $entry_external_participant) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $count; ?></td>
                                <td><?= $entry_external_participant['entry_name']; ?></td>
                                <td><?= $entry_external_participant['entry_email']; ?></td>
                                <td><?= $entry_external_participant['entry_college']; ?></td>
                                <td>
                                    <?php
                                    if ($entry_external_participant['certificate_number'] == "") :
                                        echo "Not available";
                                    else :
                                        echo $entry_external_participant['certificate_number'];
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_external_participant['request_status'] == 0 && $entry_external_participant['approval_status'] == 0 && $entry_external_participant['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 0 && $entry_external_participant['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_external_participant['requested_by'] . " on " . $entry_external_participant['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 1 && $entry_external_participant['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_participant['approved_by'] . " on " . $entry_external_participant['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 2 && $entry_external_participant['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_external_participant['requested_by'] . " on " . $entry_external_participant['requested_at'] . "<br>Rejected by " . $entry_external_participant['approved_by'] . " on " . $entry_external_participant['approved_at'] . "</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 1 && $entry_external_participant['generate_status'] == 1 && $entry_external_participant['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_participant['approved_by'] . " on " . $entry_external_participant['approved_at'] . "<br>Certificate generated by " . $entry_external_participant['generated_by'] . " on " . $entry_external_participant['generated_at'] . "</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 1 && $entry_external_participant['generate_status'] == 1 && $entry_external_participant['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_participant['approved_by'] . " on " . $entry_external_participant['approved_at'] . "<br>Certificate generated by " . $entry_external_participant['generated_by'] . " on " . $entry_external_participant['generated_at'] . "<br>Mail sent by " . $entry_external_participant['mailed_by'] . " on " . $entry_external_participant['mailed_at'] . "</span>";
                                    } elseif ($entry_external_participant['request_status'] == 1 && $entry_external_participant['approval_status'] == 1 && $entry_external_participant['generate_status'] == 1 && $entry_external_participant['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_participant['approved_by'] . " on " . $entry_external_participant['approved_at'] . "<br>Certificate generated by " . $entry_external_participant['generated_by'] . " on " . $entry_external_participant['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show approve and reject buttons
                                    if ($entry_external_participant['approval_status'] == 0) :
                                    ?>
                                        <a href="script_external_participants/approveSingleExternalParticipant?epid=<?= $entry_external_participant['entry_id'] ?>&eid=<?= $entry_external_participant['event_id'] ?>&s=1">
                                            <button type="button" class="btn btn-sm btn-success me-2 mt-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
                                        </a>
                                        <a href="script_external_participants/approveSingleExternalParticipant?epid=<?= $entry_external_participant['entry_id'] ?>&eid=<?= $entry_external_participant['event_id'] ?>&s=2">
                                            <button type="button" class="btn btn-sm btn-danger me-2 mt-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject</button>
                                        </a>
                                    <?php
                                    endif;
                                    // show download, send mail & delete button
                                    if ($entry_external_participant['generate_status']) :
                                    ?>
                                        <a href="certificates/<?php echo $event_id; ?>/external_participants/<?php echo $entry_external_participant['certificate_number']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2 mt-2"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                                        </a>
                                        <a href="script_external_participants/sendMailSingleExternalParticipant?epid=<?= $entry_external_participant['entry_id']; ?>&eid=<?= $entry_external_participant['event_id']; ?>&uid=s">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                        <a href="script_external_participants/deleteSingleExternalParticipant?epid=<?= $entry_external_participant['entry_id']; ?>&eid=<?= $entry_external_participant['event_id']; ?>&uid=s" class="btn-del-single-external-participant">
                                            <button type="button" class="btn btn-sm btn-danger me-2 mt-2"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                        </a>
                                    <?php
                                    endif;
                                    ?>
                                </td>
                            </tr>
                        <?php
                            // incrementing the count by 1
                            $count++;
                        endforeach;
                    else :
                        ?>
                        <!-- show no data available -->
                        <tr class="align-middle">
                            <td colspan="7">No Data Available</td>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>