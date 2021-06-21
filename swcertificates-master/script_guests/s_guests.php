<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-1 text-white">Guest Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <?php
            if (count($data_guests) > 0) :
                // show approve all and reject all buttons
                if ($guest_approve_all_btn) :
            ?>
                    <a href="script_guests/approveAllGuests?eid=<?= $entry_guest['event_id'] ?>&s=1">
                        <button type="button" class="btn btn-success me-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve All</button>
                    </a>
                    <a href="script_guests/approveAllGuests?eid=<?= $entry_guest['event_id'] ?>&s=2">
                        <button type="button" class="btn btn-danger me-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject All</button>
                    </a>
                <?php
                endif;
                // show download all, send mail & delete all buttons
                if ($guest_download_all_btn) :
                ?>
                    <a href="script_guests/downloadAllGuests?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_guests/pdfReport?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_guests/sendMailAllGuests?eid=<?= $entry_guest['event_id']; ?>&uid=s">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                    <a href="script_guests/deleteAllGuests?eid=<?= $event_id; ?>&uid=s" class="btn-del-all-guests">
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
                        <th>Guest ID</th>
                        <th>Guest Name</th>
                        <th>Guest Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_guests) > 0) :
                        foreach ($data_guests as $entry_guest) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $entry_guest['guest_id']; ?></td>
                                <td><?= $entry_guest['guest_name']; ?></td>
                                <td><?= $entry_guest['guest_email']; ?></td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_guest['request_status'] == 0 && $entry_guest['approval_status'] == 0 && $entry_guest['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 0 && $entry_guest['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_guest['requested_by'] . " on " . $entry_guest['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_guest['approved_by'] . " on " . $entry_guest['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 2 && $entry_guest['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_guest['requested_by'] . " on " . $entry_guest['requested_at'] . "<br>Rejected by " . $entry_guest['approved_by'] . " on " . $entry_guest['approved_at'] . "</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 1 && $entry_guest['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_guest['approved_by'] . " on " . $entry_guest['approved_at'] . "<br>Certificate generated by " . $entry_guest['generated_by'] . " on " . $entry_guest['generated_at'] . "</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 1 && $entry_guest['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_guest['approved_by'] . " on " . $entry_guest['approved_at'] . "<br>Certificate generated by " . $entry_guest['generated_by'] . " on " . $entry_guest['generated_at'] . "<br>Mail sent by " . $entry_guest['mailed_by'] . " on " . $entry_guest['mailed_at'] . "</span>";
                                    } elseif ($entry_guest['request_status'] == 1 && $entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 1 && $entry_guest['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_guest['approved_by'] . " on " . $entry_guest['approved_at'] . "<br>Certificate generated by " . $entry_guest['generated_by'] . " on " . $entry_guest['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show approve and reject buttons
                                    if ($entry_guest['approval_status'] == 0) :
                                    ?>
                                        <a href="script_guests/approveSingleGuest?gid=<?= $entry_guest['guest_id'] ?>&eid=<?= $entry_guest['event_id'] ?>&s=1">
                                            <button type="button" class="btn btn-sm btn-success me-2 loading_btn"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
                                        </a>
                                        <a href="script_guests/approveSingleGuest?gid=<?= $entry_guest['guest_id'] ?>&eid=<?= $entry_guest['event_id'] ?>&s=2">
                                            <button type="button" class="btn btn-sm btn-danger me-2 loading_btn"><i class="fa fa-times" aria-hidden="true"></i> Reject</button>
                                        </a>
                                    <?php
                                    endif;
                                    // show download, send mail & delete button
                                    if ($entry_guest['generate_status']) :
                                    ?>
                                        <a href="certificates/<?php echo $event_id; ?>/guests/<?php echo $entry_guest['guest_id']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
                                        </a>
                                        <a href="script_guests/sendMailSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>&uid=s">
                                            <button type="button" class="btn btn-sm btn-warning me-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                        <a href="script_guests/deleteSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>&uid=s" class="btn-del-single-guest">
                                            <button type="button" class="btn btn-sm btn-danger me-2"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                        </a>
                                    <?php
                                    endif;
                                    ?>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <!-- show no data available -->
                        <tr class="align-middle">
                            <td colspan="5">No Data Available</td>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>