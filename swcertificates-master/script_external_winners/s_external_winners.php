<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-5 text-white">External Winner Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <?php
            if (count($data_external_winners) > 0) :
                // show approve all and reject all buttons
                if ($external_winner_approve_all_btn) :
            ?>
                    <a href="script_external_winners/approveAllExternalWinners?eid=<?= $entry_external_winner['event_id'] ?>&s=1">
                        <button type="button" class="btn btn-success me-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve All</button>
                    </a>
                    <a href="script_external_winners/approveAllExternalWinners?eid=<?= $entry_external_winner['event_id'] ?>&s=2">
                        <button type="button" class="btn btn-danger me-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject All</button>
                    </a>
                <?php
                endif;
                // show download all, send mail & delete all buttons
                if ($external_winner_download_all_btn) :
                ?>
                    <a href="script_external_winners/downloadAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_external_winners/pdfReport?eid=<?= $entry_external_winner['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_external_winners/sendMailAllExternalWinners?eid=<?= $entry_external_winner['event_id']; ?>&uid=s">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                    <a href="script_external_winners/deleteAllExternalWinners?eid=<?= $event_id; ?>&uid=s" class="btn-del-all-external-winners">
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
                        <th>Position</th>
                        <th>Certificate No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_external_winners) > 0) :
                        // numbering the entries
                        $count = 1;
                        foreach ($data_external_winners as $entry_external_winner) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $count; ?></td>
                                <td><?= $entry_external_winner['entry_name']; ?></td>
                                <td><?= $entry_external_winner['entry_email']; ?></td>
                                <td><?= $entry_external_winner['entry_college']; ?></td>
                                <td>
                                    <?php
                                    if ($entry_external_winner['entry_position'] == 1) {
                                        echo "First";
                                    } elseif ($entry_external_winner['entry_position'] == 2) {
                                        echo "Second";
                                    } elseif ($entry_external_winner['entry_position'] == 3) {
                                        echo "Third";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($entry_external_winner['certificate_number'] == "") :
                                        echo "Not available";
                                    else :
                                        echo $entry_external_winner['certificate_number'];
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_external_winner['request_status'] == 0 && $entry_external_winner['approval_status'] == 0 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 0 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_external_winner['requested_by'] . " on " . $entry_external_winner['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 2 && $entry_external_winner['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_external_winner['requested_by'] . " on " . $entry_external_winner['requested_at'] . "<br>Rejected by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "<br>Mail sent by " . $entry_external_winner['mailed_by'] . " on " . $entry_external_winner['mailed_at'] . "</span>";
                                    } elseif ($entry_external_winner['request_status'] == 1 && $entry_external_winner['approval_status'] == 1 && $entry_external_winner['generate_status'] == 1 && $entry_external_winner['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_external_winner['approved_by'] . " on " . $entry_external_winner['approved_at'] . "<br>Certificate generated by " . $entry_external_winner['generated_by'] . " on " . $entry_external_winner['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show approve and reject buttons
                                    if ($entry_external_winner['approval_status'] == 0) :
                                    ?>
                                        <a href="script_external_winners/approveSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id'] ?>&eid=<?= $entry_external_winner['event_id'] ?>&s=1">
                                            <button type="button" class="btn btn-sm btn-success me-2 mt-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
                                        </a>
                                        <a href="script_external_winners/approveSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id'] ?>&eid=<?= $entry_external_winner['event_id'] ?>&s=2">
                                            <button type="button" class="btn btn-sm btn-danger me-2 mt-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject</button>
                                        </a>
                                    <?php
                                    endif;
                                    // show download, send mail & delete button
                                    if ($entry_external_winner['generate_status']) :
                                    ?>
                                        <a href="certificates/<?php echo $event_id; ?>/external_winners/<?php echo $entry_external_winner['certificate_number']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2 mt-2"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                                        </a>
                                        <a href="script_external_winners/sendMailSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>&uid=s">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                        <a href="script_external_winners/deleteSingleExternalWinner?ewid=<?= $entry_external_winner['entry_id']; ?>&eid=<?= $entry_external_winner['event_id']; ?>&uid=s" class="btn-del-single-external-winner">
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
                            <td colspan="8">No Data Available</td>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>