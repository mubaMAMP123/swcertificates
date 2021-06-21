<!-- Guest input modal start -->
<div class="modal fade" id="guest_input_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="guest_input_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guest_input_form_heading">Add Guest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_guests/addGuest?eid=<?= $event_id; ?>" method="post">
                    <div class="mb-3">
                        <label for="guest_name" class="form-label">Guest Name</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="guest_email" class="form-label">Guest Email</label>
                        <input type="email" class="form-control" id="guest_email" name="guest_email" placeholder="Enter email" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="guest_submit">Add Guest</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Guest input modal end -->

<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-1 text-white">Guest Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <!-- add guest button -->
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#guest_input_form"><i class="fa fa-plus" aria-hidden="true"></i> Add Guest</button>
            <?php
            if (count($data_guests) > 0) :
                // show request all button
                if ($guest_request_all_btn) :
            ?>
                    <a href="script_guests/requestAllGuests?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-warning me-2 loading_btn"><i class="fa fa-fast-forward" aria-hidden="true"></i> Request All</button>
                    </a>
                <?php
                endif;
                // show generate all button
                if ($guest_generate_all_btn) :
                ?>
                    <a href="script_guests/generateAllGuests?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2 generate_btn"><i aria-hidden="true" class="fa fa-cogs"></i> Generate All</button>
                    </a>
                <?php
                endif;
                // show download all & send mail buttons
                if ($guest_download_all_btn) :
                ?>
                    <a href="script_guests/downloadAllGuests?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_guests/pdfReport?eid=<?= $entry_guest['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_guests/sendMailAllGuests?eid=<?= $entry_guest['event_id']; ?>&uid=u">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                <?php
                endif;
                ?>
                <!-- show delete all button -->
                <a href="script_guests/deleteAllGuests?eid=<?= $entry_guest['event_id']; ?>&uid=u" class="btn-del-all-guests">
                    <button type="button" class="btn btn-danger me-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete All</button>
                </a>
            <?php endif; ?>
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
                                    <!-- show request button -->
                                    <?php if ($entry_guest['request_status'] == 0) : ?>
                                        <a href="script_guests/requestSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-warning me-2 loading_btn"><i class="fa fa-forward" aria-hidden="true"></i> Request</button>
                                        </a>
                                    <?php endif;
                                    // show generate button
                                    if ($entry_guest['approval_status'] == 1 && $entry_guest['generate_status'] == 0) : ?>
                                        <a href="script_guests/generateSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success me-2 generate_btn"><i class="fa fa-cog" aria-hidden="true"></i> Generate</button>
                                        </a>
                                    <?php endif;
                                    // show download and send mail buttons
                                    if ($entry_guest['generate_status'] == 1) : ?>
                                        <a href="certificates/<?php echo $event_id; ?>/guests/<?php echo $entry_guest['guest_id']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download</button>
                                        </a>
                                        <a href="script_guests/sendMailSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>&uid=u">
                                            <button type="button" class="btn btn-sm btn-warning me-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                    <?php endif; ?>
                                    <!-- show delete button -->
                                    <a href="script_guests/deleteSingleGuest?gid=<?= $entry_guest['guest_id']; ?>&eid=<?= $entry_guest['event_id']; ?>&uid=u" class="btn-del-single-guest">
                                        <button type="button" class="btn btn-sm btn-danger me-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete</button>
                                    </a>
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