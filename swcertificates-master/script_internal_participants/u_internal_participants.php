<!-- Internal Participant input modal start -->
<div class="modal fade" id="internal_participant_input_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="internal_participant_input_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="internal_participant_input_form_heading">Add Internal Participant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_internal_participants/add_internal_participant?eid=<?= $event_id ?>" method="post">
                    <div class="mb-3">
                        <label for="internal_participant_regno" class="form-label">Registration No.</label>
                        <input type="text" class="form-control capitalize" id="internal_participant_regno" name="internal_participant_regno" placeholder="Enter Registration No." pattern="[0-9]{2}[A-Z]{3}[0-9]{4}" title="Example: 17BCE0463" required>
                    </div>
                    <div class="mb-3">
                        <label for="internal_participant_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="internal_participant_name" name="internal_participant_name" placeholder="Enter name" required>
                    </div>
                    <label for="internal_participant_email" class="form-label">VIT Mail ID</label>
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control lowercase" id="internal_participant_email" name="internal_participant_email" aria-describedby="internal_participant_email" placeholder="Enter username" pattern="[a-z]+\.+([a-z]*)+[0-9]{4}" title="Example: ali.muhammed2017 or ali.2017" required>
                        <span class="input-group-text" id="internal_participant_email">@vitstudent.ac.in</span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="internal_participant_submit">Add Participant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Internal Participant input modal end -->

<!-- Internal Participant import data modal start -->
<div class="modal fade" id="internal_participants_import_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="internal_participants_import_form_heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="internal_participants_import_form_heading">Import Internal Participants Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-grid">
                    <a href="script_internal_participants/Template.csv" class="btn btn-danger" download>
                        <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Download Template
                    </a>
                </div>
                <form action="script_internal_participants/import_internal_participants?eid=<?= $event_id ?>" enctype="multipart/form-data" method="post">
                    <div class="my-3">
                        <input class="form-control" type="file" name="csvfile" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="internal_participants_import">Import Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Internal Participant import data modal end -->

<div class="card mb-5 shadow">
    <div class="card-header text-center fs-5 bg-2 text-white">Internal Participant Certificates</div>
    <div class="card-body">
        <div class="text-center">
            <!-- add participant button -->
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#internal_participant_input_form"><i class="fa fa-plus" aria-hidden="true"></i> Add Participant</button>
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#internal_participants_import_form"><i class="fa fa-cloud-download" aria-hidden="true"></i> Import Participants</button>
            <?php
            if (count($data_internal_participants) > 0) :
                // show request all button
                if ($internal_participant_request_all_btn) :
            ?>
                    <a href="script_internal_participants/requestAllInternalParticipants?eid=<?= $entry_internal_participant['event_id']; ?>">
                        <button type="button" class="btn btn-warning me-2 loading_btn"><i class="fa fa-fast-forward" aria-hidden="true"></i> Request All</button>
                    </a>
                <?php
                endif;
                // show generate all button
                if ($internal_participant_generate_all_btn) :
                ?>
                    <a href="script_internal_participants/generateAllInternalParticipants?eid=<?= $entry_internal_participant['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2 generate_btn"><i aria-hidden="true" class="fa fa-cogs"></i> Generate All</button>
                    </a>
                <?php
                endif;
                // show download all & send mail buttons
                if ($internal_participant_download_all_btn) :
                ?>
                    <a href="script_internal_participants/downloadAllInternalParticipants?eid=<?= $entry_internal_participant['event_id']; ?>">
                        <button type="button" class="btn btn-dark me-2"><i aria-hidden="true" class="fa fa-download"></i> Download All</button>
                    </a>
                    <a href="script_internal_participants/pdfReport?eid=<?= $entry_internal_participant['event_id']; ?>">
                        <button type="button" class="btn btn-success me-2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate Report</button>
                    </a>
                    <a href="script_internal_participants/sendMailAllInternalParticipants?eid=<?= $entry_internal_participant['event_id']; ?>&uid=u">
                        <button type="button" class="btn btn-warning me-2 send_mail_btn"><i aria-hidden="true" class="fa fa-paper-plane"></i> Sent Mail</button>
                    </a>
                <?php
                endif;
                ?>
                <!-- show delete all button -->
                <a href="script_internal_participants/deleteAllInternalParticipants?eid=<?= $entry_internal_participant['event_id']; ?>&uid=u" class="btn-del-all-internal-participants">
                    <button type="button" class="btn btn-danger me-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete All</button>
                </a>
            <?php endif; ?>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr class="align-middle">
                        <th></th>
                        <th>Registration No.</th>
                        <th>Name</th>
                        <th>VIT Mail ID</th>
                        <th>Certificate No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data_internal_participants) > 0) :
                        // numbering the entries
                        $count = 1;
                        foreach ($data_internal_participants as $entry_internal_participant) :
                    ?>
                            <tr class="align-middle">
                                <td><?= $count; ?></td>
                                <td><?= $entry_internal_participant['entry_regno']; ?></td>
                                <td><?= $entry_internal_participant['entry_name']; ?></td>
                                <td><?= $entry_internal_participant['entry_email']; ?></td>
                                <td>
                                    <?php
                                    if ($entry_internal_participant['certificate_number'] == "") :
                                        echo "Not available";
                                    else :
                                        echo $entry_internal_participant['certificate_number'];
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // show status
                                    if ($entry_internal_participant['request_status'] == 0 && $entry_internal_participant['approval_status'] == 0 && $entry_internal_participant['generate_status'] == 0) {
                                        echo "<span class='text-warning'>Request not raised</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 0 && $entry_internal_participant['generate_status'] == 0) {
                                        echo "<span class='text-primary'>Requested by " . $entry_internal_participant['requested_by'] . " on " . $entry_internal_participant['requested_at'] . "</span><br><span class='text-secondary'>Pending Approval</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_participant['approved_by'] . " on " . $entry_internal_participant['approved_at'] . "</span><br><span class='text-danger'>Certificate not generated</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 2 && $entry_internal_participant['generate_status'] == 0) {
                                        echo "<span class='text-danger'>Requested by " . $entry_internal_participant['requested_by'] . " on " . $entry_internal_participant['requested_at'] . "<br>Rejected by " . $entry_internal_participant['approved_by'] . " on " . $entry_internal_participant['approved_at'] . "</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 1 && $entry_internal_participant['mail_status'] == 0) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_participant['approved_by'] . " on " . $entry_internal_participant['approved_at'] . "<br>Certificate generated by " . $entry_internal_participant['generated_by'] . " on " . $entry_internal_participant['generated_at'] . "</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 1 && $entry_internal_participant['mail_status'] == 1) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_participant['approved_by'] . " on " . $entry_internal_participant['approved_at'] . "<br>Certificate generated by " . $entry_internal_participant['generated_by'] . " on " . $entry_internal_participant['generated_at'] . "<br>Mail sent by " . $entry_internal_participant['mailed_by'] . " on " . $entry_internal_participant['mailed_at'] . "</span>";
                                    } elseif ($entry_internal_participant['request_status'] == 1 && $entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 1 && $entry_internal_participant['mail_status'] == 2) {
                                        echo "<span class='text-success'>Approved by " . $entry_internal_participant['approved_by'] . " on " . $entry_internal_participant['approved_at'] . "<br>Certificate generated by " . $entry_internal_participant['generated_by'] . " on " . $entry_internal_participant['generated_at'] . "</span><br><span class='text-danger'>Error in sending mail</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- show request button -->
                                    <?php if ($entry_internal_participant['request_status'] == 0) : ?>
                                        <a href="script_internal_participants/requestSingleInternalParticipant?ipid=<?= $entry_internal_participant['entry_id']; ?>&eid=<?= $entry_internal_participant['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 loading_btn"><i class="fa fa-forward" aria-hidden="true"></i> Request</button>
                                        </a>
                                    <?php endif;
                                    // show generate button
                                    if ($entry_internal_participant['approval_status'] == 1 && $entry_internal_participant['generate_status'] == 0) : ?>
                                        <a href="script_internal_participants/generateSingleInternalParticipant?ipid=<?= $entry_internal_participant['entry_id']; ?>&eid=<?= $entry_internal_participant['event_id']; ?>">
                                            <button type="button" class="btn btn-sm btn-success me-2 mt-2 generate_btn"><i class="fa fa-cog" aria-hidden="true"></i> Generate</button>
                                        </a>
                                    <?php endif;
                                    // show download and send mail buttons
                                    if ($entry_internal_participant['generate_status'] == 1) : ?>
                                        <a href="certificates/<?php echo $event_id; ?>/internal_participants/<?php echo $entry_internal_participant['entry_regno']; ?>.jpg" download>
                                            <button type="button" class="btn btn-sm btn-dark me-2 mt-2"><i aria-hidden="true" class="fa fa-download"></i> Download</button>
                                        </a>
                                        <a href="script_internal_participants/sendMailSingleInternalParticipant?ipid=<?= $entry_internal_participant['entry_id']; ?>&eid=<?= $entry_internal_participant['event_id']; ?>&uid=u">
                                            <button type="button" class="btn btn-sm btn-warning me-2 mt-2 send_mail_btn"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Mail</button>
                                        </a>
                                    <?php endif; ?>
                                    <!-- show delete button -->
                                    <a href="script_internal_participants/deleteSingleInternalParticipant?ipid=<?= $entry_internal_participant['entry_id']; ?>&eid=<?= $entry_internal_participant['event_id']; ?>&uid=u" class="btn-del-single-internal-participant">
                                        <button type="button" class="btn btn-sm btn-danger me-2 mt-2"><i aria-hidden="true" class="fa fa-trash"></i> Delete</button>
                                    </a>
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